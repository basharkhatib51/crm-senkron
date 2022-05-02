<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Language= [
            [
                "name" => "English",
                "english_name" => "English",
                "code" => "en",
                "image_id" => "3",

            ],[
                "name" => "العربية",
                "english_name" => "Arabic",
                "code" => "ar",
                "image_id" => "4",

            ],[
                "name" => "Türkçe",
                "english_name" => "Turkish",
                "code" => "tr",
                "image_id" => "5",

            ],
        ];
        foreach ($Language as $el) {
            Language::create([
                "name" => $el['name'],
                "english_name" => $el['english_name'],
                "code" => $el['code'],
                "image_id" => $el['image_id'],

            ]);
        }
    }
}
