<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [[
            'category_id' => 1, 'products' => ['ABB AC  Motor', 'ABB DC Motor'],
        ], [
            'category_id' => 2, 'products' => ['PLC', 'Operatör Panelleri', 'Sensör ve Algılama'],
        ], [
            'category_id' => null, 'products' => [
                'Yumuşak Yol Vericiler',
                'Frekans Konvertörler',
                'Pano',
                'Kablo',
                'Aspiratör ve Fan',
                'Topraklama Ürünleri'],

        ], [
            'category_id' => 3, 'products' => [
                'Dağıtım Panoları',
                'Kompanzasyon Panoları',
                'Sürücü - MCC- PLC Panoları']

        ], [
            'category_id' => 4, 'products' => [
                'PLC Sistemleri',
                'I/O Sistemleri',
                'HMI/SCADA Uygulamaları',
                'DC Sürücü Sistemleri',
            ]
        ], [
            'category_id' => 5, 'products' => [
                'SHF400-C',
                'SHF275-C']
        ],
        ];
        foreach ($products as $elements) {
            foreach ($elements['products'] as $element) {
                $product = new Product();
                $product->name = $element;
                $product->price = '99';
                $product->category_id = $elements['category_id'];
                $product->image_id = '90';
                $product->translate_columns([]);
                $product->save();
            }

        }
    }
}
