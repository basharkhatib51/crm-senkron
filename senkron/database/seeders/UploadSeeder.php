<?php

namespace Database\Seeders;

use App\Models\Upload;
use Illuminate\Database\Seeder;

class UploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $png = ['default', 'user', 'en', 'ar', 'tr',
            'logo (1)', 'logo (2)', 'logo (3)', 'logo (4)', 'logo (5)', 'logo (6)', 'logo (7)', 'logo (8)', 'logo (9)', 'logo (10)', 'logo (11)', 'logo (12)', 'logo (13)', 'logo (14)', 'logo (15)', 'logo (16)', 'logo (17)', 'logo (18)', 'logo (19)', 'logo (20)',
            'sl (1)', 'sl (2)',
            'ose (1)', 'ose (2)', 'ose (3)', 'ose (4)', 'ose (5)', 'ose (6)', 'ose (7)', 'ose (8)', 'ose (9)', 'ose (10)', 'ose (11)', 'ose (12)', 'ose (13)'
        ];
        $jpg = ['se (1)', 'se (2)', 'se (3)', 'se (4)', 'se (5)', 'se (6)', 'se (7)', 'sl (1)', 'sl (2)', 'sl (3)', 'sl (4)', 'sl (5)',
            'ose (1)', 'ose (2)', 'ose (3)', 'ose (4)', 'ose (5)', 'ose (6)', 'ose (7)', 'ose (8)', 'ose (9)', 'ose (10)', 'ose (11)', 'ose (12)', 'ose (13)', 'ose (14)', 'ose (15)', 'ose (16)', 'ose (17)', 'ose (18)', 'ose (19)', 'ose (20)', 'ose (21)', 'ose (22)', 'ose (23)', 'ose (24)', 'ose (25)',
            'osl (1)', 'osl (2)', 'osl (3)', 'osl (4)', 'osl (5)', 'osl (6)', 'osl (7)', 'osl (8)', 'osl (9)', 'osl (10)', 'osl (11)', 'osl (12)', 'osl (13)', 'osl (14)', 'osl (15)', 'osl (16)', 'osl (17)', 'min-slider',
            'Kalite Politikamız', 'tarihce', 'Belgelerimiz (2)', 'Belgelerimiz'
        ];
        foreach ($png as $image) {
            $Upload = Upload::create([
                'url' => "uploads/default/$image.png",
                'generated_name' => '$image.png',
                'original_name' => '$image.png',
                'real_path' => 'C:\xampp\tmp\php47F4.tmp',
                'extension' => 'png',
                'size' => '0',
                'mime_type' => 'image/png',
                'type' => 'Image',
                'created_at' => '2021-07-12 20:29:40',
                'updated_at' => '2021-07-12 20:29:40'
            ]);
//            \File::copy(base_path("public/uploads/default/$image.png"), base_path("public/uploads/ids/$Upload->id.png"));
        }
        foreach ($jpg as $image) {
            $Upload = Upload::create([
                'url' => "uploads/default/$image.jpg",
                'generated_name' => '$image.jpg',
                'original_name' => '$image.jpg',
                'real_path' => 'C:\xampp\tmp\php47F4.tmp',
                'extension' => 'jpg',
                'size' => '0',
                'mime_type' => 'image/jpg',
                'type' => 'Image',
                'created_at' => '2021-07-12 20:29:40',
                'updated_at' => '2021-07-12 20:29:40'
            ]);
//            \File::copy(base_path("public/uploads/default/$image.jpg"), base_path("public/uploads/ids/$Upload->id.jpg"));
        }
        $others = [
            ['name'=>'min-slider', 'ext'=>'png'],
            ['name'=>'Referanslar', 'ext'=>'png'],
            ['name'=>'ProjeveTaahhüt', 'ext'=>'jpg'],
            ['name'=>'Montaj', 'ext'=>'jpg'],
            ['name'=>'Montaj(2)', 'ext'=>'jpg'],
            ['name'=>'Montaj(3)', 'ext'=>'jpg'],
            ['name'=>'Projeler', 'ext'=>'jpg'],
            ['name'=>'Ürün', 'ext'=>'png'],
            ['name'=>'Demir', 'ext'=>'jpg'],
            ['name'=>'Çimento', 'ext'=>'jpg'],
            ['name'=>'Kağıt', 'ext'=>'jpg'],
            ['name'=>'Arıtma', 'ext'=>'jpg'],
            ['name'=>'Arıtma (2)', 'ext'=>'jpg'],
            ['name'=>'Arıtma (3)', 'ext'=>'jpg'],
            ['name'=>'Teknik Dökümanlar', 'ext'=>'jpg'],
        ];
        foreach ($others as $image) {
            $Upload = Upload::create([
                'url' => "uploads/default/{$image['name']}.{$image['ext']}",
                'generated_name' => '$image.png',
                'original_name' => '$image.png',
                'real_path' => 'C:\xampp\tmp\php47F4.tmp',
                'extension' => "{$image['ext']}",
                'size' => '0',
                'mime_type' => "image/{$image['ext']}",
                'type' => 'Image',
                'created_at' => '2021-07-12 20:29:40',
                'updated_at' => '2021-07-12 20:29:40'
            ]);
        }
    }
}
