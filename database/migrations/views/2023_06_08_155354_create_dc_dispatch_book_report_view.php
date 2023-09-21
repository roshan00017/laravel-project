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
        return 'CREATE VIEW dc_dispatch_book_report_view AS
                SELECT 
                    dc_dispatch_book.id as dc_dispatch_id, 
                    dc_dispatch_book.fiscal_year_id as fy_id, 
                    dc_dispatch_book.client_id as client_id, 
                    dc_dispatch_book.letter_status as status_id,
                    dc_dispatch_book.dispatch_month_code as month_code
                FROM dc_dispatch_book';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return 'DROP VIEW IF EXISTS dc_dispatch_book_report_view';
    }
};
