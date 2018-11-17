<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use EveSSO\CorporationPublic;
use App\Jobs\UpdateCorporationJob;

class UpdateAllCorporations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aio:update-corporations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update All known Corporations.';

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
                UpdateCorporationJob::dispatch($corp);
            }
        });
    }
}
