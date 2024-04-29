<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddOnOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('add_on_options')->insert([
            'add_on_option' => 'SDL Option',
            'add_on_option_description' => '',
            'add_on_option_price' => 23,
            'is_per_light' => 1,
            'is_per_panel' => 1,
            'is_price_same_for_all_sizes' => 0,
        ]);
    }
}
