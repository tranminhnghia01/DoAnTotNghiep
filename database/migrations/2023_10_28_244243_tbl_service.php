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
        Schema::create('tbl_service', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id');
            $table->String('service_name');
            $table->String('service_image');
            $table->text('service_des');
            $table->text('service_slug');
            $table->text('service_tags');
            $table->text('service_content');
            $table->integer('service_status');
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
        Schema::dropIfExists('tbl_service');
    }
};