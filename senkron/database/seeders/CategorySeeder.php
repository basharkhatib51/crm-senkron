<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [

//            ['name' => 'Otomasyon Ürünleri', 'children' => ['PLC', 'Operatör Panelleri', 'Sensör ve Algılama']],
//            ['name' => 'Yumuşak Yol Vericiler'],
//            ['name' => 'Frekans Konvertörler'],
//            ['name' => 'Motorlar', 'children' => ['ABB AC  Motor', 'ABB DC Motor']],
//            ['name' => 'Pano'],
//            ['name' => 'Kablo'],
//            ['name' => 'Aspiratör ve Fan'],
//            ['name' => 'Topraklama Ürünleri'],
            ['name' => 'Motorlar'],
            ['name' => 'Otomasyon Ürünleri'],
            ['name' => 'AG Dağıtım Sistemleri'],
            ['name' => 'Endüstriyel Otomasyon'],
            ['name' => 'Sıcak Metal Sensörleri'],
        ];
        foreach ($categories as $element) {
            $category = new Category();
            $category->name = $element['name'];
            $category->translate_columns([]);
            $category->save();
            if (isset($element['children'])) {
                foreach ($element['children'] as $child) {
                    $children = new Category();
                    $children->name = $child;
                    $children->category_id = $category->id;
                    $children->translate_columns([]);
                    $children->save();
                }
            }
        }
    }
}
