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

	public function store(Request $request)
	{
		$created = Note::query()->create([
			'user_id' => $request->user_id,
			'content' => $request->content,
		]);
		if (!$created) {
			return new JsonResponse(
				['errors' => "Failed to create note."]
			);
		} else {
			return new JsonResponse([
				'data' => $created
			]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Note  $note
	 * @return \Illuminate\Http\Response
	 */
	public function show(Note $note)
	{
		return new JsonResponse([
			'data' => $note
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Note  $note
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Note $note)
	{
		$updated = $note->update([
			'content' => $request->content
		]);

		if (!$updated) {
			return new JsonResponse([
				'errors' => [
					'Failed to updated note'
				]
			]);
		} else {
			return new JsonResponse([
				'data' => $note
			]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Note  $note
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Note $note)
	{
		$deleted = $note->forceDelete();
		if (!$deleted) {
			return new JsonResponse([
				'errors' => [
					"Unable to delete note."
				]
			], 400);
		} else {
			return new JsonResponse([
				'data' => "success"
			]);
		}
	}
}
