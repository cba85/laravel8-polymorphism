<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate(['post' => 'required']);

        $request->user()->posts()->create([
            'body' => $request->get('post')
        ]);

        return redirect()->back();
    }

    public function like(Request $request, Post $post)
    {
        $this->middleware('auth');

        // User has liked or not?
        if ($post->isLiked()) {
            //return redirect()->back()->with('error', 'Already liked');
            $like = $post->likes->where('user_id', $request->user()->id)->first();
            Like::destroy($like->id);
            return redirect()->back();
        }

        // Like
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return redirect()->back();
    }
}
