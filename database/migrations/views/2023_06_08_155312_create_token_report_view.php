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
        return 'CREATE VIEW token_report_view AS
                SELECT 
                    tokens.id as token_id, 
                    tokens.fy_id as fy_id, 
                    tokens.client_id as client_id, 
                    tokens.module_status_id as status_id,
                    tokens.status_title_en as status_title_en,
                    tokens.module_name as module,
                    tokens.module_service_name as service_name,
                    tokens.token_month_code as month_code
                FROM tokens';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return 'DROP VIEW IF EXISTS token_report_view';
    }
};
