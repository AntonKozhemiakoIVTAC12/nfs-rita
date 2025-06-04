<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonTypeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/students', [StudentController::class, 'index']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::put('/students/{id}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);
});

Route::post('/attendance', [AttendanceController::class, 'store']);


Route::get('/teachers', [TeacherController::class, 'index']);
Route::get('/teachers/{id}/subjects', [TeacherController::class, 'subjects']);
Route::get('/teachers/{id}/lessons', [TeacherController::class, 'lessons']);

// Группы
Route::get('/groups', [GroupController::class, 'index']);

// Типы занятий
Route::get('/lesson-types', [LessonTypeController::class, 'index']);

// Занятия
Route::post('/lessons', [LessonController::class, 'store']);
Route::patch('/lessons/{id}/status', [LessonController::class, 'updateStatus']);
Route::get('/lessons/{id}/export', [LessonController::class, 'export']);
