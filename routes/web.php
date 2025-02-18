<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DepartmentController::class, 'index']);
Route::get('/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/course/add', [CourseController::class, 'create'])->name('course.create');
Route::post('/course/store', [CourseController::class, 'store'])->name('course.store');
Route::get('/course/{id}/edit', [CourseController::class, 'edit'])->name('course.edit');
Route::put('/course/{id}', [CourseController::class, 'update'])->name('course.update');
// Optional: Route for deletion
Route::delete('/course/{id}', [CourseController::class, 'destroy'])->name('course.destroy');

// curriculum
Route::get('/curriculum', [CurriculumController::class, 'index']);


