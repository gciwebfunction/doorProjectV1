<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => 2,
            'category_name' => 'Hinged Units',
            'category_note' => 'manuf-grp',
            'image_id' => '1',
        ]);

        DB::table('categories')->insert([
            'id' => 3,
            'category_name' => 'Gliding Units',
            'category_note' => 'Gliding doors provide maximum patio space.  Traditional styling with pine, oak, maple or pre-finished.',
            'image_id' => '1',
        ]);
    }
}
