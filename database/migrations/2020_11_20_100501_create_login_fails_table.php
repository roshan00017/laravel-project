<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginFailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_fails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('client_id')->nullable();
            $table->string('user_name');
            $table->foreignId('user_id')->nullable();
            $table->string('fail_password');
            $table->string('log_in_ip');
            $table->date('log_fails_date')->nullable();
            $table->string('log_fails_date_np')->nullable();
            $table->string('log_in_device');
            $table->bigInteger('login_fail_count')->nullable();
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
        Schema::dropIfExists('login_fails');
    }
}
