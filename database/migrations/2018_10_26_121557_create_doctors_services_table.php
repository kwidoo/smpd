<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDoctorsServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doctors_services', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('doctor_id')->unsigned()->index('doctors_services_doctor_id_foreign');
			$table->integer('service_id')->unsigned()->index('doctors_services_service_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('doctors_services');
	}

}
