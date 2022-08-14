<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'id' => random_int(0, 99999),
			'created_at' => now(),
			'updated_at' => now(),
			'user_id' => random_int(0, 99999),
			'content' => "This is the note's content"
		];
	}
}
