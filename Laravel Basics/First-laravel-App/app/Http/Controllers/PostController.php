<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StorePostRequest;
// use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $posts = Post::orderBy('created_at', 'DESC')->get();
        $posts = Post::latest()->paginate(6);



        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate
        $postFields = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required']
        ]);

        // Create a post
        Auth::user()->posts()->create($postFields);

        // Redirect to dashboard

        return back()->with('success', 'Your post was created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Check if user has permission to edit the post
        Gate::authorize('modify', $post);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Only Authorized users can edit posts
        Gate::authorize('modify', $post);

        // Validate
        $postFields = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required']
        ]);

        // Update a post
        $post->update($postFields);

        // Redirect to dashboard

        return redirect()->route('dashboard')->with('success', 'Your post was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Only Authorized users can delete posts
        Gate::authorize('modify', $post);

        // Delete the post
        $post->delete();

        // Redirect to dashboard
        return back()->with('delete', 'Your post was deleted successfully');
    }
}
