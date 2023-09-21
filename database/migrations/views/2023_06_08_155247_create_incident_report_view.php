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
        return 'CREATE VIEW incident_report_view AS
                SELECT 
                    incident_reportings.id as incident_id, 
                    incident_reportings.fy_id as fy_id, 
                    incident_reportings.client_id as client_id, 
                    incident_reportings.incident_month_code as month_code
                FROM incident_reportings';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return 'DROP VIEW IF EXISTS incident_report_view';
    }
};
