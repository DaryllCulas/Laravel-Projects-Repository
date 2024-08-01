<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('home');
});


Route::get('/jobs', function () {

    // eager loading here to avoid N+1 queries and apply pagination
    $jobs = Job::with('employer')->latest()->cursorPaginate(4);

    return view('jobs.index', ['jobs' => $jobs]);
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});


Route::post('/jobs', function () {

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs');
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
