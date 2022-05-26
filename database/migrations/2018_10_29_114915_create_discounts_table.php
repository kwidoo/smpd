<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('services_pivot_id')->unsigned();
            $table->foreign('services_pivot_id')->references('id')->on('services_pivots');
            $table->timestamp('starts_on')->nullable();              
            $table->timestamp('ends_on')->nullable();   
            $table->smallInteger('type')->default(0);
            $table->text('value');           
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
        Schema::dropIfExists('discounts');
    }
}
