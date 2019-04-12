<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function cafes()
    {
        return $this->belongsToMany(Cafe::class, 'cafes_users_tags', 'tag_id', 'cafe_id');
    }
}
