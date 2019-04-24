<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        $data = [
        	[ 'name' => 'minuman' ],
        	[ 'name' => 'makanan' ],
        	[ 'name' => 'snack' ],
        ];

        DB::table('categories')->truncate();
        DB::table('categories')->insert($data);
    }
}
