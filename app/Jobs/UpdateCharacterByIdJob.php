<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\UpdateCorporationJob;
use EveSSO\EveSSO;
use EveEsi\Character;
use EveEsi\Corporation;

class UpdateCharacterByIdJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $char_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $char_id)
    {
        $this->char_id = $char_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Character $char, Corporation $corp)
    {
        $public = $char->getCharacterPublic($this->char_id);
        
    }
}
