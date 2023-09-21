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
        return 'CREATE VIEW appointment_report_view AS
                SELECT 
                    appointments.id as appointment_id, 
                    appointments.fy_id as fy_id, 
                    appointments.client_id as client_id, 
                    appointments.appointment_status as status_id, 
                    appointments.visiting_section as appointment_section, 
                    appointments.visiting_to_person_id as appointment_to_person_id, 
                    appointments.appointment_month_code as month_code
                FROM appointments';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return 'DROP VIEW IF EXISTS appointment_report_view';
    }
};
