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
        Schema::create('phone_sms_campaign_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fy_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('campaign_id')->nullable();
            $table->integer('campaign_api_id')->nullable();
            $table->string('service_type')->nullable();
            $table->string('voice_input')->nullable();
            $table->text('message')->nullable();
            $table->boolean('is_schedule')->default(false);
            $table->string('schedule_date_np')->nullable();
            $table->date('schedule_date_en')->nullable();
            $table->string('audio_file')->nullable();
            $table->string('available_tags')->nullable();
            $table->string('action_date_np')->nullable();
            $table->date('action_date_en')->nullable();
            $table->bigInteger('action_by')->unsigned()->nullable();
            $table->foreign('action_by')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('phone_sms_campaign_messages');
    }
};
