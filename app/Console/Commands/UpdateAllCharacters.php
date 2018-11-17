<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use EveSSO\EveSSO;
use EveSSO\CharacterPublic;
use App\Jobs\UpdateCharacterByIdJob;
use App\Jobs\UpdateCharacterJob;

class UpdateAllCharacters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aio:update-characters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all the public information about all the characters in the system.';

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
        CharacterPublic::with('sso')->chunk(100, function($char) {
            foreach($char as $c) {
                if (!$c->sso) {
                    UpdateCharacterByIdJob::dispatch($c->character_id);
                } else {
                    UpdateCharacterJob::dispatch($c->sso);
                }
        }
        });   
    }
}
