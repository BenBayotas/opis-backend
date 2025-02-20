<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectCorequisiteController;
use App\Http\Controllers\SubjectEquivalentController;
use App\Http\Controllers\SubjectPrerequisiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DepartmentController::class, 'index']);

// COURSES
Route::get('/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/course/add', [CourseController::class, 'create'])->name('course.create');
Route::post('/course/store', [CourseController::class, 'store'])->name('course.store');
Route::get('/course/{id}/edit', [CourseController::class, 'edit'])->name('course.edit');
Route::put('/course/{id}', [CourseController::class, 'update'])->name('course.update');
// Optional: Route for deletion
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
Route::post('/curriculum/{curriculum}/add-subjects', [CurriculumController::class, 'addSubjects'])->name('curriculum.addSubjects');

// SUBJECTS
Route::get('/subject', [SubjectController::class, 'index'])->name('subject.index');
Route::get('/subject/create', [SubjectController::class, 'create'])->name('subject.create');
Route::post('/subject/store', [SubjectController::class, 'store'])->name('subject.store');
Route::get('/subject/{subject}', [SubjectController::class, 'show'])->name('subject.show');
Route::get('/subject/{subject}/edit', [SubjectController::class, 'edit'])->name('subject.edit');
Route::put('/subject/{subject}', [SubjectController::class, 'update'])->name('subject.update');
Route::delete('/subject/{subject}', [SubjectController::class, 'destroy'])->name('subject.destroy');

Route::post('/subject/prerequisite', [SubjectPrerequisiteController::class, 'store'])->name('subject.prerequisite.store');
Route::delete('/subject/{subjectId}/prerequisite/{prerequisiteId}', [SubjectPrerequisiteController::class, 'destroy'])->name('subject.prerequisite.destroy');

Route::post('/subject/corequisite', [SubjectCorequisiteController::class, 'store'])->name('subject.corequisite.store');
Route::delete('/subject/{subjectId}/corequisite/{corequisiteId}', [SubjectCorequisiteController::class, 'destroy'])->name('subject.corequisite.destroy');

Route::post('/subject/equivalent', [SubjectEquivalentController::class, 'store'])->name('subject.equivalent.store');
Route::delete('/subject/{subjectId}/equivalent/{equivalentId}', [SubjectEquivalentController::class, 'destroy'])->name('subject.equivalent.destroy');

Route::get('/subject/{subject}/manage-requisites', [SubjectController::class, 'manageRequisites'])->name('subject.manageRequisites');