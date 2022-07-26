<?php

use App\Models\Task;
use App\Models\Topic;
use App\Models\Question;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('main');
});

Route::get('/quizzes', [App\Http\Controllers\QuizController::class, 'index']);
Route::post('/quizzes', [App\Http\Controllers\QuizController::class, 'create']);
Route::delete('/quizzes/{quiz}', [App\Http\Controllers\QuizController::class, 'delete']);
Route::post('/quiz-add-question', [App\Http\Controllers\QuizController::class, 'add_question']);

Route::get('/answers', [App\Http\Controllers\AnswerController::class, 'index']);
Route::post('/answer', [App\Http\Controllers\AnswerController::class, 'create']);
Route::delete('/answers/{answer}', [App\Http\Controllers\AnswerController::class, 'delete']);

Route::get('/questions', [App\Http\Controllers\QuestionController::class, 'index']);
Route::post('/question', [App\Http\Controllers\QuestionController::class, 'create']);
Route::delete('/questions/{question}', [App\Http\Controllers\QuestionController::class, 'delete']);

Route::get('/topics', [App\Http\Controllers\TopicController::class, 'index']);
Route::post('/topic', [App\Http\Controllers\TopicController::class, 'create']);
Route::delete('/topics/{topic}', [App\Http\Controllers\TopicController::class, 'delete']);

// Маршруты аутентификации...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Маршруты регистрации...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

