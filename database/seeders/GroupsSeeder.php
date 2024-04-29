<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'id' => 100001,
            'name' => 'manufacturer',
            'slug' => 'manuf-grp',
            'description' => 'Manufacturer Users',
        ]);
        DB::table('groups')->insert([
            'id' => 100002,
            'name' => 'distributor',
            'slug' => 'distributor-grp',
            'description' => 'Distributor Users',
        ]);
        DB::table('groups')->insert([
            'id' => 100003,
            'name' => 'salesmanager',
            'slug' => 'slsmgr-grp',
            'description' => 'Sales Manager Users',
        ]);
        DB::table('groups')->insert([
            'id' => 100004,
            'name' => 'sales',
            'slug' => 'sales-grp',
            'description' => 'Sales Users',
        ]);
        DB::table('groups')->insert([
            'id' => 100005,
            'name' => 'dealer',
            'slug' => 'dealer-grp',
            'description' => 'Dealer Users',
        ]);
    }
}
