<?php

namespace App\Gamify\Badges;

use Ansezz\Gamify\BaseBadge;

class Tier extends BaseBadge
{

    /**
     *  beginner check
     * @param $badge
     * @param $subject
     *
     * @return bool
     */
    public function beginner($badge, $subject)
    {
        return $subject->achieved_points >= 100;
    }
    public function intermediate($badge, $subject)
    {
        return $subject->achieved_points >= 200;
    }
    public function advanced($badge, $subject)
    {
        return $subject->achieved_points >= 300;
    }
}
