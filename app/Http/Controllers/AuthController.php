<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	public function register(Request $request)
	{

		//validates name, email, password
		$attr = $request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|unique:users,email',
			'password' => 'required|string|min:6|confirmed',
		]);

		//creates new user
		$user = User::create([
			'name' => $attr['name'],
			'email' => $attr['email'],
			'password' => Hash::make($attr['password']),
		]);

		//returns token
		return new JsonResponse(['token' => $user->createToken('API Token')->plainTextToken]);
	}

	public function login(Request $request)
	{
		$attr = $request->validate([
			'email' => 'required|string|email',
			'password' => 'required|string'
		]);
		// looks up model instance with email and password 
		//$exists = User::query()->get()->where('email', "=", $attr['email']);

		if (!Auth::attempt($attr)) {
			return [
				'message' => "Credentials do not match"
			];

			// returns token if exists
		}
		return [
			'token' => Auth::user()->createToken('API Token')->plainTextToken
		];
	}
	public function logout(Request $request)
	{
		//destroys token
		Auth::user()->tokens()->delete();

		return [
			'message' => "deleted"
		];
	}
}
