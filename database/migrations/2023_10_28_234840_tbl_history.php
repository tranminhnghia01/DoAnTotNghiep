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
        Schema::create('tbl_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('history_id');
            $table->integer('book_id');
            $table->string('collaborators_id');
            $table->string('history_des');
            $table->string('history_content');
            $table->integer('history_status');


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
        Schema::dropIfExists('tbl_history');
    }
};
