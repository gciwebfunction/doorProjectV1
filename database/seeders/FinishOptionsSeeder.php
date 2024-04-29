<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinishOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('finish_options')->insert([
            'finish_option_name'=>'Smooth White on Both Sides',
            'finish_option_description'=>'',
        ]);
        DB::table('finish_options')->insert([
            'finish_option_name'=>'Unstained Wood Grain Both Sides',
            'finish_option_description'=>'',
        ]);
        DB::table('finish_options')->insert([
            'finish_option_name'=>'Unstained Wood Grain Interior/Smooth White Exterior',
            'finish_option_description'=>'',
        ]);
        DB::table('finish_options')->insert([
            'finish_option_name'=>'Stained Wood Grain Interior/Smooth White Exterior',
            'finish_option_description'=>'',
        ]);
        DB::table('finish_options')->insert([
            'finish_option_name'=>'Stained Wood Grain Both Sides',
            'finish_option_description'=>'',
        ]);
        DB::table('finish_options')->insert([
            'finish_option_name'=>'White Wood Grain Interior/Smooth White Exterior',
            'finish_option_description'=>'',
        ]);
        DB::table('finish_options')->insert([
            'finish_option_name'=>'White Wood Grain Both Sides',
            'finish_option_description'=>'',
        ]);
    }
}
