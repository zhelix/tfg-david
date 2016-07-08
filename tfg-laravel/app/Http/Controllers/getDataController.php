<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class getDataController extends Controller
{
    public function pickData(){
        return view('pages.getDatel');
    }
}
