<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDoctorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doctors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order')->default(99);
			$table->boolean('published')->default(0);
			$table->text('name_lv', 65535);
			$table->text('name_ru', 65535)->nullable()->default('');
			$table->text('small_lv', 65535)->nullable();
			$table->text('small_ru', 65535)->nullable();
			$table->text('title_lv', 65535);
			$table->text('title_ru', 65535);
			$table->text('text_lv');
			$table->text('text_ru')->nullable();
			$table->text('avatar')->nullable();
			$table->text('image')->nullable();
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
		Schema::drop('doctors');
	}

}
