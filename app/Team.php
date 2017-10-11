<?php

namespace App;

use Laravel\Spark\Team as SparkTeam;

class Team extends SparkTeam
{
    public function getDateFormat()
    {
        return env('DATE_FORMAT', 'Y-m-d H:i:s.000');
    }
}
