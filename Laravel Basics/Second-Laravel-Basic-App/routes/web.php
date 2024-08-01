<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;


// It serves as home page
Route::get('/', function () {
    return view('home');
});


// It serves as index page
Route::get('/jobs', function () {

    // eager loading here to avoid N+1 queries and apply pagination
    $jobs = Job::with('employer')->latest()->cursorPaginate(4);

    return view('jobs.index', ['jobs' => $jobs]);
});


// It serves as create page
Route::get('/jobs/create', function () {
    return view('jobs.create');
});



// It serves as store page
Route::post('/jobs', function () {
    // Validation
    request()->validate([
        'title' => ['required', 'min:5'],
        'salary' => ['required']
    ]);


    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs');
});


// It serves as show page
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

// It serves as edit page
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});


// It serves as update page
Route::patch('/jobs/{id}', function ($id) {

    request()->validate([
        'title' => ['required', 'min:5'],
        'salary' => ['required']
    ]);


    $job = Job::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    return redirect('/jobs/' . $job->id);
});


// It serves as destroy page
Route::delete('/jobs/{id}', function ($id) {

    $job = Job::findOrFail($id)->delete();

    return redirect('/jobs');
});

// It serves as contact page
Route::get('/contact', function () {
    return view('contact');
});
