<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\QuestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CourseController::class, 'index']);

Route::get('/courses/create', [CourseController::class, 'create'])->middleware('auth');

Route::post('/courses', [CourseController::class, 'store'])->middleware('auth');

Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->middleware('auth');

Route::put('/courses/{course}', [CourseController::class, 'update'])->middleware('auth');

Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->middleware('auth');

Route::get('/courses/manage', [CourseController::class, 'manage']);

Route::get('/courses/{course}', [CourseController::class, 'show']);


Route::get('/register', [UserController::class, 'create'])->middleware('guest');

Route::post('/users', [UserController::class, 'store']);

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

Route::post('/users/authenticate', [UserController::class, 'authenticate']);


Route::get('/questions/create/{course}', [QuestionController::class, 'create'])->middleware('auth');

Route::post('/questions', [QuestionController::class, 'store'])->middleware('auth');

Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->middleware('auth');

Route::put('/questions/{question}', [QuestionController::class, 'update'])->middleware('auth');

Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->middleware('auth');

Route::get('/questions/result', [QuestionController::class, 'results']);

Route::get('/questions/{course}/show', [QuestionController::class, 'show']);

Route::post('/questions/check', [QuestionController::class, 'checkAnswers'])->middleware('prevent.duplicate.answers');



Route::post('/attachments', [AttachmentsController::class, 'authenticate'])->name('attachments.store');
