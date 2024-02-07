<?php

namespace App\Http\Controllers\Api\pertumbuhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\myclass\Helper;
use App\Ibu;

class BalitaController extends Controller
{
    public function balita(Request $request){
        $record=Ibu::find($request->ibu_id);
        return response()->json($record);
    }
    public function edit(Request $request){
        $record=Ibu::find($request->ibu_id);
            $record->nama_balita=$request->nama;
            $record->tanggallahir=$request->tanggallahir;
            $record->jeniskelamin=$request->jeniskelamin;
            $record->beratbadan=$request->beratbadan;
            $record->panjangbadan=$request->panjangbadan;
        $record->save();
        return response()->json(['msg'=>'Sukses']);
    }

    public function getnamadanumur(Request $request){
        $record=Ibu::select('nama_balita','tanggallahir')->find($request->ibu_id);
        $helper=new Helper();
        $selisihbulan=$helper->selisihbulan($record->tanggallahir,date('Y-m-d'));
        $jumlahtahun=floor($selisihbulan/12);
        $jumlahbulan=$selisihbulan % 12;
        $data=[
            'namabalita'=>$record->nama_balita,
            'umur'=>$selisihbulan,
            'selisihtahundanbulan'=>$jumlahtahun.' tahun '.$jumlahbulan.' bulan'
        ];
        return response()->json($data);
    }
}