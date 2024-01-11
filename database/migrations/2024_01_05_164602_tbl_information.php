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
        Schema::create('tbl_infomation', function (Blueprint $table) {
            $table->increments('info_id');
            $table->text('info_map');
            $table->string('info_address');
            $table->string('info_email');
            $table->string('info_phone');
            $table->string('info_fanpage');
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
        Schema::dropIfExists('tbl_infomation');
    }
};
