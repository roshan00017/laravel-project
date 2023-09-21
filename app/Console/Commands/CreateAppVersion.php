<?php

namespace App\Console\Commands;

use App\Facades\NepaliDate;
use App\Models\MasterSettings\AppVersion;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateAppVersion extends Command
{
    /**k
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:commit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set app version commit';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data['version_update_date_np'] = NepaliDate::create(Carbon::now())->toBS();
        $data['version_update_date_en'] = Carbon::now()->toDateString();
        //check previous  version
        $previousVersion = AppVersion::query()->orderBy('id', 'desc')->latest()->first();
        $data['previous_version'] = $previousVersion->version_number;
        $data['version_module'] = $previousVersion->version_module;
        $data['version_number'] = $previousVersion->version_number + 1;
        $data['version_prefix'] = date('dmY');
        $data['latest_version'] = $data['version_prefix'].' '.$previousVersion->version_module.'.'.$data['version_number'];
        $version = AppVersion::FirstOrCreate($data);

        $this->info('Version updated successfully. New version  is '.$version['latest_version']);
    }
}
