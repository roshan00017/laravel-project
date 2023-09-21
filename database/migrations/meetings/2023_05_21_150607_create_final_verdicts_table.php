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
        Schema::create('final_verdicts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->integer('fy_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->bigInteger('meeting_id')->unsigned()->nullable();
            $table->foreign('meeting_id')->references('id')->on('meetings')->onUpdate('cascade');
            $table->bigInteger('member_id')->unsigned()->nullable();
            $table->foreign('member_id')->references('id')->on('meeting_members')->onUpdate('cascade');
            $table->bigInteger('agenda_id')->unsigned()->nullable();
            $table->foreign('agenda_id')->references('id')->on('meeting_agenda_lists')->onUpdate('cascade');
            $table->string('feedback');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('final_verdicts');
    }
};
