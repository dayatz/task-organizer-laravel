<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('board_history', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('board_id');
			$table->integer('user_id');
			$table->string('did'); // delete, edit, add
			$table->string('history'); // board, card, todo
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
		Schema::drop('board_history');
	}

}
