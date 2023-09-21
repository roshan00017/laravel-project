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
        Schema::create('complaint_progress_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('complaint_id')->nullable();
            $table->integer('action_type_id')->nullable();
            $table->string('action_code')->nullable();
            $table->integer('source_id')->nullable();
            $table->text('description')->nullable();
            $table->text('public_description')->nullable();
            $table->text('caller_inquiry')->nullable();
            $table->text('public_caller_inquiry')->nullable();
            $table->text('caller_response')->nullable();
            $table->text('public_caller_response')->nullable();
            $table->string('responding_office')->nullable();
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
        Schema::dropIfExists('complaint_progress_infos');
    }
};
