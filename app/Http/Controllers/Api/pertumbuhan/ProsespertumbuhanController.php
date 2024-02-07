<?php

namespace App\Http\Controllers\Api\pertumbuhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ibu;
use App\Statuspertumbuhan;
use App\myclass\Helper;
use App\Historibaca;

class ProsespertumbuhanController extends Controller
{
    public function status(Request $request){
        //proses untuk mendapatkan kesimpulan
        $helper=new Helper();
        $statusberatbadan=$helper->statusberatbadan($request->ibu_id,$request->beratbadan,$request->tanggalinput);
        $statuspanjangbadan=$helper->statuspanjangbadan($request->ibu_id,$request->panjangbadan,$request->tanggalinput);

        //input ketabel
        $record=New Statuspertumbuhan;
            $record->tanggalinput=$request->tanggalinput;
            $record->ibu_id=$request->ibu_id;
            $record->beratbadan=$request->beratbadan;
            $record->statusberatbadan=$statusberatbadan['kategori'];
            $record->anjuranberatbadan=$statusberatbadan['anjuran'];
            $record->panjangbadan=$request->panjangbadan;
            $record->statuspanjangbadan=$statuspanjangbadan['kategori'];
            $record->anjuranpanjangbadan=$statuspanjangbadan['anjuran'];
        $record->save();
        $data=[
            'msg'=>'Sukses',
            'panjangbadan'=>$request->panjangbadan,
            'statuspanjangbadan'=>$statuspanjangbadan['kategori'],
            'anjuranpanjangbadan'=>$statuspanjangbadan['anjuran'],
            'beratbadan'=>$request->beratbadan,
            'statusberatbadan'=>$statusberatbadan['kategori'],
            'anjuranberatbadan'=>$statusberatbadan['anjuran']
        ];
        return response()->json($data);
    }

    public function histori(Request $request){
        $records=Statuspertumbuhan::whereIbu_id($request->ibu_id)->get();
        $data[]=[
            "id"=> 0,
            "tanggalinput"=> "",
            "ibu_id"=> "",
            "beratbadan"=> "",
            "statusberatbadan"=> "",
            "panjangbadan"=> "",
            "statuspanjangbadan"=> "",
            "created_at"=> "2021-03-16T07:26:39.000000Z",
            "updated_at"=> "2021-03-16T07:26:39.000000Z"
        ];
        foreach($records as $record){
            $data[]=[
                "id"=> $record->id,
                "tanggalinput"=>$record->tanggalinput,
                "ibu_id"=> $record->ibu_id,
                "beratbadan"=> $record->beratbadan,
                "statusberatbadan"=> $record->statusberatbadan,
                "panjangbadan"=> $record->panjangbadan,
                "statuspanjangbadan"=> $record->statuspanjangbadan,
                "created_at"=> "2021-03-16T07:26:39.000000Z",
                "updated_at"=> "2021-03-16T07:26:39.000000Z"
            ];
        }
        return response()->json(['records'=>$data]);
    }

    public function waktubaca(Request $request){
        //input histori baca ke tabel
        $currentdate=date("Y-m-d");
        $newrecord=New Historibaca;
            $newrecord->tanggal=$currentdate;
            $newrecord->ibu_id=$request->ibu_id;
            $newrecord->waktubaca=$request->waktubaca;
            $newrecord->judulmateri=$request->judulmateri;
        $newrecord->save();
        $data=[
            'msg'=>'Sukses',
        ];
        return response()->json($data);

    }
}
