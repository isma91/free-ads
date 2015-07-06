<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessage extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('sender_id');
			$table->integer('recever_id');
			$table->string('titre', 100);
			$table->text('content');
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
			$table->text('remember_token');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
