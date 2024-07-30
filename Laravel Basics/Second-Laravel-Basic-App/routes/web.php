<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => [
            [
                'id' => 1,
                'title' => 'Senior Laravel Developer',
                'salary' => '$100, 000',
            ],
            [
                'id' => 2,
                'title' => 'Programmer',
                'salary' => '$10, 000'
            ],
            [
                'id' => 3,
                'title' => 'Teacher',
                'salary' => '$50, 000'
            ]
        ]
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $jobs = [
        [
            'id' => 1,
            'title' => 'Senior Laravel Developer',
            'salary' => '$100, 000',
        ],
        [
            'id' => 2,
            'title' => 'Programmer',
            'salary' => '$10, 000'
        ],
        [
            'id' => 3,
            'title' => 'Teacher',
            'salary' => '$50, 000'
        ]
    ];

    $job = Arr::first($jobs, function ($item) use ($id) {
        return $item['id'] == $id;
    });

    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
