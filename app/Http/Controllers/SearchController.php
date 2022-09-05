<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function index(Request $request)
	{
		if ($request->filled('tag')) {
			// find all user notes with specified tag
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
