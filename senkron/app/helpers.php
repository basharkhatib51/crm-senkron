<?php
//
use App\Models\Translation;
use Symfony\Component\VarDumper\VarDumper;

//
//if (!function_exists('dd')) {
//    function dd(...$vars)
//    {
//        header('Access-Control-Allow-Origin:  http://localhost:8080');
//        header('Access-Control-Allow-Credentials:  true');
//        foreach ($vars as $v) {
//            VarDumper::dump($v);
//        }
//
//        exit(1);
//    }
//}

if (!function_exists('lang')) {
    function lang($val)
    {
        $translations = Translation::all()->pluck('content_translations.' . app()->getLocale(), 'content')->toArray();
        if (array_key_exists($val, $translations)) {
            if ($translations[$val]) {
                return $translations[$val];
            }
        } else {
            $translation = new Translation();
            $translation->content = $val;
            $translation->translate_columns([]);
            $translation->save();
        }
//    dd($translations, $val);
        return $val;
    }
}
