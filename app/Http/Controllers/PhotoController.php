<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function like(Request $request, Photo $photo)
    {
        $this->middleware('auth');

        // User has liked or not?
        if ($photo->isLiked()) {
            //return redirect()->back()->with('error', 'Already liked');
            $like = $photo->likes->where('user_id', $request->user()->id)->first();
            Like::destroy($like->id);
            return redirect()->back();
        }

        // Like
        $photo->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return redirect()->back();
    }
}
