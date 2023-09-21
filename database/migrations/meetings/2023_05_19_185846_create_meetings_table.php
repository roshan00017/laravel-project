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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('fy_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('code')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('meeting_category_id')->constrained('mst_meeting_categories')->nullable();
            $table->date('proposed_date_ad')->nullable();
            $table->string('proposed_date_bs')->nullable();
            $table->time('proposed_time')->nullable();
            $table->boolean('agenda_finalized')->default(false);
            $table->string('agenda_finalized_date_bs')->nullable();
            $table->date('agenda_finalized_date_ad')->nullable();
            $table->boolean('is_notify')->default(false);
            $table->string('notify_date_bs')->nullable();
            $table->date('notify_date_ad')->nullable();
            $table->bigInteger('meeting_status_id')->unsigned()->nullable();
            $table->foreign('meeting_status_id')->references('id')->on('mst_meeting_statuses')->onUpdate('cascade');
            $table->date('meeting_date_ad')->nullable();
            $table->string('meeting_date_bs')->nullable();
            $table->time('meeting_time')->nullable();
            $table->string('room_no')->nullable();
            $table->string('meeting_venue')->nullable();
            $table->enum('meeting_mode', ['online', 'offline'])->default('offline');
            $table->string('meeting_url')->nullable();
            $table->boolean('meeting_password_available')->default(false);
            $table->string('meeting_password')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('meeting_month_code')->nullable();
            $table->boolean('is_public')->default(false);
            $table->text('meeting_iframe')->nullable();
            $table->boolean('is_campaign_create')->default(false);
            $table->integer('campaign_id')->nullable();
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
        Schema::dropIfExists('meetings');
    }
};
