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
        Schema::create('calendar_holidays', function (Blueprint $table) {
            $table->id();
            $table->string('name_np');
            $table->string('name_en');
            $table->string('date_np');
            $table->string('description')->nullable();
            $table->string('date_en')->nullable();
            $table->enum('holiday_type', ['all', 'province_only', 'valley_only', 'district_only', 'local_body_only', 'ward_only']);
            $table->boolean('status')->default(true);
            $table->boolean('is_notify')->default(false);
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
        Schema::dropIfExists('calendar_holidays');
    }
};
