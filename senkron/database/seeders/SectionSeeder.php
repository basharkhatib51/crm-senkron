<?php

namespace Database\Seeders;

use App\Models\Element;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Hash;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section = new Section();
        $section->name = 'Çözüm Ortağınız';
        $section->name_translations = [];
        $section->elements_col = 3;
        $section->image = 1;
        $section->description = 0;
        $section->icon = 0;
        $section->link = 1;
        $section->save();

        $section = new Section();
        $section->name = 'second section';
        $section->name_translations = [];
        $section->elements_col = 3;
        $section->image = 0;
        $section->description = 1;
        $section->icon = 1;
        $section->link = 1;
        $section->save();

        $section = new Section();
        $section->name = '3 section';
        $section->name_translations = [];
        $section->elements_col = 4;
        $section->image = 1;
        $section->description = 0;
        $section->icon = 0;
        $section->link = 1;
        $section->save();

        $section = new Section();
        $section->name = 'Markalarimiz';
        $section->name_translations = [];
        $section->elements_col = 2;
        $section->image = 1;
        $section->description = 0;
        $section->icon = 0;
        $section->link = 0;
        $section->save();

        $sections_elements = [
            [
                [
                    'title' => 'Proje ve Taahhüt',
                    'image_id' => 59,
                    'section_id' => 1,
                    'page_id' => 8
                ],
                [
                    'title' => 'Montaj ve Devreye Alma',
                    'image_id' => 66,
                    'section_id' => 1,
                    'page_id' => 9
                ],
                [
                    'title' => 'Projeler',
                    'image_id' => 67,
                    'section_id' => 1,
                    'page_id' => 10
                ],
                [
                    'title' => 'Ürün Satışı',
                    'image_id' => 68,
                    'section_id' => 1,
                    'page_id' => 11
                ]
            ],
            [
                [
                    'title' => 'Toptan Elektrik Ürünleri',
                    'icon' => 'wallet',
                    'pack' => 'fas',
                    'section_id' => 2,
                    'description' => 'Toptan elektrik malzemeleri satış ve teslimatı konusunda en iyi hizmeti sağlıyoruz.'
                ],
                [
                    'title' => 'Hızlı Teslimat',
                    'icon' => 'truck',
                    'pack' => 'fas',
                    'section_id' => 2,
                    'description' => 'Bizden talep ettiğiniz ürünleri en kısa sürede adresinize gönderiyoruz.'
                ],
                [
                    'title' => 'Çeşitlilik',
                    'icon' => 'sync-alt',
                    'pack' => 'fas',
                    'section_id' => 2,
                    'description' => 'Bir çok Elektrik firmasının bayiliğini yürüten firmamız, binlerce ürünü stoklarında bulundurmaktadır.'
                ],
                [
                    'title' => 'Uygun Fiyat',
                    'icon' => 'thumbs-up',
                    'pack' => 'fas',
                    'section_id' => 2,
                    'description' => 'Farklı ödeme yöntemlerini kabul ederek, satın alımlarınızda da kazandırıyoruz.'
                ]
            ], [
                [
                    'title' => 'AG Dağıtım Sistemleri', 'image_id' => 45,
                    'section_id' => 3,
                    'url'=>'/products?category=3',
                ], [
                    'title' => 'Endüstriyel Otomasyon', 'image_id' => 46,
                    'section_id' => 3,
                    'url'=>'/products?category=4',
                ], [
                    'title' => 'Sıcak Metal Sensörleri', 'image_id' => 47,
                    'section_id' => 3,
                    'url'=>'/products?category=5',
                ],

            ], [
                [
                    'title' => '1',
                    'image_id' => 6,
                    'section_id' => 4,
                ], [
                    'title' => '2',
                    'image_id' => 7,
                    'section_id' => 4,
                ], [
                    'title' => '3',
                    'image_id' => 8,
                    'section_id' => 4,
                ], [
                    'title' => '4',
                    'image_id' => 9,
                    'section_id' => 4,
                ], [
                    'title' => '5',
                    'image_id' => 10,
                    'section_id' => 4,
                ], [
                    'title' => '6',
                    'image_id' => 11,
                    'section_id' => 4,
                ], [
                    'title' => '7',
                    'image_id' => 12,
                    'section_id' => 4,
                ], [
                    'title' => '8',
                    'image_id' => 13,
                    'section_id' => 4,
                ], [
                    'title' => '9',
                    'image_id' => 14,
                    'section_id' => 4,
                ], [
                    'title' => '10',
                    'image_id' => 15,
                    'section_id' => 4,
                ], [
                    'title' => '11',
                    'image_id' => 16,
                    'section_id' => 4,
                ], [
                    'title' => '12',
                    'image_id' => 17,
                    'section_id' => 4,
                ], [
                    'title' => '13',
                    'image_id' => 18,
                    'section_id' => 4,
                ], [
                    'title' => '14',
                    'image_id' => 19,
                    'section_id' => 4,
                ], [
                    'title' => '15',
                    'image_id' => 20,
                    'section_id' => 4,
                ], [
                    'title' => '16',
                    'image_id' => 21,
                    'section_id' => 4,
                ], [
                    'title' => '17',
                    'image_id' => 22,
                    'section_id' => 4,
                ], [
                    'title' => '18',
                    'image_id' => 23,
                    'section_id' => 4,
                ], [
                    'title' => '19',
                    'image_id' => 24,
                    'section_id' => 4,
                ], [
                    'title' => '20',
                    'image_id' => 25,
                    'section_id' => 4,
                ],
            ]
        ];
        foreach ($sections_elements as $elements) {
            foreach ($elements as $val) {
                $element = new Element();
                $element->section_id = $val['section_id'];
                if (array_key_exists('title', $val))
                    if ($val['title']) $element->title = $val['title'];
                if (array_key_exists('image_id', $val))
                    if ($val['image_id'])
                        $element->image_id = $val['image_id'];
                if (array_key_exists('url', $val))
                    if ($val['url'])
                        $element->url = $val['url'];
                if (array_key_exists('page_id', $val))
                    if ($val['page_id'])
                        $element->page_id = $val['page_id'];
                if (array_key_exists('pack', $val))
                    if ($val['pack'])
                        $element->pack = $val['pack'];
                if (array_key_exists('icon', $val))
                    if ($val['icon'])
                        $element->icon = $val['icon'];
                if (array_key_exists('description', $val))
                    if ($val['description'])
                        $element->description = $val['description'];
                $element->translate_columns($val);
                $element->save();
            }
        }
    }
}
