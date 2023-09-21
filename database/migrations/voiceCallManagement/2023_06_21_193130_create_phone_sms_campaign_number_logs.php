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
        Schema::create('phone_sms_campaign_number_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number_id')->nullable();
            $table->integer('number_api_id')->nullable();
            $table->string('status')->nullable();
            $table->string('date_np')->nullable();
            $table->date('date_en')->nullable();
            $table->bigInteger('action_by')->unsigned()->nullable();
            $table->foreign('action_by')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('phone_sms_campaign_number_logs');
    }
};
