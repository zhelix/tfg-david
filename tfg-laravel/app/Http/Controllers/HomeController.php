<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('pages.user')->with([
            'userimg' => $this->getUserImage(),
            'username' => $this->getUserName(),
            'usermail' => $this->getUserMail(),
            'usercompany' => $this->getUserCompany()
        ]);
    }

    function getUserImage(){
        return "http://nineplanets.org/images/themoon.jpg";
    }

    function getUserName(){
        return "David Rodriguez Martinez";
    }

    function getUserMail(){
        return "Davidrm146@gmail.com";
    }

    function getUserCompany(){
        return "VLC_Logic";
    }
    
}
