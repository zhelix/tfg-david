<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function generateTxt()
    {

        $getdb = data::select('created_at', 'temp', 'hum', 'gas', 'luz', 'noise', 'poslon', 'poslat')
            ->orderBy('created_at', 'desc')
            ->take(8460)
            ->get();
        $fileName = time() . '_datafile.txt';
        File::put(public_path('generated/' . $fileName), $getdb);
        return response()->download(public_path('generated/' . $fileName));

    }

    public function generateTxtBeetwen($date1,$date2)
    {

        $getdb = data::select('created_at', 'temp', 'hum', 'gas', 'luz', 'noise', 'poslon', 'poslat')
            ->orderBy('created_at', 'desc')
            ->take(8460)
            ->get();
        $fileName = time() . '_datafile.txt';
        File::put(public_path('generated/' . $fileName), $getdb);
        return response()->download(public_path('generated/' . $fileName));

    }


    public function generateCsv()
    {
        $getdb = data::select('created_at', 'temp', 'hum', 'gas', 'luz', 'noise', 'poslon', 'poslat')
            ->orderBy('created_at', 'desc')
            ->take(8460)
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


}
