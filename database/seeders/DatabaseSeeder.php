<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            CategoriesSeeder::class,
            ProductSizeCodesSeeder::class,
            GroupsSeeder::class,
            PermissionsSeeder::class,
            FinishOptionsSeeder::class,
            AddOnOptionsSeeder::class,
            GroupHasPermissionsSeeder::class,
            UserHasGroupsSeeder::class,
            ImageDetailsSeeder::class,
            DoorTypeSeeder::class,
            DoorSeeder::class,
        ]);

    }
}
