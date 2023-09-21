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
        Schema::create('official_details', function (Blueprint $table) {
            $table->id();
            $table->string('present/past');
            $table->string('termCommencementDate');
            $table->string('termEndedDate');
            $table->string('Email');
            $table->string('Mobile');
            $table->string('Status');
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
        Schema::dropIfExists('official_details');
    }
};
