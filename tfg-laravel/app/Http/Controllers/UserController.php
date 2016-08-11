<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\board;
use App\Http\Requests;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function index()
    {
        return view('pages.user')->with([
            'userinfo' => $this->getUserInfo(),
            'boardinfo' => $this->getBoardInfo()
        ]);
    }

    function getUserImage()
    {
        return "http://nineplanets.org/images/themoon.jpg";
    }


    function getUserInfo()
    {
        $userInfo = User::select('name', 'email', 'company')
            ->where('id', Auth::user()->id)
            ->take(1)
            ->get();
        return $userInfo[0];
    }

    function getBoardInfo()
    {
        $boardQuery = board::select('id', 'name', 'brand', 'status')
            ->where('user_id', Auth::user()->id)
            ->get();
        return $boardQuery;
    }

}

