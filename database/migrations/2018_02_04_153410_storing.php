<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Storing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('case_number', 15);
            $table->integer('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->integer('cities_id')->unsigned();
            $table->foreign('cities_id')->references('id')->on('cities')->onDelete('cascade');
            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->integer('archive_id')->unsigned();
            $table->foreign('archive_id')->references('id')->on('archives')->onDelete('cascade');
            $table->integer('box_id')->unsigned();
            $table->foreign('box_id')->references('id')->on('boxes')->onDelete('cascade');
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('storings');
    }

}
