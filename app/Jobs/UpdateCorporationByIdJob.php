<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EveEsi\Corporation;
use EveSSO\AlliancePublic;
use App\Jobs\UpdateAllianceByIdJob;

class UpdateCorporationByIdJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $corp;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $corp_id)
    {
        $this->corp = $corp_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Corporation $corp)
    {
        $update = $corp->getCorporationPublic($this->corp);

        $founder = CharacterPublic::find($update->creator_id);
        if (!$founder) {
            UpdateCharacterByIdJob::dispatch($update->creator_id);
        }

        if ($this->corp->alliance_id) {
            $alliance = AlliancePublic::find($this->corp->alliance_id);
            if (!$alliance) {
                UpdateAllianceByIdJob::dispatch($this->corp->alliance_id);
            }
        }
    }
}
