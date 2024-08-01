<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('home');
});


Route::get('/jobs', function () {

    // eager loading here to avoid N+1 queries
    $jobs = Job::with('employer')->get();



    return view('jobs', ['jobs' => $jobs]);
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});