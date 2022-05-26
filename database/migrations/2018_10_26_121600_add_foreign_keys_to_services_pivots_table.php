<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToServicesPivotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('services_pivots', function(Blueprint $table)
		{
			$table->foreign('services_id', 'services_pivots_service_id_foreign')->references('id')->on('services')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('services_pivots', function(Blueprint $table)
		{
			$table->dropForeign('services_pivots_service_id_foreign');
		});
	}

}
