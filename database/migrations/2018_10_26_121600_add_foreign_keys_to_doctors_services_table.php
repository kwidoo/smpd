<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDoctorsServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('doctors_services', function(Blueprint $table)
		{
			$table->foreign('doctor_id')->references('id')->on('doctors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('service_id')->references('id')->on('services')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('doctors_services', function(Blueprint $table)
		{
			$table->dropForeign('doctors_services_doctor_id_foreign');
			$table->dropForeign('doctors_services_service_id_foreign');
		});
	}

}
