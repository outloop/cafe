<?php

namespace App\Http\Services;

use App\Cafe;
use App\CafesUsersTags;
use App\Tag;
use App\Utilities\Maps\Gaode;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

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


        if ($cafe->save() && $cafe->brewMethods()->sync($brewMethods) && $this->tag($cafe, $location['tags'], $addedBy)) {
            return $cafe->toArray();
        }
        return [];
    }

    public function tag(Cafe $cafe, $tags, $userId)
    {
        try {
            DB::beginTransaction();
            foreach ($tags as $tag) {
                $name = trim($tag);
                $cafeTag = Tag::firstOrNew(['name' => $name]);
                $cafeTag->name = $name;
                if (!$cafeTag->save() || !$cafe->tags()->sync([$cafeTag->id => [
                        'user_id' => $userId
                    ]])) {
                    DB::rollback();
                    return false;
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            return false;
        }
        return true;
    }

    public function delTag($cafeId, $tagID, $userId)
    {
        return CafesUsersTags::where([
            'cafe_id' => $cafeId,
            'tag_id' => $tagID,
            'user_id' => $userId
        ])->delete();
    }
}
