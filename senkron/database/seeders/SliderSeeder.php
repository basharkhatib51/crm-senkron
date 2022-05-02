<?php

namespace Database\Seeders;

use App\Models\Slider;
use App\Models\SliderElement;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slider = new Slider();
        $slider->name = 'home';
        $slider->translate_columns([]);
        $slider->save();

        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 1;
        $slider_element->image_id = 48;
        $slider_element->background_id = 48;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();
        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 1;
        $slider_element->image_id = 61;
        $slider_element->background_id = 61;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();
        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 1;
        $slider_element->image_id = 73;
        $slider_element->background_id = 73;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();


        $slider = new Slider();
        $slider->name = 'Proje ve Taahhüt';
        $slider->translate_columns([]);
        $slider->save();

        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 2;
        $slider_element->image_id = 102;
        $slider_element->background_id = 102;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();


        $slider = new Slider();
        $slider->name = 'Montaj';
        $slider->translate_columns([]);
        $slider->save();

        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 3;
        $slider_element->image_id = 103;
        $slider_element->background_id = 103;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();
        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 3;
        $slider_element->image_id = 104;
        $slider_element->background_id = 104;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();
        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 3;
        $slider_element->image_id = 105;
        $slider_element->background_id = 105;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();


        $slider = new Slider();
        $slider->name = 'Projeler';
        $slider->translate_columns([]);
        $slider->save();

        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 4;
        $slider_element->image_id = 106;
        $slider_element->background_id = 106;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();


        $slider = new Slider();
        $slider->name = 'Ürün';
        $slider->translate_columns([]);
        $slider->save();

        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 5;
        $slider_element->image_id = 107;
        $slider_element->background_id = 107;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();


        $slider = new Slider();
        $slider->name = 'Demir Çelik';
        $slider->translate_columns([]);
        $slider->save();

        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 6;
        $slider_element->image_id = 108;
        $slider_element->background_id = 108;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();


        $slider = new Slider();
        $slider->name = 'Çimento';
        $slider->translate_columns([]);
        $slider->save();

        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 7;
        $slider_element->image_id = 109;
        $slider_element->background_id = 109;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();

        $slider = new Slider();
        $slider->name = 'Kağıt';
        $slider->translate_columns([]);
        $slider->save();

        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 8;
        $slider_element->image_id = 110;
        $slider_element->background_id = 110;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();

        $slider = new Slider();
        $slider->name = 'Arıtma';
        $slider->translate_columns([]);
        $slider->save();

        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 9;
        $slider_element->image_id = 111;
        $slider_element->background_id = 111;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();
        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 9;
        $slider_element->image_id = 112;
        $slider_element->background_id = 112;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();
        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 9;
        $slider_element->image_id = 113;
        $slider_element->background_id = 113;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();


        $slider = new Slider();
        $slider->name = 'Teknik Dökümanlar';
        $slider->translate_columns([]);
        $slider->save();

        $slider_element = new SliderElement();
        $slider_element->title = 'senkronelk';
        $slider_element->slider_id = 10;
        $slider_element->image_id = 114;
        $slider_element->background_id = 114;
        $slider_element->content = 'senkronelk';
        $slider_element->translate_columns([]);
        $slider_element->save();
    }
}
