<?php

namespace App\Http\Controllers;

use App\data;
use App\Http\Requests;
use Request;



class getDataController extends Controller
{
    public function pickData(){

        $getData = Request::all();
        data::create($getData);
        return $getData;
    }


}
