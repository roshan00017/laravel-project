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
        Schema::create('appointment_access_users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->enum('access_user_type', ['km', 'om'])->nullable();
            $table->integer('appointment_access_user_id')->nullable();
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
        Schema::dropIfExists('appointment_access_users');
    }
};
