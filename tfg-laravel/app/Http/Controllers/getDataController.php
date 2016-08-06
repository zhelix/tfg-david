<?php

namespace App\Http\Controllers;

use App\data;
use App\Http\Requests;
use Request;



class getDataController extends Controller
{
    public function setData(){

        $getData = Request::all();
        data::create($getData);
        return $getData;
    }

    function getReport()
    {
        $config_read = Coord::select('temp', 'hum', 'gas','luz','noise','poslon','poslat')
            ->orderBy('created_at', 'desc')
            ->get();
        return $config_read;
    }


}
