<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [DepartmentController::class, 'index']);
Route::get('course/', [CourseController::class, 'index']);
