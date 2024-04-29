<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'id' => '1001',
            'status' => 'WAITING FOR SUBMISSION'
        ]);
        DB::table('status')->insert([
            'id' => '1002',
            'status' => 'REQUEST SUBMITTED'
        ]);
        DB::table('status')->insert([
            'id' => '1003',
            'status' => 'WAITING FOR CONVERSION'
        ]);
        DB::table('status')->insert([
            'id' => '1004',
            'status' => 'WAITING ON SALES'
        ]);
        DB::table('status')->insert([
            'id' => '1005',
            'status' => 'WAITING ON DISTRIBUTOR'
        ]);
        DB::table('status')->insert([
            'id' => '1006',
            'status' => 'WAITING ON MANJUFACTURER'
        ]);
        DB::table('status')->insert([
            'id' => '1007',
            'status' => 'WAITING ON DEALER'
        ]);
        DB::table('status')->insert([
            'id' => '1008',
            'status' => 'WAITING ON DIRECT DEALER'
        ]);
        DB::table('status')->insert([
            'id' => '1009',
            'status' => 'CONFIRMED'
        ]);
        DB::table('status')->insert([
            'id' => '1010',
            'status' => 'FILLED/CLOSED'
        ]);
    }
}
