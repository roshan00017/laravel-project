<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function createView(): string
    {
        return 'CREATE VIEW meeting_report_view AS
                SELECT 
                    meetings.id as meeting_id, 
                    meetings.fy_id as fy_id, 
                    meetings.client_id as client_id, 
                    meetings.meeting_status_id as status_id,
                    meetings.meeting_month_code as month_code
                FROM meetings';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return 'DROP VIEW IF EXISTS meeting_report_view';
    }
};
