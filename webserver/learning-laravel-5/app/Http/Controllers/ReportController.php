<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ReportController extends Controller
{

   public $var1;

    public function index(){



        return view('pages.report')->with([
            'board0' => 'elav',
            'board1' => $this->getValue0(),
            'board2' => $this->getValue1(),
            'user' => 'David Rodriguez'
        ]);;
    }

    public function getValue0(){
        return "VALUE0";
    }
    public function getValue1(){
        return "VALUE";
    }
    
}
