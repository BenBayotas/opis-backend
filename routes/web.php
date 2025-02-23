<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectPreCoEquiController;
use Illuminate\Support\Facades\Route;

// Departments
Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');
Route::post('/department', [DepartmentController::class, 'store'])->name('department.store');
Route::put('/department/{id}', [DepartmentController::class, 'update'])->name('department.update');
Route::delete('/department/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');

// COURSES
Route::get('/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/course/search', [CourseController::class, 'search'])->name('course.search');
Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
Route::post('/course', [CourseController::class, 'store'])->name('course.store');
Route::get('/course/{id}/edit', [CourseController::class, 'edit'])->name('course.edit');
Route::put('/course/{id}', [CourseController::class, 'update'])->name('course.update');
Route::delete('/course/{id}', [CourseController::class, 'destroy'])->name('course.destroy');

// curriculum
Route::get('/curriculum', [CurriculumController::class, 'index'])->name('curriculum.index');
Route::get('/curriculum/show', [CurriculumController::class, 'show'])->name('curriculum.show');
Route::get('/curriculum/create', [CurriculumController::class, 'create'])->name('curriculum.create');
Route::post('/curriculum/store', [CurriculumController::class, 'store'])->name('curriculum.store');
Route::get('/curriculum/show', [CurriculumController::class, 'show'])->name('curriculum.show');
Route::get('/curriculum/{id}/edit', [CurriculumController::class, 'edit'])->name('curriculum.edit');
Route::put('/curriculum/{id}', [CurriculumController::class, 'update'])->name('curriculum.update');
Route::delete('/curriculum/{curriculum}', [CurriculumController::class, 'destroy'])->name('curriculum.destroy');
Route::delete('/curriculum/{curriculum}/semester/{semester}/subject/{subject}', [CurriculumController::class, 'removeSubject'])->name('curriculum.removeSubject');

// AJAX endpoint for adding subjects:
Route::post('/curriculum/{id}/add-subjects', [CurriculumController::class, 'addSubjects'])->name('curriculum.addSubjects');
Route::delete('/curriculum/{id}/subjects/', [CurriculumController::class, 'removeSubjects'])->name('curriculum.removeSubjects');

// SUBJECTS
Route::get('/subject', [SubjectController::class, 'index'])->name('subject.index');
Route::get('/subject/create', [SubjectController::class, 'create'])->name('subject.create');
Route::post('/subject/store', [SubjectController::class, 'store'])->name('subject.store');
Route::get('/subject/{subject}', [SubjectController::class, 'show'])->name('subject.show');
Route::get('/subject/{subject}/edit', [SubjectController::class, 'edit'])->name('subject.edit');
Route::put('/subject/{subject}', [SubjectController::class, 'update'])->name('subject.update');
Route::delete('/subject/{subject}', [SubjectController::class, 'destroy'])->name('subject.destroy');

Route::get('/subject/{subject}/manage-requisites', [SubjectController::class, 'manageRequisites'])->name('subject.manageRequisites');

Route::post('/subject/{id}/requisites', [SubjectPreCoEquiController::class, 'store'])->name('subject.requisites.store');
Route::delete('/subject/{subjectId}/requisites/{reqId}', [SubjectPreCoEquiController::class, 'destroy'])->name('subject.requisites.destroy');
