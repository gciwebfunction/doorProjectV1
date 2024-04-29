<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 100001,
            'name' => 'admin',
            'email' => 'admin@gcisoftware.com',
            'password' => Hash::make('gc1s0ftw4re!'),
            'usertype' => 'manufacturer',
            'is_admin' => 1,
        ]);
        DB::table('users')->insert([
            'id' => 100002,
            'name' => 'Billy Distributor',
            'email' => 'email@distributors.com',
            'password' => Hash::make('gc1s0ftw4re!'),
            'usertype' => 'distributor',
            'is_admin' => 1,
        ]);
    }

}
