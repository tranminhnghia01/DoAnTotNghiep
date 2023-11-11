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
        Schema::create('tbl_coupon', function (Blueprint $table) {
            $table->increments('id');
            $table->String('coupon_name');
            $table->String('coupon_code');
            $table->String('coupon_des');
            $table->text('coupon_content');
            $table->integer('coupon_time_start');
            $table->integer('coupon_time_end');
            $table->integer('coupon_method');
            $table->integer('coupon_number');
            $table->text('coupon_status');
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
        Schema::dropIfExists('tbl_coupon');
    }
};
