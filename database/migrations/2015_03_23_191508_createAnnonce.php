<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnonce extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('annonces', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('titre', 100);
			$table->integer('prix');
			$table->text('picture');
			$table->string('email', 100);
			$table->integer('numero');
			$table->string('monnaie', 10);
			$table->string('description', 255);
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
