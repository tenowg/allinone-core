<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EveSSO\AlliancePublic;
use EveEsi\Alliance;

class UpdateAllianceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var AlliancePublic
     */
    public $alliance;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(AlliancePublic $alliance)
    {
        $this->alliance = $alliance;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Alliance $esi)
    {
        $esi->getAlliancePublic($this->alliance->alliance_id);
    }
}
