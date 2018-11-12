<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EveSSO\EveSSO;
use EveEsi\Character;

class UpdateCharacterStatsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   /**
     * @var EveSSO
     */
    public $sso;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(EveSSO $sso)
    {
        $this->sso = $sso;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Character $char)
    {
        $char->getStats($this->sso);
    }
}
