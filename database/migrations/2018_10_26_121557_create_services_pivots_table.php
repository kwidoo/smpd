<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesPivotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('services_pivots', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order')->default(99);
			$table->integer('services_id')->unsigned()->index('services_pivots_service_id_foreign');
			$table->integer('services2_id')->unsigned();
			$table->text('name_lv', 65535)->nullable();
			$table->text('name_ru', 65535)->nullable();
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
		Schema::drop('services_pivots');
	}

}
