<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\LessonController;
use App\Http\Controllers\Api\V1\ModuleController;
use App\Http\Controllers\Api\V1\ReplySupportController;
use App\Http\Controllers\Api\V1\SupportController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response()->json([
    	"success" => true
    ]);
});

/**
 * Auth
 */
Route::post('/auth', [AuthController::class, 'auth']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

/**
 * Reset Password
 */
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest');

/**
 * routes - v1
 */
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {

    Route::get('/courses',[CourseController::class, 'index']);
    Route::get('/courses/{id}',[CourseController::class, 'show']);

    Route::get('/courses/{id}/modules', [ModuleController::class,'index']);

    Route::get('/modules/{id}/lessons', [LessonController::class,'index']);
    Route::get('/lessons/{id}', [LessonController::class,'show']);

    Route::post('/lessons/viewed', [LessonController::class,'viewed']);

    Route::get('/supports', [SupportController::class, 'index']);
    Route::get('/my-supports', [SupportController::class, 'mySupport']);
    Route::post('/supports', [SupportController::class, 'store']);

    Route::post('/supports/{id}/replies', [ReplySupportController::class, 'createReply']);
});
