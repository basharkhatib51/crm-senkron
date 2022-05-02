<?php

namespace Database\Seeders;

use App\Models\Translation;
use Illuminate\Database\Seeder;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $translations = [
            'Share this product',
            'Request this product',
            'Request Product',
        ];
        foreach ($translations as $element) {
            $translation = new Translation();
            $translation->content = $element;
            $translation->translate_columns([]);
            $translation->save();
        }
    }
}
