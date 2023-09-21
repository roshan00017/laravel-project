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
        Schema::create('calendar_holiday_days', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('calendar_holiday_id')->unsigned()->nullable();
            $table->foreign('calendar_holiday_id')->references('id')->on('calendar_holidays')->onUpdate('cascade');
            $table->integer('gov_body_id')->nullable();
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
        Schema::dropIfExists('calendar_holiday_days');
    }
};
