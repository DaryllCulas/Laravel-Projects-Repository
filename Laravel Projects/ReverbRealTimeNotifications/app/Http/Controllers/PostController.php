<?php

namespace App\Http\Controllers;

use App\Events\PostCreate;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::get();



        return view('posts', compact('posts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
        ]);

        event(new PostCreate($post));

        return back()->with('success', 'Post Created Successfully');
    }
}
