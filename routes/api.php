<?php

use App\Http\Controllers\ClassLevelController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentSubjectController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherSubjectClassController;
use App\Http\Controllers\UserController;
use App\Models\ClassLevel;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
    Route::prefix('user')->group(function () {
        Route::post('/register', [UserController::class, 'register']);
        Route::post('/login', [UserController::class, 'login']);
        Route::middleware(['auth:sanctum'])->group(function () {
            Route::post('/logout', [UserController::class, 'logout']);
            Route::post('/verify', [UserController::class, 'verifyTwilio']);
        });
    });
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::resource('levels', LevelController::class);
        Route::post('subjects/store', [SubjectController::class, 'store']);
        Route::put('subjects/update/{subject}', [SubjectController::class, 'update']);
        Route::delete('subjects/delete/{subject}', [SubjectController::class, 'destroy']);
        Route::post('classes/store', [ClassLevelController::class, 'store']);
        Route::put('classes/update/{classLevel}', [ClassLevelController::class, 'update']);
        Route::resource('student-classes', StudentClassController::class);
        Route::resource('teacher-subject-classes', TeacherSubjectClassController::class);
        Route::resource('student-subjects', StudentSubjectController::class);
    });
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('subjects', [SubjectController::class, 'index']);
        Route::get('subjects/{subject}', [SubjectController::class, 'show']);

        Route::get('classes', [ClassLevelController::class, 'index']);
        Route::get('classes/{classLevel}', [ClassLevelController::class, 'show']);

        Route::get('students/all', [StudentController::class, 'all']);

        Route::resource('students', StudentController::class);
        Route::resource('teachers', TeacherController::class);

        Route::get('/search/students', [StudentController::class, 'search']);
        Route::get('/search/teachers', [TeacherController::class, 'search']);
        Route::get('/search/classes', [ClassLevelController::class, 'search']);
    });
});
