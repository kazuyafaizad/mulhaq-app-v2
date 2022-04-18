<?php

namespace App\Gamify\Points;

use Ansezz\Gamify\BasePoint;

class UpdateProfile extends BasePoint
{

    /**
     * check if user achieve the point
     * @param $point
     * @param $subject
     *
     * @return bool
     */
    public function __invoke($point, $subject)
    {
        return true;
    }

}
