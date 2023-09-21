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
        Schema::create('appointment_handovers', function (Blueprint $table) {
            $table->id();
            $table->integer('appointment_id')->nullable();
            $table->date('handover_date_ad')->nullable();
            $table->string('handover_date_bs')->nullable();
            $table->string('handover_time')->nullable();
            $table->enum('handover_section', ['km', 'om'])->nullable();
            $table->integer('handover_to_person_id')->nullable();
            $table->text('handover_reason')->nullable();
            $table->string('handover_taken_date_bs')->nullable();
            $table->date('handover_taken_date_ad')->nullable();
            $table->integer('handover_taken_by')->nullable();
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
        Schema::dropIfExists('appointment_handovers');
    }
};
