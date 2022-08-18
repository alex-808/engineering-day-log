<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NoteController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$notes = Note::query()->get();
		return new JsonResponse([
			'data' => $notes
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
		$created = Note::query()->create([
			'user_id' => $request->user_id,
			'content' => $request->content,
		]);
		return new JsonResponse([
			'data' => $created
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$note = Note::query()->find($id);
		return new JsonResponse([
			'data' => $note
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$note = Note::query()->find($id);
		$updated = $note->update([
			'content' => $request->content ?? $note->content
		]);
		if (!$updated) {
			return new JsonResponse([
				'errors' => [
					'Failed to update model.'
				]
			], 400);
		} else {
			return new JsonResponse([
				'data' => Note::query()->find($id)
			]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$note = Note::query()->find($id);
		$deleted = $note->forceDelete();

		if (!$deleted) {
			return new JsonResponse([
				'errors' => [
					'Could not delete resource.'
				]
			], 400);
		} else {
			return new JsonResponse([
				'data' => 'success'
			]);
		}
	}
}
