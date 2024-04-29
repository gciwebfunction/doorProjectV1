<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doors')->insert([
            'id' => '1001',
            'name' => 'Single Hinged Patio Door',
            'door_type_id' => 3,
            'category_id' => 2
        ]);

        DB::table('door_frames')->insert([
            'id' => '1001',
            'frame' => 'Knocked Down',
            'door_id' => '1001',
        ]);

        DB::table('door_frames')->insert([
            'id' => '1002',
            'frame' => 'Fully Assembled',
            'door_id' => '1001',
        ]);

        DB::table('door_handlings')->insert([
            'id' => '1001',
            'handling' => 'R Right Handed Opening',
            'door_id' => '1001',
        ]);

        DB::table('door_handlings')->insert([
            'id' => '1002',
            'handling' => 'L Left Handed Opening',
            'door_id' => '1001',
        ]);

        DB::table('door_names')->insert([
            'id' => 1001,
            'door_id' => '1001',
            'door_name_or_type' => 'Inswing',
            'image_id' => 1,
        ]);

        DB::table('door_names')->insert([
            'id' => 1002,
            'door_id' => '1001',
            'door_name_or_type' => 'Outswing',
            'image_id' => 1,
        ]);

        DB::table('door_measurements')->insert([
            'id' => 1001,
            'height' => '6\'8\'\'',
            'width' => '2\'0\'\'',
            'door_id' => '1001'
        ]);

        DB::table('door_measurements')->insert([
            'id' => 1002,
            'height' => '6\'11\'\'',
            'width' => '2\'0\'\'',
            'door_id' => '1001'
        ]);

        DB::table('door_measurements')->insert([
            'id' => 1003,
            'height' => '6\'8\'\'',
            'width' => '2\'6\'\'',
            'door_id' => '1001'
        ]);

        DB::table('door_measurements')->insert([
            'id' => 1004,
            'height' => '6\'11\'\'',
            'width' => '2\'6\'\'',
            'door_id' => '1001'
        ]);

        DB::table('door_measurements')->insert([
            'id' => 1005,
            'height' => '6\'8\'\'',
            'width' => '2\'8\'\'',
            'door_id' => '1001'
        ]);

        DB::table('door_measurements')->insert([
            'id' => 1006,
            'height' => '6\'8\'\'',
            'width' => '3\'0\'\'',
            'door_id' => '1001'
        ]);

        DB::table('door_measurements')->insert([
            'id' => 1007,
            'height' => '6\'11\'\'',
            'width' => '3\'0\'\'',
            'door_id' => '1001'
        ]);

        DB::table('door_measurements')->insert([
            'id' => 1008,
            'height' => '7\'6\'\'',
            'width' => '3\'0\'\'',
            'door_id' => '1001'
        ]);

        DB::table('interior_colors')->insert([
            'id' => 1001,
            'color' => 'Smooth White on Both Sides',
            'door_id' => '1001',
        ]);

        DB::table('interior_colors')->insert([
            'id' => 1002,
            'color' => 'Unstained Wood Grain Both Sides',
            'door_id' => '1001',
        ]);

        DB::table('interior_colors')->insert([
            'id' => 1003,
            'color' => 'Unstained Wood Grain Interior/Smooth White Exterior',
            'door_id' => '1001',
        ]);

        DB::table('interior_colors')->insert([
            'id' => 1004,
            'color' => 'Stained Wood Grain Interior/Smooth White Exterior',
            'door_id' => '1001',
        ]);

        DB::table('interior_colors')->insert([
            'id' => 1005,
            'color' => 'Stained Wood Grain Both Sides',
            'door_id' => '1001',
        ]);

        DB::table('door_finish_prices')->insert([
            'id' => 1001,
            'door_measurement_id' => 1001,
            'interior_color_id' => 1001,
            'price' => 1222,
        ]);

        DB::table('door_finish_prices')->insert([
            'id' => 1002,
            'door_measurement_id' => 1002,
            'interior_color_id' => 1001,
            'price' => 1222,
        ]);

        DB::table('door_finish_prices')->insert([
            'id' => 1003,
            'door_measurement_id' => 1003,
            'interior_color_id' => 1001,
            'price' => 1222,
        ]);

        DB::table('door_finish_prices')->insert([
            'id' => 1004,
            'door_measurement_id' => 1004,
            'interior_color_id' => 1001,
            'price' => 1222,
        ]);

        DB::table('door_finish_prices')->insert([
            'id' => 1005,
            'door_measurement_id' => 1005,
            'interior_color_id' => 1001,
            'price' => 1222,
        ]);

        DB::table('door_finish_prices')->insert([
            'id' => 1006,
            'door_measurement_id' => 1006,
            'interior_color_id' => 1001,
            'price' => 1222,
        ]);

        DB::table('door_finish_prices')->insert([
            'id' => 1007,
            'door_measurement_id' => 1007,
            'interior_color_id' => 1001,
            'price' => 1222,
        ]);

        DB::table('door_finish_prices')->insert([
            'id' => 1008,
            'door_measurement_id' => 1008,
            'interior_color_id' => 1001,
            'price' => 1222,
        ]);

        DB::table('additional_option_values')->insert([
            'id' => 1001,
            'name' => 'Laminated',
            'group_name' => 'GLASS_OPTION',
            'price' => 0,
            'is_per_panel' => 0,
            'is_per_light' => 0,
            'door_id' => 1001,
            'door_measurement_id' => 1001,
            'image_id' => -1,
        ]);
        DB::table('additional_option_values')->insert([
            'id' => 1002,
            'name' => 'Lowe',
            'group_name' => 'GLASS_LOWE_OPTION',
            'price' => 0,
            'is_per_panel' => 0,
            'is_per_light' => 0,
            'door_id' => 1001,
            'door_measurement_id' => 1001,
            'image_id' => -1,
        ]);
        DB::table('additional_option_values')->insert([
            'id' => 1003,
            'name' => 'Depth',
            'group_name' => 'GLASS_DEPTH_OPTION',
            'price' => 0,
            'is_per_panel' => 0,
            'is_per_light' => 0,
            'door_id' => 1001,
            'door_measurement_id' => 1001,
            'image_id' => -1,
        ]);
        DB::table('additional_option_values')->insert([
            'id' => 1004,
            'name' => 'HPVD Handleset Option',
            'group_name' => 'HANDLE_TYPE_OPTION',
            'price' => 123,
            'is_per_panel' => 0,
            'is_per_light' => 0,
            'door_id' => 1001,
            'door_measurement_id' => 1001,
            'image_id' => -1,
        ]);
        DB::table('additional_option_values')->insert([
            'id' => 1005,
            'name' => 'Full Lock Set',
            'group_name' => 'LOCK_SET_OPTION',
            'price' => 53,
            'is_per_panel' => 0,
            'is_per_light' => 0,
            'door_id' => 1001,
            'door_measurement_id' => 1001,
            'image_id' => -1,
        ]);
        DB::table('additional_option_values')->insert([
            'id' => 1007,
            'name' => '3/4\'\'',
            'group_name' => 'FRAME_THICKNESS_OPTION',
            'price' => 0,
            'is_per_panel' => 0,
            'is_per_light' => 0,
            'door_id' => 1001,
            'door_measurement_id' => 1001,
            'image_id' => -1,
        ]);
        DB::table('additional_option_values')->insert([
            'id' => 1008,
            'name' => 'Laminated',
            'group_name' => 'GLASS_OPTION',
            'price' => 0,
            'is_per_panel' => 0,
            'is_per_light' => 0,
            'door_id' => 1001,
            'door_measurement_id' => 1001,
            'image_id' => -1,
        ]);
        DB::table('additional_option_values')->insert([
            'id' => 1009,
            'name' => 'Lowe',
            'group_name' => 'GLASS_LOWE_OPTION',
            'price' => 0,
            'is_per_panel' => 0,
            'is_per_light' => 0,
            'door_id' => 1001,
            'door_measurement_id' => 1002,
            'image_id' => -1,
        ]);
        DB::table('additional_option_values')->insert([
            'id' => 1010,
            'name' => '2/3\'\'',
            'group_name' => 'GLASS_DEPTH_OPTION',
            'price' => 0,
            'is_per_panel' => 0,
            'is_per_light' => 0,
            'door_id' => 1001,
            'door_measurement_id' => 1002,
            'image_id' => -1,
        ]);

        /*
         * GLASS GRID LOOPS - Glass grid options for all sizes.
         */
        $id = 1011;
        for ($i = 1001; $i < 1009; $i++) {
            DB::table('additional_option_values')->insert([
                'id' => $id++,
                'name' => '1-Lite No Grid',
                'group_name' => 'GLASS_GRID',
                'price' => 45,
                'is_per_panel' => 0,
                'is_per_light' => 0,
                'door_id' => 1001,
                'door_measurement_id' => $i,
                'image_id' => -1,
            ]);
            DB::table('additional_option_values')->insert([
                'id' => $id++,
                'name' => '10-Lite SDL',
                'group_name' => 'GLASS_GRID',
                'price' => 45,
                'is_per_panel' => 0,
                'is_per_light' => 0,
                'door_id' => 1001,
                'door_measurement_id' => $i,
                'image_id' => -1,
            ]);
            DB::table('additional_option_values')->insert([
                'id' => $id++,
                'name' => '12-Lite SDL',
                'group_name' => 'GLASS_GRID',
                'price' => 45,
                'is_per_panel' => 0,
                'is_per_light' => 0,
                'door_id' => 1001,
                'door_measurement_id' => $i,
                'image_id' => -1,
            ]);
            DB::table('additional_option_values')->insert([
                'id' => $id++,
                'name' => '15-Lite SDL',
                'group_name' => 'GLASS_GRID',
                'price' => 45,
                'is_per_panel' => 0,
                'is_per_light' => 0,
                'door_id' => 1001,
                'door_measurement_id' => $i,
                'image_id' => -1,
            ]);
            DB::table('additional_option_values')->insert([
                'id' => $id++,
                'name' => '18-Lite SDL',
                'group_name' => 'GLASS_GRID',
                'price' => 45,
                'is_per_panel' => 0,
                'is_per_light' => 0,
                'door_id' => 1001,
                'door_measurement_id' => $i,
                'image_id' => -1,
            ]);
            DB::table('additional_option_values')->insert([
                'id' => $id++,
                'name' => '1-Lite GBG',
                'group_name' => 'GLASS_GRID',
                'price' => 45,
                'is_per_panel' => 0,
                'is_per_light' => 0,
                'door_id' => 1001,
                'door_measurement_id' => $i,
                'image_id' => -1,
            ]);
            DB::table('additional_option_values')->insert([
                'id' => $id++,
                'name' => '10-Lite GBG',
                'group_name' => 'GLASS_GRID',
                'price' => 45,
                'is_per_panel' => 0,
                'is_per_light' => 0,
                'door_id' => 1001,
                'door_measurement_id' => $i,
                'image_id' => -1,
            ]);
            DB::table('additional_option_values')->insert([
                'id' => $id++,
                'name' => '12-Lite GBG',
                'group_name' => 'GLASS_GRID',
                'price' => 45,
                'is_per_panel' => 0,
                'is_per_light' => 0,
                'door_id' => 1001,
                'door_measurement_id' => $i,
                'image_id' => -1,
            ]);
            DB::table('additional_option_values')->insert([
                'id' => $id++,
                'name' => '15-Lite GBG',
                'group_name' => 'GLASS_GRID',
                'price' => 45,
                'is_per_panel' => 0,
                'is_per_light' => 0,
                'door_id' => 1001,
                'door_measurement_id' => $i,
                'image_id' => -1,
            ]);
            DB::table('additional_option_values')->insert([
                'id' => $id++,
                'name' => '18-Lite GBG',
                'group_name' => 'GLASS_GRID',
                'price' => 45,
                'is_per_panel' => 0,
                'is_per_light' => 0,
                'door_id' => 1001,
                'door_measurement_id' => $i,
                'image_id' => -1,
            ]);
        }

    }
}
