<?php

namespace App\Http\Controllers\Api\pertumbuhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Soalpertumbuhan;
use App\Jawabanpertumbuhan;
use Illuminate\Support\Facades\DB;

class KuesionerpertumbuhanController extends Controller
{
    public function proses(Request $request){
        $jumlahsoal=Soalpertumbuhan::count();
        //jika bukan soal pertama dan nomor soal lebih kecil dari maksimal soal kuesioner proses jawaban
        if($request->nomorsoal>1){  
            $currentdate=date("Y-m-d");
            //jika ada record update jika tidak ada insert record baru
            Jawabanpertumbuhan::updateOrCreate(
                [
                    'ibu_id' => $request->ibu_id,
                    'nomor' => $request->nomorjawaban,
                    'tanggal' => $currentdate
                ],
                [
                    'jawaban' => $request->jawaban
                ]
            );

            //jika nomor soal < dari max soal generate soal, jika tidak cukup set status ke 'finish'
            if($request->nomorsoal<=$jumlahsoal){
                //set status dan generatesoal
                $record=$this->setstatusandgeneratesoal($request->ibu_id,$request->nomorsoal);
            }else{ //sebaliknya, jika sudah max soal, tidak perlu generate soal cukup set status ke 'finish'
                $record=['status'=>'finish'];
            }
        }else{  //jika nomor soal=1 cukup generate soal, tidak perlu proses jawaban
            //set status dan generatesoal
            $record=$this->setstatusandgeneratesoal($request->ibu_id,$request->nomorsoal);
        }
        return response()->json($record);
    }

    private function setstatusandgeneratesoal($ibu_id,$nomorsoal){
        $status='next';
        $record=Soalpertumbuhan::find($nomorsoal);
        //tarik jawaban dan tambahkan ke respon
        $currentdate=date("Y-m-d");
        $jawaban_model=Jawabanpertumbuhan::whereIbu_id($ibu_id)->whereTanggal($currentdate)->whereNomor($nomorsoal);
        //return $jawaban_model->count();
        if($jawaban_model->count()>0){
            $jawaban=$jawaban_model->first()->jawaban;
        }else{
            $jawaban="";
        }
        $record->jawaban=$jawaban;
        $record->status='next';
        return $record;
    }
}
