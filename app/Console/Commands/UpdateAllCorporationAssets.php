<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use EveSSO\CorporationPublic;
use App\Jobs\UpdateCorporationAssets;

class UpdateAllCorporationAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aio:update-all-corporation-assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all the assets for all known corporations.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        CorporationPublic::chunk(100, function($corps) {
            foreach($corps as $corp) {
                UpdateCorporationAssets::dispatch($corp)->onQueue('long');
            }
        });
    }
}
