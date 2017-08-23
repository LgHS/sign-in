<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocialTagsController extends Controller
{
    public function store( $request)
    {
        $socialTag = new SocialTagsController;
        $socialTag->user_id = $request->user()->id;
        $socialTag->tag = $request->get('social_tag');
        $socialTag->tag_name = $request->get('tag_name');
        $socialTag->save();
    }
}
