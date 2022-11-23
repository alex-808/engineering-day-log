<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('note_tag', function (Blueprint $table) {

			$table->id();
			$table->integer('note_id')->unsigned();
            $table->foreign('note_id')->references('id')->on('notes');
			$table->integer('tag')->unsigned();

			$table->foreign('tag')->references('id')->on('tags');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('note_tag');
	}
};
