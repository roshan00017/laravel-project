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
        Schema::create('meeting_members', function (Blueprint $table) {
            $table->id();
            $table->integer('fy_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('karyapalika_member_id')->nullable();
            $table->foreignId('meeting_id')->constrained('meetings');
            $table->string('name_en');
            $table->string('name_np');
            $table->string('office');
            $table->string('post');
            $table->string('contact_no');
            $table->boolean('is_present')->default(true);
            $table->string('email');
            $table->boolean('is_invite')->default(false);
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
        Schema::dropIfExists('meeting_members');
    }
};
