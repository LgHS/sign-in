<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AddMembership extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'memberships:add 
                            {--user_id= : User id}
                            {--amount= : Amount in Euro}
                            {--duration= : Duration in month}
                            {--transaction_type_id= : 1 for monthly, 2 for annual}
                            {--payment_type_id= : 1 for liquid, 2 for wire}
                            {--started_at= : Date with format YYYY-mm-dd}
                            {--comment=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a transaction to a user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
    	$options = $this->options();

	    if($options['user_id'] == null) { $options['user_id'] = $this->ask('User id ?'); }
	    if(!$options['amount']) { $options['amount'] = $this->ask('Amount ?'); }
	    if(!$options['duration']) { $options['duration'] = $this->ask('Duration in month ?'); }
	    if(!$options['transaction_type_id']) { $options['transaction_type_id'] = $this->ask('Transaction type ? (1 for monthly, 2 for annual)'); }
	    if(!$options['payment_type_id']) { $options['payment_type_id'] = $this->ask('Payment Type ? (1 for liquid, 2 for wire)'); }
	    if(!$options['started_at']) { $options['started_at'] = $this->ask('Started at ? (YYYY-mm-dd)'); }

    	if($options['user_id'] == "all") {
    		if(!$this->confirm('Are you sure that you want to add a transaction to every user?')) {
    			return;
		    }

		    $users = User::all();

    		foreach($users as $user) {
    			$options['user_id'] = $user->id;
			    $this->_createTransaction($options);
		    }
	    } else {
		    $this->_createTransaction($options);
	    }
    }

    private function _createTransaction($options) {
	    $transaction = new Transaction([
		    'user_id' => intval($options['user_id']),
		    'transaction_type_id' => intval($options['transaction_type_id']),
		    'amount' => intval($options['amount']),
		    'payment_type_id' => intval($options['payment_type_id']),
		    'started_at' => $options['started_at'],
		    'registered_at' => Carbon::now()->toDateTimeString(),
		    'duration' => intval($options['duration']),
	    ]);
	    $transaction->save();
    }
}
