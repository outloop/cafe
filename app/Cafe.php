<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    //
    public function brewMethods()
    {
        return $this->belongsToMany(BrewMethod::class, 'cafes_brew_methods', 'cafe_id', 'brew_method_id');
    }

    public function children()
    {
        return $this->hasMany(Cafe::class, 'parent', 'id');
    }

    public function parent()
    {
        return $this->hasOne(Cafe::class, 'id', 'parent');
    }

    public function likes()
    {
        return $this->belongsToMany(Cafe::class, 'users_cafes_likes', 'cafe_id', 'cafe_id');
    }

    public function userLike()
    {
        return $this->belongsToMany(User::class, 'users_cafes_likes', 'cafe_id', 'user_id')->where('user_id', auth('api')->id());
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'cafes_users_tags', 'cafe_id', 'tag_id');
    }

}
