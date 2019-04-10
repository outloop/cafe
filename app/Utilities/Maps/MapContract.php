<?php

namespace App\Utilities\Maps;

interface MapContract
{
    public function geocode($address, $city, $state);
}
