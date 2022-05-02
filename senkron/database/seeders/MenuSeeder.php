<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Hash;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $menu_elements = [
            [
                'name' => 'ANASAYFA',
                'url' => '/',
            ],
            [
                'name' => 'KURUMSAL',
                'children' => [
                    ['name' => 'Kalite Politikamız', 'type' => 'page', 'url' => 1],
                    ['name' => 'Tarihçe', 'type' => 'page', 'url' => 2],
                    ['name' => 'Misyon ve Vizyon', 'type' => 'page', 'url' => 3],
                    ['name' => 'Belgelerimiz', 'type' => 'page', 'url' => 4],
                    ['name' => 'Kalite ve İş Güvenliği', 'type' => 'page', 'url' => 5],
                    ['name' => 'Referanslar', 'type' => 'page', 'url' => 6],
                    ['name' => 'Ticari Bilgilerimiz', 'type' => 'page', 'url' => 7],
                ]
            ], [
                'name' => 'ÜRETİMLER',
                'children' => [
                    [
                        'name' => 'AG Dağıtım Sistemleri',
                        'url' => '/products?category=3',
//                        'children' => ['Dağıtım Panoları', 'Kompanzasyon Panoları', 'Sürücü - MCC- PLC Panoları']
                    ],
                    [
                        'name' => 'Endüstriyel Otomasyon',
                        'url' => '/products?category=4',
//                        'children' => ['PLC Sistemleri', 'I/O Sistemleri', 'HMI/SCADA Uygulamaları', 'DC Sürücü Sistemleri']
                    ],
                    [
                        'name' => 'Sıcak Metal Sensörleri',
                        'url' => '/products?category=5',
//                        'children' => ['SHF400-C', 'SHF275-C']
                    ],
                ]
            ], [
                'name' => 'ÜRÜNLER',
                'url' => '/products',
                'childrens' => [
                    ['name' => 'Otomasyon Ürünleri', 'children' => ['PLC', 'Operatör Panelleri', 'Sensör ve Algılama']],
                    ['name' => 'Yumuşak Yol Vericiler'],
                    ['name' => 'Frekans Konvertörler'],
                    ['name' => 'Motorlar', 'children' => ['ABB AC  Motor', 'ABB DC Motor']],
                    ['name' => 'Pano'],
                    ['name' => 'Kablo'],
                    ['name' => 'Aspiratör ve Fan'],
                    ['name' => 'Topraklama Ürünleri'],
                ]
            ], [
                'name' => 'HİZMETLER',
                'children' => [
                    ['name' => 'Proje ve Taahhüt', 'type' => 'page', 'url' => 8],
                    ['name' => 'Montaj ve Devreye Alma', 'type' => 'page', 'url' => 9],
                    ['name' => 'Projeler', 'type' => 'page', 'url' => 10],
                    ['name' => 'Ürün Satışı', 'type' => 'page', 'url' => 11],
                ]
            ], [
                'name' => 'SEKTÖRLER',
                'children' => [
                    ['name' => 'Demir Çelik', 'type' => 'page', 'url' => 12],
                    ['name' => 'Çimento', 'type' => 'page', 'url' => 13],
                    ['name' => 'Kağıt', 'type' => 'page', 'url' => 14],
                    ['name' => 'Arıtma', 'type' => 'page', 'url' => 15],
                ]
            ],
            [
                'name' => 'TEKNİK MERKEZ', 'type' => 'page', 'url' => 16
            ], [
                'name' => 'İLETİŞİM',
                'url' => '/contact_us',
            ]
        ];
        foreach ($menu_elements as $element) {
            $menu = new Menu();
            $menu->name = $element['name'];
            $menu->type = $element['type']??'url';
            $menu->url = $element['url'] ?? '#';
            $menu->name_translations = [];
            $menu->save();
            if (isset($element['children'])) {
                foreach ($element['children'] as $child) {
                    $children = new Menu();
                    $children->name = $child['name'];
                    $children->type = $child['type']??'url';
                    $children->menu_id = $menu->id;
                    $children->url =  $child['url']??'#';
                    $children->name_translations = [];
                    $children->save();
                    if (isset($child['children'])) {
                        foreach ($child['children'] as $sub_child) {
                            $sub_children = new Menu();
                            $sub_children->name = $sub_child;
                            $sub_children->type = 'url';
                            $sub_children->menu_id = $children->id;
                            $sub_children->url = '#';
                            $sub_children->name_translations = [];
                            $sub_children->save();
                        }
                    }
                }
            }
        }
    }
}
