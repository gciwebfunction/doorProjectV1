<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('door_types')->insert([
            'id' => 1,
            'door_type' => 'gliding',
            'door_type_pretty_name' => 'Impact Gliding Units',
            'category_id' => 3,
        ]);

        DB::table('door_types')->insert([
            'id' => 2,
            'door_type' => 'gliding',
            'door_type_pretty_name' => 'Non Impact Gliding Units',
            'category_id' => 3,
        ]);

        DB::table('door_types')->insert([
            'id' => 3,
            'door_type' => 'hinged',
            'door_type_pretty_name' => 'Single Hinged Door',
            'category_id' => 2,
        ]);

        DB::table('door_types')->insert([
            'id' => 4,
            'door_type' => 'hinged',
            'door_type_pretty_name' => 'Singled Hinged Impact Door',
            'category_id' => 2,
        ]);

        DB::table('door_types')->insert([
            'id' => 5,
            'door_type' => 'hinged',
            'door_type_pretty_name' => 'Double Hinged Door',
            'category_id' => 2,
        ]);

        DB::table('door_types')->insert([
            'id' => 6,
            'door_type' => 'hinged',
            'door_type_pretty_name' => 'Double Hinged Impact Door',
            'category_id' => 2,
        ]);

        DB::table('door_types')->insert([
            'id' => 7,
            'door_type' => 'hinged',
            'door_type_pretty_name' => 'Center Hinged Door',
            'category_id' => 2,
        ]);

        DB::table('door_types')->insert([
            'id' => 8,
            'door_type' => 'hinged',
            'door_type_pretty_name' => 'Center Hinged Impact Door',
            'category_id' => 2,
        ]);
    }
}
