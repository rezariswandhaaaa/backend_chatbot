<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::post('/forgot', [AuthController::class, 'sendResetLinkEmail'])->name('password.reset');

Route::get('/ask', [QuestionController::class, 'getAnswer']);

Route::post('/storedata', [AdminController::class, 'storeQuestionAndAnswer']);

Route::get('/getdata', [AdminController::class, 'getQuestionsWithAnswers']);

Route::put('/edit/{id}', [AdminController::class, 'updateQuestionAndAnswer']);

Route::delete('/questions/{id}', [AdminController::class, 'deleteQuestionAndAnswer']);

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
