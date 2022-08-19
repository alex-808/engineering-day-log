<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$tags = Tag::query()->get();
		return new JsonResponse([
			'data' => $tags
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreTagRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$created = Tag::query()->create([
			'user_id' => $request->user_id,
			'name' => $request->name
		]);

		if (!$created) {
			return new JsonResponse([
				'errors' => [
					'Failed to create tag'
				]
			]);
		} else {
			return new JsonResponse([
				'data' => $created
			]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Tag  $tag
	 * @return \Illuminate\Http\Response
	 */
	public function show(Tag $tag)
	{
		return new JsonResponse([
			'data' => $tag
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateTagRequest  $request
	 * @param  \App\Models\Tag  $tag
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Tag $tag)
	{
		$updated = $tag->update([
			'name' => $request->name,
		]);

		if (!$updated) {
			return new JsonResponse([
				'errors' => [
					'Failed to update tag.'
				]
			]);
		} else {
			return new JsonResponse([
				'data' => $tag
			]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Tag  $tag
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Tag $tag)
	{
		$deleted = $tag->forceDelete();
		if (!$deleted) {
			return new JsonResponse([
				'errors' => [
					'Failed to delete tag.'
				]
			]);
		} else {
			return new JsonResponse([
				'data' => 'success'
			]);
		}
	}
}