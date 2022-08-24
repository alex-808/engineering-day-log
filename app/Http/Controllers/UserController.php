<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	public function show()
	{
	}
	public function index()
	{
		// Index shouldn't exist?
	}
	public function destroy()
	{
		// destroy would require authentication and that you are that user
	}
	public function store()
	{
	}
}
// I'm not sure how to handle authentication and stuff. Creating a new user requires a password and a valid, non-duplicate email
