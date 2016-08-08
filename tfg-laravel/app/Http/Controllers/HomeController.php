<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\board;
use App\Http\Controllers\Auth\AuthController;
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
    public function index()
    {
        return view('pages.user')->with(['userinfo' => $this->getUserInfo(),
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
                ->where('id',Auth::user()->id)
            ->take(1)
            ->get();
        return $userInfo[0];
    }

    function getBoardInfo()
    {
        $boardinfo = board::select('id', 'name', 'brand', 'status')
            ->where('user_id', Auth::user()->id)
            ->get();
        return $boardinfo;
    }
}