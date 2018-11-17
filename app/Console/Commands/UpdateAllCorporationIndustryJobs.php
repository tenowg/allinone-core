<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use EveSSO\CorporationPublic;
use App\Jobs\UpdateCorporationIndustryJobs;
use EveSSO\CharacterPublic;
use EveSSO\EveSSO;
use App\Jobs\UpdateCharacterIndustryJob;

class UpdateAllCorporationIndustryJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aio:update-corporation-industry-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates all known Corporations Industry jobs if a character exists that can update them';

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
                UpdateCorporationIndustryJobs::dispatch($corp)->onQueue('long');
            }
        });
        EveSSO::chunk(100, function($chars) {
            foreach($chars as $char) {
                UpdateCharacterIndustryJob::dispatch($char)->onQueue('long');
            }
        });
    }
}
