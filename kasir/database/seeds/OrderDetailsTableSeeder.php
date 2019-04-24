<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($i=0; $i < 100; $i++) { 
        	$data[] = [
        		'order_id' => rand(1, 20),
        		'product_id' => rand(1, 20),
        		'quantity' => rand(1, 20),
        		'subtotal' => rand(10, 50) * 1000,
        		'note' => $faker->sentence()
        	];
        }

        DB::table('order_details')->truncate();
        DB::table('order_details')->insert($data);
    }
}
