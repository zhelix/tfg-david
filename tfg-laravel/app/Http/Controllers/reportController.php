<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
//use Illuminate\Http\Request;
use App\data;
use File;
use App\Http\Requests;
use Illuminate\Http\Response;

class reportController extends Controller
{
    public $var1;

    public function index()
    {


        return view('pages.report')->with([
            'user' => 'David Rodriguez',
            'mapa' => $this->getValueMap(),
            'realTime' => $this->getValueRealTime()
        ]);
    }

    public function getValueMap()
    {
        $mapPosition = data::select('poslon', 'poslat')
            ->where('board_id', 1)
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();
        return $mapPosition[0];
    }

    public function getValueRealTime()
    {
        $dataToday = data::select('id','created_at', 'temp', 'hum', 'gas', 'luz', 'noise', 'poslon', 'poslat')
            ->whereDate('created_at', '=', Carbon::today()->toDateString())
            ->groupBy(DB::raw('HOUR(created_at)'))
            ->get();
        return $dataToday;

    }

    public function generateReport()
    {
        if (Request::get('format')== "csv"){
            $getdb = data::select('created_at', 'temp', 'hum', 'gas', 'luz', 'noise', 'poslon', 'poslat')
                ->whereBetween('created_at',array(Request::get('date1').' 00:00:00',Request::get('date2').' 23:59:59'))
                ->get();
            $fileName = time() . '_datafile.csv';
            File::put(public_path('generated/' . $fileName), $getdb);
            $getArray = json_decode($getdb, true);

            $fp = fopen($fileName, 'w');
            foreach ($getArray as $field) {
                fputcsv($fp, $field);
            }
            fclose($fp);
            return response()->download(public_path('generated/' . $fileName));
        }
        elseif (Request::get('format')== "txt"){
            $getdb = data::select('created_at', 'temp', 'hum', 'gas', 'luz', 'noise', 'poslon', 'poslat')
                ->whereBetween('created_at',array(Request::get('date1').' 00:00:00',Request::get('date2').' 23:59:59'))
                ->get();
            $fileName = time() . '_datafile.txt';
            File::put(public_path('generated/' . $fileName), $getdb);
            return response()->download(public_path('generated/' . $fileName));

        }
    }


}
