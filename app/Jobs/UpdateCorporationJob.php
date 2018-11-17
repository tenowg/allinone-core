<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EveEsi\Corporation;
use EveSSO\CorporationPublic;
use EveSSO\CharacterPublic;
use EveSSO\AlliancePublic;
use App\Jobs\UpdateAllianceByIdJob;

class UpdateCorporationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var CorporationPublic
     */
    public $corp;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CorporationPublic $corp)
    {
        $this->corp = $corp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Corporation $corp)
    {
        $corp->getCorporationPublic($this->corp->corporation_id);

        // Add the CEO Character list if they are not already there
        $ceo = CharacterPublic::find($this->corp->ceo_id);
        if (!$ceo) {
            UpdateCharacterByIdJob::dispatch($this->corp->ceo_id);
        }
        $founder = CharacterPublic::find($this->corp->creator_id);
        if (!$founder) {
            UpdateCharacterByIdJob::dispatch($this->corp->creator_id);
        }

        if ($this->corp->alliance_id) {
            $alliance = AlliancePublic::find($this->corp->alliance_id);
            if (!$alliance) {
                UpdateAllianceByIdJob::dispatch($this->corp->alliance_id);
            }
        }
    }
}
