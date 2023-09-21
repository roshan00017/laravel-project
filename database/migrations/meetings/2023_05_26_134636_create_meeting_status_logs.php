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
        Schema::create('meeting_status_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('meeting_id')->unsigned()->nullable();
            $table->foreign('meeting_id')->references('id')->on('meetings')->onUpdate('cascade');
            $table->bigInteger('meeting_status_id')->unsigned()->nullable();
            $table->foreign('meeting_status_id')->references('id')->on('mst_meeting_statuses')->onUpdate('cascade');
            $table->text('remarks')->nullable();
            $table->string('updated_date_np')->nullable();
            $table->date('updated_date_en')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('meeting_status_logs');
    }
};
