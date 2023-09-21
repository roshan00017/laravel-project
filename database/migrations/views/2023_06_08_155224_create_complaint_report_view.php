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
        return 'CREATE VIEW complaint_report_view AS
                SELECT 
                    complaints.id as complaint_id, 
                    complaints.fy_id as fy_id, 
                    complaints.client_id as client_id, 
                    complaints.status as status_id,
                    complaints.form_category_id as source_id,
                    complaints.complaint_month_code as month_code
                FROM complaints';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return 'DROP VIEW IF EXISTS complaint_report_view';
    }
};
