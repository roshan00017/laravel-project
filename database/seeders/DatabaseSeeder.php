<?php

namespace Database\Seeders;

use Database\Seeders\Calendar\CalendarMonthTableSeeder;
use Database\Seeders\Calendar\CalendarTableSeeder;
use Database\Seeders\Calendar\CalendarWeekDayTableSeeder;
use Database\Seeders\Calendar\MstFiscalYearTableSeeder;
use Database\Seeders\MasterSettings\DistrictTableSeeder;
use Database\Seeders\MasterSettings\LocalBodyTableSeeder;
use Database\Seeders\MasterSettings\LocalBodyTypeTableSeeder;
use Database\Seeders\MasterSettings\MeetingCategoriesTableSeeder;
use Database\Seeders\MasterSettings\ProvinceTableSeeder;
use Database\Seeders\MasterSettings\ServicesSeeder;
use Database\Seeders\MasterSettings\ServiceTypeSeeder;
use Database\Seeders\MasterSettings\StatusSeeder;
use Database\Seeders\SystemSettings\AppSettingTableSeeder;
use Database\Seeders\SystemSettings\MailSettingTableSeeder;
use Database\Seeders\SystemSettings\OtpSettingTableSeeder;
use Database\Seeders\SystemSettings\SmsSettingTableSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        // check foreign  key
        if (env('DB_CONNECTION') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        $this->call(MenusTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LoginLogTableSeeder::class);
        $this->call(AppSettingTableSeeder::class);
        $this->call(SmsSettingTableSeeder::class);
        $this->call(MailSettingTableSeeder::class);
        $this->call(OtpSettingTableSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(MeetingCategoriesTableSeeder::class);
        $this->call(MstFiscalYearTableSeeder::class);
        $this->call(CalendarMonthTableSeeder::class);
        $this->call(CalendarWeekDayTableSeeder::class);
        $this->call(CalendarTableSeeder::class);
        $this->call(MeetingTableSeeder::class);
        $this->call(AppClientTableSeeder::class);
        $this->call(MstGenderTableSeeder::class);
        $this->call(ComplaintSourceTableSeeder::class);
        $this->call(SuggestionCategoryTableSeeder::class);
        $this->call(SuggestionTableSeeder::class);
        $this->call(SuggestionTableSeeder::class);
        $this->call(MasterSettingTableSeeder::class);
        $this->call(ComplaintTypeTableSeeder::class);
        $this->call(ComplaintTypeTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(DocumentTypeTableSeeder::class);
        $this->call(DcLetterSendingTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(DcOfficeTableSeeder::class);
        $this->call(MstOfficeTableSeeder::class);
        $this->call(SeverityTableSeeder::class);
        $this->call(DcStatusTableSeeder::class);
        $this->call(ComplaintStatusTableSeeder::class);
        $this->call(IncidentReportingSeeder::class);
        $this->call(ApiKeyTableSeeder::class);
        $this->call(ServiceTypeSeeder::class);
        $this->call(ServicesSeeder::class);
        $this->call(NotificationTableSeeder::class);
        $this->call(ClientSettingTableSeeder::class);
        $this->call(KaryapalikaMemberSeeder::class);
        $this->call(CalendarYearTableSeeder::class);
        $this->call(MstSettingTableSeeder::class);
        $this->call(HrDesignationTableSeeder::class);
        $this->call(HrEmployeeTableSeeder::class);
        $this->call(AppVersionTableSeeder::class);
        $this->call(MstFederalHierarchyTableSeeder::class);
        $this->call(ServiceModuleTableSeeder::class);
        $this->call(MemberTypeTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(DistrictTableSeeder::class);
        $this->call(LocalBodyTypeTableSeeder::class);
        $this->call(LocalBodyTableSeeder::class);
        $this->call(VisitingPurposeTableSeeder::class);
        $this->call(ElectedPersonTableSeeder::class);
        $this->call(SuchikritUserTableSeeder::class);
        $this->call(AppointmentStatusTableSeeder::class);
        $this->call(AppointmentAccessUserTableSeeder::class);
        $this->call(ScheduleTypeSeeder::class);
        $this->call(AppointmentTableSeeder::class);
        $this->call(ComplaintsTableSeeder::class);
        $this->call(TokenTableSeeder::class);
        $this->call(MeetingAgendaTableSeeder::class);
        $this->call(MeetingMemberTableSeeder::class);
        $this->call(GroupTableSeeder::class);
        $this->call(GroupChatTableSeeder::class);
        $this->call(GroupMembersTableSeeder::class);
        $this->call(NoticeTableSeeder::class);
        $this->call(ServiceRelatedDocumentSeeder::class);
        $this->call(EmergencyContactDetailTableSeeder::class);
    }
}
