<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class ImportMemberships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'memberships:import {path}';

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

    public function handle() {
    	$transactions = [];
    	Excel::load($this->argument('path'))->each(function(Collection $line) {
    		if(!$line->get('user_id')) {
    			$this->warn('Skipping line without user id');
    			return;
		    }
    		$this->info("Importing transaction for user with id " . $line->get('user_id'));

    		$transaction = new Transaction([
			    'user_id' => $line->get('user_id'),
			    'transaction_type_id' => 1,
			    'amount' => $line->get('amount'),
			    'payment_type_id' => $line->get('payment_type'),
			    'started_at' => $line->get('started_at'),
			    'registered_at' => $line->get('registered_at'),
			    'duration' => $line->get('duration'),
		    ]);

    		$transaction->save();
	    });
    }
}
