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
        Schema::create('app_versions', function (Blueprint $table) {
            $table->id();
            $table->string('version_update_date_np')->nullable();
            $table->string('version_update_date_en')->nullable();
            $table->string('previous_version')->nullable();
            $table->string('version_number')->nullable();
            $table->string('version_module')->nullable();
            $table->string('version_prefix')->nullable();
            $table->string('latest_version')->nullable();
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
        Schema::dropIfExists('app_versions');
    }
};
