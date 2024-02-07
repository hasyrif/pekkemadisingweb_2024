<?php

namespace App\Http\Controllers\admin\pertumbuhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\V_rekapjawabanpertumbuhan;
use App\V_rekapprosentasepertumbuhan;
use Illuminate\Support\Facades\DB;

class KuesionerController extends Controller
{
    public function kuesioner(){
        $records=V_rekapjawabanpertumbuhan::all();
        return view('pertumbuhan/kuesioner',compact('records'));
    }
    public function prosentasekuesioner(){
        $records=V_rekapprosentasepertumbuhan::all();
        return view('pertumbuhan/prosentasekuesioner',compact('records'));
    }
    public function historibaca(){
        $records = DB::table('ibus')
            ->join('historibacas', 'ibus.id', '=', 'historibacas.ibu_id')
            ->select('historibacas.tanggal','ibus.nama', 'historibacas.judulmateri','historibacas.waktubaca')
            ->get();
        return view('pertumbuhan/historibaca',compact('records'));
    }
}
