<?php

namespace App\Http\Controllers\admin\pertumbuhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Statuspertumbuhan;

class BalitaController extends Controller
{
    public function balita($ibu_id){
        //$records=Statuspertumbuhan::whereIbu_id($ibu_id)->get();
        $records = DB::table('ibus')
            ->join('statuspertumbuhans', 'ibus.id', '=', 'statuspertumbuhans.ibu_id')
            ->select('ibus.nama','ibus.nama_balita','ibus.tanggallahir', 'statuspertumbuhans.*')
            ->where('ibus.id','=',$ibu_id)
            ->get();
        return view('pertumbuhan/balita',compact('records'));
    }
}
