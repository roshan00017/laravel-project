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
        Schema::create('appointment_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('appointment_id')->nullable();
            $table->date('appointment_date_ad')->nullable();
            $table->string('appointment_date_bs')->nullable();
            $table->string('appointment_time')->nullable();
            $table->enum('appointment_section', ['km', 'om'])->nullable();
            $table->integer('appointment_to_person_id')->nullable();
            $table->text('appointment_reason')->nullable();
            $table->string('action_date_bs')->nullable();
            $table->date('action_date_ad')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('status_date_en')->nullable();
            $table->string('status_date_np')->nullable();
            $table->enum('appointment_type', ['p', 's'])->nullable();
            $table->integer('action_by')->nullable();
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
        Schema::dropIfExists('appointment_logs');
    }
};
