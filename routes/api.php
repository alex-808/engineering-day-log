<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
	Route::post('/notes/{note}/tags/{tag}', 'App\Http\Controllers\NoteController@addTag');
	Route::delete('/notes/{note}/tags/{tag}', 'App\Http\Controllers\NoteController@removeTag');
	Route::apiResource('notes', NoteController::class);
	Route::apiResource('tags', TagController::class);
	Route::apiResource('users', UserController::class);
	Route::get('/me', function (Request $request) {
		return auth()->user();
	});

	Route::post('auth/logout', [AuthController::class, 'logout']);

	Route::post('/search', [SearchController::class, 'index']);
});

Route::middleware([])->post('/tokens/create/{user}', function (Request $request, User $user) {
	// I know I need auth middleware active to access a user
	// Requests are coming back unauthenticated
	$token = $user->createToken("API Token");

	return [
		'token' => $token
	];
});
