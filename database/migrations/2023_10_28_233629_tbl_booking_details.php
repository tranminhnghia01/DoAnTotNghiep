<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_booking_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('book_id');
            $table->string('book_date');
            $table->string('book_time_start');
            $table->integer('book_time_number');
            $table->integer('book_total');
            $table->string('book_options');
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
        Schema::dropIfExists('tbl_booking_details');
    }
};
