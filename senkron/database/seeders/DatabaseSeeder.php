<?php

namespace Database\Seeders;

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
            UploadSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            LanguageSeeder::class,
            MenuSeeder::class,
            SliderSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            PageSeeder::class,
            SectionSeeder::class,
            TranslationSeeder::class,
        ]);
    }
}
