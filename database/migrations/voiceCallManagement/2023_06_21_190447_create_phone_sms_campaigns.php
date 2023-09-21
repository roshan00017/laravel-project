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
        Schema::create('phone_sms_campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fy_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->enum('module_name', ['edmis', 'ghs', 'mms', 'dcc', 'all']);
            $table->string('module_unique_id')->nullable();
            $table->string('campaign_name')->nullable();
            $table->text('campaign_detail')->nullable();
            $table->integer('campaign_number_count')->nullable();
            $table->string('campaign_service')->nullable();
            $table->string('campaign_status')->nullable();
            $table->integer('campaign_api_id')->nullable();
            $table->string('campaign_added_date_np')->nullable();
            $table->date('campaign_added_date_en')->nullable();
            $table->bigInteger('campaign_run_by')->unsigned()->nullable();
            $table->foreign('campaign_run_by')->references('id')->on('users')->onUpdate('cascade');
            $table->string('campaign_run_date_np')->nullable();
            $table->date('campaign_run_date_en')->nullable();
            $table->bigInteger('campaign_re_run_by')->unsigned()->nullable();
            $table->foreign('campaign_re_run_by')->references('id')->on('users')->onUpdate('cascade');
            $table->string('campaign_re_run_date_np')->nullable();
            $table->date('campaign_re_run_date_en')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade');
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('phone_sms_campaigns');
    }
};
