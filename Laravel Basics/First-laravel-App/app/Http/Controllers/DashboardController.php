<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller implements HasMiddleware
{
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->paginate(4);

        return view('users.dashboard', ['posts' => $posts]);
    }

    // Middleware for authenticated users who can access this page
    public static function middleware(): array
    {
        return [
            'auth'
        ];
    }

    public function userPosts(User $user)
    {
        $userPosts = $user->posts()->latest()->paginate(6);
        return view('users.posts', [
            'posts' => $userPosts,
            'user' => $user
        ]);
    }
}