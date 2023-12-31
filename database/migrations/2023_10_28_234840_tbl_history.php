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
            $table->increments('history_id');
            $table->integer('book_id');
            $table->string('housekeeper_id');
            $table->string('history_notes')->nullable();
            $table->string('history_refund')->nullable();
            $table->integer('date_finish')->nullable();
            $table->integer('history_previous_date')->nullable();
            $table->integer('history_status');
            $table->integer('processing')->default(1);
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
