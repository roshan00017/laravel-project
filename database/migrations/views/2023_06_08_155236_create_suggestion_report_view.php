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
        return 'CREATE VIEW suggestion_report_view AS
                SELECT 
                    suggestions.id as suggestion_id, 
                    suggestions.fy_id as fy_id, 
                    suggestions.client_id as client_id, 
                    suggestions.suggestion_category_id as category_id,
                    suggestions.suggestion_month_code as month_code
                FROM suggestions';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return 'DROP VIEW IF EXISTS suggestion_report_view';
    }
};
