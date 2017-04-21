<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportMemberships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membership:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import memberships from Galette';

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
    public function handle() {
        //
    }
}
