<?php

namespace App\Console\Commands;

use App\Helpers\AppClientApiHelper;
use App\Models\MasterSettings\Notice;
use Illuminate\Console\Command;

class AddNotice extends Command
{
    protected $signature = 'notice:add';

    protected $description = 'Insert data into notices table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $notices = AppClientApiHelper::getApiData('articles-api');

        foreach ($notices as $key => $value) {
            $existingNotice = Notice::where('title', $value['Title'])->first();

            if ($existingNotice) {
                $existingNotice->tag = $value['Tags'];
                $existingNotice->description = $value['Body'];
                $existingNotice->file = $value['Image'];

                $existingNotice->save();

                $this->info('Notice with title "'.$value['Title'].'" updated successfully!');
            } else {
                $notice = new Notice();

                $notice->fy_id = currentFy()->id;
                $notice->client_id = clientInfo()->id;

                $notice->title = $value['Title'];
                $notice->tag = $value['Tags'];
                $notice->description = $value['Body'];
                $notice->file = $value['Image'];

                $notice->save();

                $this->info('New notice with title "'.$value['Title'].'" added successfully!');
            }
        }
    }
}
