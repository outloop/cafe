<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    //
    public function getTags(Request $request, Tag $tag)
    {
        $query = $request->get('search');
        $tags = $query ? $tag->where('name', 'like', "{$query}%")->get() : $tag->all();
        return response()->json($tags);
    }
}
