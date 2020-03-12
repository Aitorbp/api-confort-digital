<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restrictions', function (Blueprint $table) {
            $table->increments('id');
            $table->time('max_time')->nullable();
            $table->dateTime('start_hour_restriction')->nullable();
            $table->dateTime('finish_hour_restriction')->nullable();
            $table->integer('user_id')->unsigned()->nullable();;
            $table->integer('application_id')->unsigned()->nullable();;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('application_id')->references('id')->on('application')->onDelete('cascade');
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
        Schema::dropIfExists('restrictions');
    }
}
