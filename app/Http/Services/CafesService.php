<?php

namespace App\Http\Services;

use App\Cafe;
use App\Utilities\Maps\Gaode;

class CafesService
{
    private $gaode;

    public function __construct(Gaode $gaode)
    {
        $this->gaode = $gaode;
    }

    public function save($name, $desc, $website, $location, $roaster, $brewMethods, $parent, $addedBy)
    {
        $cafe = new Cafe();

        $cafe->name = $name;
        $cafe->description = $desc;
        $cafe->website = $website;
        $cafe->roaster = $roaster;
        $cafe->parent = $parent;
        $cafe->added_by = $addedBy;

        $cafe->location_name = $location['name'];
        $cafe->address = $location['address'];
        $cafe->city = $location['city'];
        $cafe->state = $location['state'];
        $cafe->zip = $location['zip'];
        $geo = $this->gaode->geocode($cafe->address, $cafe->city, $cafe->state);
        $cafe->latitude = $geo['lat'] ?: null;
        $cafe->longitude = $geo['lng'] ?: null;


        if ($cafe->save() && $cafe->brewMethods()->sync($brewMethods)) {
            return $cafe->toArray();
        }
        return [];
    }
}
