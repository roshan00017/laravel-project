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
        Schema::create('complainers', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->integer('complaint_id')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_ne')->nullable();
            $table->integer('gender_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('province_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('local_government_id')->nullable();
            $table->string('ward')->nullable();
            $table->string('place')->nullable();
            $table->string('tole')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('complainers');
    }
};
