<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_id')->after('id')->nullable();
            $table->integer('role_id')->after('user_id')->nullable();
            $table->Text('des')->after('role_id')->nullable();
            $table->String('company')->after('des')->nullable();
            $table->string('phone')->after('password')->nullable();
            $table->string('image')->after('phone')->nullable();
            $table->integer('age')->after('image')->nullable();
            $table->integer('gender')->after('age')->nullable();
            $table->string('address')->after('gender')->nullable();
            $table->integer('status')->after('address')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
