<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('merchant')->insert([
            'name' => 'Rahul gag',
            'email' => 'rahulgag@gmail.com',
            'password' => bcrypt(1234),
        ]);

         DB::table('customer')->insert([
            'name' => 'omaket salunke',
            'email' => 'omkars@gmail.com',
            'password' => bcrypt(4321),
        ]);
    }
}
