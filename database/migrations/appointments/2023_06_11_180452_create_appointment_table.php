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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('fy_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('appointment_no')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_no')->nullable();
            $table->date('appointment_date_ad')->nullable();
            $table->string('appointment_date_bs')->nullable();
            $table->time('time')->nullable();
            $table->string('address')->nullable();
            $table->enum('visiting_section', ['km', 'om'])->nullable();
            $table->integer('visiting_to_person_id')->nullable();
            $table->string('visiting_purpose_id')->nullable();
            $table->text('visiting_purpose_reason')->nullable();
            $table->date('appointment_taken_date_ad')->nullable();
            $table->string('appointment_taken_date_bs')->nullable();
            $table->integer('appointment_status')->nullable();
            $table->dateTime('visited_date_en')->nullable();
            $table->string('visited_date_np')->nullable();
            $table->integer('visit_count')->nullable();
            $table->integer('visiting_to_designation_id')->nullable();
            $table->enum('appointment_type', ['p', 's'])->nullable();
            $table->integer('appointment_month_code')->nullable();
            $table->integer('complaint_process')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('appointments');
    }
};
