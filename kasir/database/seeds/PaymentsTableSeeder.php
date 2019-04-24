<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class PaymentsTableSeeder extends Seeder
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
        	[ 'name' => 'credit' ],
        	[ 'name' => 'cash' ],
        	[ 'name' => 'bon' ],
        ];

        DB::table('payments')->truncate();
        DB::table('payments')->insert($data);
    }
}
