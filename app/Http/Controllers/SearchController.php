<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
	public function index(Request $request)
	{
		if ($request->filled('tag')) {
			//return Auth::user()->notes
			$id = Auth::id();
			return Note::query()->get()->where('user_id', '=', Auth::id())->where('tag', '=', $request['tag']);
			// find all user notes with specified tag

			// I think I'll still need a note/tag pivot table. Right now there is no way to associate one to the other
		}
		if ($request->filled('dates')) {
			// find all user notes within specified range
			// if single date provided, find all notes created on that date
		}
		return [
			'message' => 'success'
		];
	}
}
