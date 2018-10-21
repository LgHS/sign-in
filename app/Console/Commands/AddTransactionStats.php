<?php

namespace App\Console\Commands;

use App\Services\TransactionStatService;
use Illuminate\Console\Command;

class AddTransactionStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate monthly stats for transactions';

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
     */
    public function handle() {
        app(TransactionStatService::class)->generateAllStats();
    }
}
