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
        Schema::create('tbl_booking', function (Blueprint $table) {
            $table->increments('id');
            $table->string('book_id');
            $table->string('service_id');
            $table->integer('shipping_id');
            $table->integer('payment_id');
            $table->integer('coupon_id');
            $table->string('book_address');
            $table->date('book_date');
            $table->time('book_time_start');
            $table->time('book_time_end');
            $table->time('book_time_total');
            $table->string('book_total');
            $table->string('book_options');
            $table->integer('book_status');
            $table->text('book_notes');
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
        Schema::dropIfExists('tbl_book');
    }
};