<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
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

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class,'show']);

Route::group(['middleware'=>['auth']], function(){

Route::post('/posts/',
[PostController::class, 'store'])->name('posts.create');
Route::post('/posts/{post}',[PostController::class, 'update']);
Route::delete('/posts/{post}', [PostController::class, 'destroy']);
Route::post('/posts/{post}/comments',[CommentController::class,'store']);
Route::delete('/comments/{comment}',[CommentController::class,'destory']);

 Route::post('/logout',[LogoutController::class,'logout']);
Route::post('/refresh',[LogoutController::class,'refreshToken']);
Route::get('/profile',[LoginController::class, 'getMyProfile']);
Route::get('/my-posts/{user_id}',[PostController::class,'getMyPosts']);
});

Route::post('/register', [RegisterController::class,'register']);
Route::post('/login/',[LoginController::class,'login']);

