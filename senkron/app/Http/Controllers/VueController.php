<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Upload;

class VueController extends Controller
{
    public function __invoke()
    {
        return view('vue');
    }


}
