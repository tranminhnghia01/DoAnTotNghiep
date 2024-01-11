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
        Schema::create('payment_online', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Amount');
            $table->string('BankCode');
            $table->string('BankTranNo');
            $table->string('CardType');
            $table->string('OrderInfo');
            $table->string('PayDate');
            $table->string('ResponseCode');
            $table->string('TmnCode');
            $table->string('TransactionNo');
            $table->string('TransactionStatus');
            $table->string('TxnRef');
            $table->text('SecureHash');
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
        Schema::dropIfExists('payment_online');
    }
};
