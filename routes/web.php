<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [DepartmentController::class, 'index']);
Route::get('/course', [CourseController::class, 'index'])->name('create.index');
Route::get('/course/add', [CourseController::class,'create']);
Route::post('/course/store', [CourseController::class,'store']);
Route::get('/course/{id}/edit', [CourseController::class,'edit'])->name('course.edit');
Route::put('/course/{id}', [CourseController::class,'update'])->name('course.update');