<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\data;
use App\Http\Requests;
use Illuminate\Http\Response;

class reportController extends Controller
{
    public $var1;

    public function index(){



        return view('pages.report')->with([
            'board0' => 'elav',
            'position' => $this->getValueMap(),
            'board1' => $this->getValue0(),
            'board2' => $this->getValue1(),
            'user' => 'David Rodriguez',
            'mapa' => $this->getValueMap()
        ]);
    }

    public function getValue0(){
        return "VALUE0";
    }
    public function getValue1(){
        return "VALUE";
    }
    public function  getValueMap(){
        $mapPosition = data::select('poslon', 'poslat')
            ->where('board_id', 1)
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();
        return $mapPosition[0];
    }

    public function generateTxt(){
        $mapPosition = data::select('poslon', 'poslat')
            ->where('board_id', 1)
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();
        //return $mapPosition[0];
        return Response::txt()->with($mapPosition);
    }
}
