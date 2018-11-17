<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use EveSSO\EveSSO;
use App\Jobs\UpdateCharacterNotificationsJob;

class UpdateNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aio:update-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        EveSSO::chunk(100, function ($users) {
            foreach($users as $user) {
                UpdateCharacterNotificationsJob::dispatch($user)->onQueue('long');
            }
        });
    }
}
