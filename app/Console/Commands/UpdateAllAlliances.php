<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use EveSSO\AlliancePublic;
use App\UpdateAllianceJob;

class UpdateAllAlliances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aio:update-alliances';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all Known alliances.';

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
        AlliancePublic::chunk(100, function($alliances) {
            foreach($alliances as $alliance) {
                UpdateAllianceJob::dispatch($alliance);
            }
        });
    }
}
