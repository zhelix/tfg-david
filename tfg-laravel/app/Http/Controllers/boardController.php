<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class boardController extends Controller
{
    public function index(){
        return view('pages.board');
    }

    public function monitorize(){
        return view('pages.board')->with([
            'board' => 'arduino1',
            'user' => 'David Rodriguez'
        ]);
    }

    /**
     * @param $aa
     * @return string
     */

    /**
     * @return string
     */

    function alfalfa($aa){
        return "asdas";
    }

}
