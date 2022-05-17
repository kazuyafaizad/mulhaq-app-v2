<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Ansezz\Gamify\Badge;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $authenticated_user = null;
        $user_notifications = 0;
        $tier = [0];

        if ($request->user()) {
            $user = $request->user()->only('id', 'email', 'name');
            $profile = $request->user()->profile->only('fullname', 'profile_photo_url');

            $request->user()->syncBadges();
            $badge = Badge::find(1);
            $tier = $request->user()->badges->last(); //$badge->isAchieved($request->user());
            $user = array_merge($user, ['tier' => $request->user()->badges->last() ? $request->user()->badges->last()?->level : 0]);
            $authenticated_user = array_merge($user, $profile);
            $user_notifications = $request->user()->notification->count();
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $authenticated_user,
                'tier' => $tier
            ],
            'notifications' => $user_notifications,
            'flash' => [
                'content' => [
                    'message' => fn () => $request->session()->get('message'),
                    'type' => fn () => $request->session()->get('type'),
                ]
            ],
            'ziggy' => function () {
                return (new Ziggy)->toArray();
            },
            'urlPrev'    => function () {
                if (url()->previous() !== route('login') && url()->previous() !== '' && url()->previous() !== url()->current()) {
                    return url()->previous();
                } else {
                    return 'empty'; // used in javascript to disable back button behavior
                }
            },
        ]);
    }
}
