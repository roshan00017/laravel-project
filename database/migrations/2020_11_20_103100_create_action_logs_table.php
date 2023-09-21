<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('client_id')->nullable();
            $table->foreignId('action_user_id');
            $table->bigInteger('action_id')->nullable();
            $table->date('action_date')->nullable();
            $table->string('action_date_np')->nullable();
            $table->string('action_device')->nullable();
            $table->string('action_ip')->nullable();
            $table->string('action_module')->nullable();
            $table->string('action_name')->nullable();
            $table->string('action_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_logs');
    }
}
