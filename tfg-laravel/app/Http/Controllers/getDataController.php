<?php

namespace App\Http\Controllers;

use App\board;
use App\data;
use App\Http\Requests;
use Request;
use Illuminate\Support\Facades\DB;


class getDataController extends Controller
{

    private $active;

    public function setData(){
        $getData = Request::all();
        data::create($getData);
        if (!$this->active){$this->setWorking(Request::get('board_id'));}
        return $getData;
    }

    public function setWorking($id){

        DB::table('boards')
            ->where('id', $id)
            ->update(['status' => 'Working']);

        $this->active=true;
    }


}
