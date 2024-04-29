<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizeCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_size_codes')->insert(
            [
                'product_size_code' => '5068(611)',
                'height' => 68,
                'width' => 50,
            ]);
        DB::table('product_size_codes')->insert(
            [
                'product_size_code' => '6068(611)',
                'height' => 68,
                'width' => 60,]);
        DB::table('product_size_codes')->insert(
            [
                'product_size_code' => '8068(611)',
                'height' => 68,
                'width' => 80,
            ]);
        DB::table('product_size_codes')->insert(
            [
                'product_size_code' => '5080',
                'height' => 80,
                'width' => 50,
            ]);
        DB::table('product_size_codes')->insert(
            [
                'product_size_code' => '6080(710)',
                'height' => 80,
                'width' => 60,
            ]);
        DB::table('product_size_codes')->insert(
            [
                'product_size_code' => '8080',
                'height' => 80,
                'width' => 80,
            ]);
        DB::table('product_size_codes')->insert(
            [
                'product_size_code' => '7668(611)',
                'height' => 68,
                'width' => 76,
            ]);
        DB::table('product_size_codes')->insert(
            [
                'product_size_code' => '9068(611)',
                'height' => 68,
                'width' => 90,
            ]);
    }
}
