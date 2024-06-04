<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;


Route::get('/', function () {

    return view('welcome');
});

Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::post('/jobs', function () {
    //validation
    request()->validate([
        'title' => ['required', 'string', 'min:3'],
        'salary' => ['required', 'string']
    ]);


    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
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
