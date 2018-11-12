<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EveEsi\Alliance;

class UpdateAllianceByIdJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $alliance_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $alliance_id)
    {
        $this->alliance_id = $alliance_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Alliance $esi)
    {
        $esi->getAlliancePublic($this->alliance_id);
    }
}
