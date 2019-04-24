<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('it_IT');

        for ($i=0; $i < 20; $i++) { 
        	$data[] = [
        		'user_id' => 1,
        		'payment_id' => rand(1,3),
        		'table_number' => rand(1,10),
        		'total' => rand(1,50) * 10000,
        	];
        }

        DB::table('orders')->truncate();
        DB::table('orders')->insert($data);
    }
}
