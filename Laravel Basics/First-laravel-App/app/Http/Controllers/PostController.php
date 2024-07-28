<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StorePostRequest;
// use App\Http\Requests\UpdatePostRequest;


use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\WelcomeMail;

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
    public function store(Request $request, User $user)
    {
        // Validate
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:webp,jpg,jpeg,png'],
        ]);

        $path = null;

        // Store image if exists
        if ($request->hasFile('image')) {

            $path = Storage::disk('public')->put('posts_images', $request->image);
        }


        // Create a post
        $post = Auth::user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path
        ]);

        // Send Email
        Mail::to(Auth::user())->send(new WelcomeMail(Auth::user(), $post));


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
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:webp,jpg,jpeg,png'],
        ]);


        // Store image if exists
        $path = $post->image ?? null;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('posts_images', $request->image);
        }

        // Update a post
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path
        ]);

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

        // Delete post image if exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }


        // Delete the post
        $post->delete();

        // Redirect to dashboard
        return back()->with('delete', 'Your post was deleted successfully');
    }
}
