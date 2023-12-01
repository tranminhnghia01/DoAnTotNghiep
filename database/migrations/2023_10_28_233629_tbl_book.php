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
            $table->integer('service_id');
            $table->integer('wishlist_id')->nullable();
            $table->integer('shipping_id');
            $table->integer('book_total');
            $table->integer('book_status');
            $table->string('book_address');
            $table->text('book_notes')->nullable();
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
        Schema::dropIfExists('tbl_booking');
    }
};
