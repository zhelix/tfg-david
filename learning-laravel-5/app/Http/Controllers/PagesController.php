<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function about(){
        $name = 'David <span style="color:red">Rodriguez</span>';

        return view('pages.about')->with([
            'first' => 'David',
            'last' => 'Rodriguez'
        ]);
    }

}
