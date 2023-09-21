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
        return 'CREATE VIEW dc_document_report_view AS
                SELECT 
                    dc_document.id as dc_dispatch_id, 
                    dc_document.fiscal_year_id as fy_id, 
                    dc_document.client_id as client_id, 
                    dc_document.document_month_code as month_code
                FROM dc_document';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return 'DROP VIEW IF EXISTS dc_document_report_view';
    }
};
