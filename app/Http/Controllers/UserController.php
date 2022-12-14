<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$users = User::query()->get();
		return new JsonResponse([
			'data' => $users
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$created = User::query()->create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => $request->password,
		]);

		return new JsonResponse([
			'data' => $created
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user)
	{
		return new JsonResponse([
			'data' => $user
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user)
	{
		$updated = $user->update([
			'name' => $request->name ?? $user->name,
			'email' => $request->email ?? $user->email,
			'password' => $request->password ?? $user->password,
		]);

		if (!$updated) {
			return new JsonResponse([
				'errors' => [
					'Failed to update user'
				]
			]);
		} else {
			return new JsonResponse([
				'data' => $user
			]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user)
	{
		$deleted = $user->forceDelete();

		if (!$deleted) {
			return new JsonResponse([
				'errors' => [
					'Unable to delete user.'
				]
			], 400);
		} else {
			return new JsonResponse([
				'data' => "success"
			]);
		}
	}
}
