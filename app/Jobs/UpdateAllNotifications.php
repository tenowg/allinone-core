<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EveSSO\EveSSO;
use EveSSO\CharacterNotifications;
use EveEsi\Character;

class UpdateAllNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
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
