<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class DashboardController extends Controller implements HasMiddleware
{
    public function index()
    {

        return view('users.dashboard');
    }

    // Middleware for authenticated users who can access this page
    public static function middleware(): array
    {
        return [
            'auth'
        ];
    }
}