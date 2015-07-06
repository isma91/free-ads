<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilisateursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('utilisateurs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('lastname', 100);
			$table->string('name', 100);
			$table->string('username', 100)->unique();
			$table->string('password', 100);
			$table->string('birthdate');
			$table->string('email')->unique();
			$table->text('remember_token');
			$table->string('bloquer', 3)->default('non');
			$table->string('valider', 3)->default('oui');
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
		Schema::drop('utilisateurs');
	}

}
