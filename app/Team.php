<?php

namespace App;

use Laravel\Spark\Team as SparkTeam;

class Team extends SparkTeam
{
    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }
}
