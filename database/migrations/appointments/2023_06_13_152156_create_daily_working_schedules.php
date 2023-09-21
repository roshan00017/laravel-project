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
        Schema::create('daily_working_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('fy_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->text('details')->nullable();
            $table->string('duration')->nullable();
            $table->date('schedule_date_en')->nullable();
            $table->string('schedule_date_np')->nullable();
            $table->date('schedule_end_date_en')->nullable();
            $table->string('schedule_end_date_np')->nullable();
            $table->boolean('is_schedule_same_day')->default(true);
            $table->date('schedule_added_date_en')->nullable();
            $table->string('schedule_added_date_np')->nullable();
            $table->enum('schedule_type', ['km', 'om'])->nullable();
            $table->integer('schedule_to_person_id')->nullable();
            $table->bigInteger('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('schedule_types')->onDelete('cascade');
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('daily_working_schedules');
    }
};
