<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('services', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('published')->default(1);
			$table->boolean('order')->default(99);
			$table->text('name_lv', 65535);
			$table->text('name_ru', 65535)->nullable();
			$table->text('avatar')->nullable();
			$table->text('image')->nullable();
			$table->text('text_lv');
			$table->text('text_ru')->nullable();
			$table->text('doctors_lv', 65535);
			$table->text('doctors_ru', 65535);
			$table->text('time', 65535);
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
		Schema::drop('services');
	}

}
