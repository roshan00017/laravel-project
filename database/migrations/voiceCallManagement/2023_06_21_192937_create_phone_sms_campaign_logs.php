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
        Schema::create('phone_sms_campaign_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('campaign_id')->nullable();
            $table->integer('campaign_api_id')->nullable();
            $table->string('action_name')->nullable();
            $table->string('action_date_np')->nullable();
            $table->date('action_date_en')->nullable();
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
        Schema::dropIfExists('phone_sms_campaign_logs');
    }
};
