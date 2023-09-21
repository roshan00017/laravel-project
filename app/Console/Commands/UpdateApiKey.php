<?php

namespace App\Console\Commands;

use App\Models\ApiSetting\ApiKey;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateApiKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apikey:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $apiKeyList = ApiKey::where('status', 1)->whereNotNull('last_access_time')->get();

        foreach ($apiKeyList as $key) {
            $now = Carbon::now();
            $createTime = \Carbon\Carbon::parse($key->last_access_time);
            $diffMinutes = $createTime->diffInHours($now);
            //            if ($diffMinutes > apiKeyExpireTimeSetting()) {
            //            }
            $val = ApiKey::where('name', $key->name)->update(['key' => ApiKey::generate()]);
        }
    }
}
