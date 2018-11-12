<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use EveSSO\EveSSO;
use EveSSO\CharacterPublic;
use App\Jobs\UpdateCharacterByIdJob;
use App\Jobs\UpdateCharacterJob;

class UpdateAllCharactersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $char = CharacterPublic::with('sso')->get();

        // Update all character public data
        foreach($char as $c) {
            if (!$c->sso) {
                UpdateCharacterByIdJob::dispatch($c->character_id);
            } else {
                UpdateCharacterJob::dispatch($c->sso);
            }
        }
    }
}
