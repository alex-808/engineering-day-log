<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
	public function register(Request $request)
	{

		// validates name, email, password
		$attr = $request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|unique:users,email',
			'password' => 'required|string|min:6|confirmed',
		]);

		// creates new user
		$user = User::create([
			'name' => $attr['name'],
			'email' => $attr['email'],
			'password' => $attr['password'],
		]);

		//returns token
		return new JsonResponse(['message' => "success"]);
		//return new JsonResponse(['token' => $user->createToken('API Token')->plainTextToken]);
	}

	public function login()
	{
		// looks up model instance with email and password 
		// returns token if exists

	}
	public function logout()
	{
		//destroys token
		auth()->user()->tokens()->delete();
		return [
			'message' => 'Tokens Revoked'
		];
	}
}
