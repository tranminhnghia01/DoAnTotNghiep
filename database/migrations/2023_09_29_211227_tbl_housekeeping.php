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
        Schema::create('tbl_housekeeper', function (Blueprint $table) {
            $table->increments('id');
            $table->string('housekeeper_id');
            $table->string('image');
            $table->string('phone');
            $table->integer('age');
            $table->integer('gender');
            $table->string('address');
            $table->text('des');
            $table->string('files');
            $table->integer('status');
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
        Schema::dropIfExists('tbl_housekeeper');
    }
};
