<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Setting = [
            [
                "key" => "site name",
                "value" => "senkronelk",
                "default" => "senkronelk",
                "type" => "string",
                "tab" => "general",
                "index" => "2",
            ],
            [
                "key" => "site description",
                "value" => "SENKRON ELEKTRİK İNŞAAT TAAHHÜT OTOMASYON SAN. VE TİC. LTD. ŞTİ.",
                "default" => "SENKRON ELEKTRİK İNŞAAT TAAHHÜT OTOMASYON SAN. VE TİC. LTD. ŞTİ.",
                "type" => "text",
                "tab" => "general",
                "index" => "3",
            ],
            [
                "key" => "Share image",
                "value" => "1",
                "default" => "1",
                "type" => "image",
                "tab" => "general",
                "index" => "11",
            ],
            [
                "key" => "Phone",
                "value" => "+905434156485",
                "default" => "+905434156485",
                "type" => "number",
                "tab" => "contact",
                "index" => "3",
            ],
            [
                "key" => "email",
                "value" => "info@senkronelk.com",
                "default" => "info@senkronelk.com",
                "type" => "string",
                "tab" => "contact",
                "index" => "4",
            ], [
                "key" => "Whatsapp",
                "value" => "https://wsend.co/905434156485",
                "default" => "https://wsend.co/905434156485",
                "type" => "text",
                "tab" => "contact",
                "index" => "5",
            ],
            [
                "key" => "Facebook",
                "value" => "https://www.facebook.com/",
                "default" => "https://www.facebook.com/",
                "type" => "text",
                "tab" => "contact",
                "index" => "6",
            ],
            [
                "key" => "Instagram",
                "value" => "https://www.instagram.com/",
                "default" => "https://www.instagram.com/",
                "type" => "text",
                "tab" => "contact",
                "index" => "7",
            ],
            [
                "key" => "Twitter",
                "value" => "https://www.twitter.com/",
                "default" => "https://www.twitter.com/",
                "type" => "text",
                "tab" => "contact",
                "index" => "7",
            ],
            [
                "key" => "Youtube",
                "value" => "https://www.youtube.com/",
                "default" => "https://www.youtube.com/",
                "type" => "text",
                "tab" => "contact",
                "index" => "7",
            ],
            [
                "key" => "Linkedin",
                "value" => "https://www.linkedin.com/",
                "default" => "https://www.linkedin.com/",
                "type" => "text",
                "tab" => "contact",
                "index" => "7",
            ],
            [
                "key" => "map",
                "value" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12008.567115848953!2d32.61572343739952!3d41.19688246851192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc3521b4c12936b0b!2sSENKRON%20ELEKTRIK%20%C4%B0N%C5%9EAAT%20TAAHH%C3%9CT%20OTOMASYON%20SAN.%20VE%20TIC.LIM.%C5%9ET%C4%B0!5e0!3m2!1str!2str!4v1574336223645!5m2!1str!2str",
                "default" => "https://www.facebook.com/",
                "type" => "text",
                "tab" => "map",
                "index" => "6",
            ],
            [
                "key" => "Country",
                "value" => "Turkey",
                "default" => "Turkey ",
                "type" => "text",
                "tab" => "footer address",
                "index" => "2",
            ],
            [
                "key" => "City",
                "value" => "KARABÜK",
                "default" => "KARABÜK",
                "type" => "text",
                "tab" => "footer address",
                "index" => "3",
            ],
            [
                "key" => "Address",
                "value" => "Merkez: Öğlebeli Mahallesi Fetih Caddesi No: 36 Merkez / KARABÜK <br> Şube:Hürriyet Mahallesi İnönü Caddesi No:21 Merkez/KARABÜK",
                "default" => "Merkez: Öğlebeli Mahallesi Fetih Caddesi No: 36 Merkez / KARABÜK <br> Şube:Hürriyet Mahallesi İnönü Caddesi No:21 Merkez/KARABÜK",
                "type" => "text",
                "tab" => "footer address",
                "index" => "4",
            ],
            [
                "key" => "keywords",
                "value" => "senkronelk,SENKRON,ELEKTRİK,İNŞAAT,TAAHHÜT,OTOMASYON",
                "default" => "senkronelk",
                "type" => "text",
                "tab" => "seo",
                "index" => "4",
            ],
            [
                "key" => "sitelinkssearchbox",
                "value" => "sitelinkssearchbox",
                "default" => "sitelinkssearchbox",
                "type" => "text",
                "tab" => "seo",
                "index" => "4",
            ],
            [
                "key" => "google-site-verification",
                "value" => "google-site-verification",
                "default" => "google-site-verification",
                "type" => "text",
                "tab" => "seo",
                "index" => "4",
            ],
            [
                "key" => "facebook app_id",
                "value" => "facebook app_id",
                "default" => "facebook app_id",
                "type" => "text",
                "tab" => "seo",
                "index" => "4",
            ],
            [
                "key" => "twitter Account Name",
                "value" => "twitter Account Name",
                "default" => "twitter Account Name",
                "type" => "text",
                "tab" => "seo",
                "index" => "4",
            ],
            [
                "key" => "site url",
                "value" => "http://localhost:8000/",
                "default" => "http://localhost:8000/",
                "type" => "text",
                "tab" => "general",
                "index" => "4",
            ],
        ];
        foreach ($Setting as $el) {
            Setting::create([
                "key" => $el['key'],
                "value" => $el['value'],
                "default" => $el['default'],
                "type" => $el['type'],
                "tab" => $el['tab'],
                "index" => $el['index'],
            ]);
        }
    }
}
