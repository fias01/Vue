<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class ProductsTableSeeder extends Seeder
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
        		'category_id' => rand(1,3),
        		'name' => $faker->firstName,
        		'price' => rand(1,50) * 1000,
        		'status' => rand(0,1),
        	];
        }

        DB::table('products')->truncate();
        DB::table('products')->insert($data);
    }
}
