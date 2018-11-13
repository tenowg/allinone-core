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
use EveSSO\CorporationPublic;

class UpdateCharacterJob implements ShouldQueue
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
    public function handle(Character $char, Corporation $corp)
    {
        UpdateCharacterTitlesJob::dispatch($this->sso);
        UpdateCharacterRolesJob::dispatch($this->sso);
        UpdateCharacterNotificationsJob::dispatch($this->sso);
        UpdateCharacterStatsJob::dispatch($this->sso);
        $char->getCharacterPublic($this->sso);

        $this->sso->refresh();

        if ($this->sso->characterPublic) {
            if (!CorporationPublic::whereCorporationId($this->sso->characterPublic->corporation_id)->first()) {
                UpdateCorporationByIdJob::dispatch($this->sso->characterPublic->corporation_id);
            }
        }
    }
}
