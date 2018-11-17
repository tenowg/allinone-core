<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use EveSSO\CorporationPublic;
use EveEsi\Corporation;
use App\Traits\CorporationRoles;

class UpdateCorporationAssets implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, CorporationRoles;

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
    public function handle(Corporation $esi)
    {
        // We need a character that has the Diretor role
        $char = $this->getFirstWithCorporateRole($this->corp, 'Director');

        if ($char) {
            $esi->getCorporationAssets($char);
        }
    }
}
