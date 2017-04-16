<?php

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$liquid = new PaymentType();
    	$liquid->name = "Liquide";
    	$liquid->save();

    	$wire = new PaymentType();
    	$wire->name = "Versement";
    	$wire->save();
    }
}
