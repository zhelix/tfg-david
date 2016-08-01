<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{

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
