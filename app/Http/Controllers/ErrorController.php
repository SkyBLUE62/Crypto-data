<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function error404(){
        return view('error.error404');

    }

    public function error429(){
        return view('error.error429');
    }

}
