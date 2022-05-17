<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $content = "Free upgrade tier if you update profile today";
        $title = "Upgrade your tier";
        $link = route('profile');
        return Inertia::render('Home', [
            'hero' => [
                'title' => $title,
                'content' => $content,
                'link' => $link,
                'show' => Auth::user()->badges->last()?->level > 0 ? false : true
            ]
        ]);
    }
}
