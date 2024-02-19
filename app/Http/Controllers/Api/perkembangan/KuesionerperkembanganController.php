<?php

namespace App\Http\Controllers\Api\perkembangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Soal_perkembangan;
use App\Jawaban_perkembangan;

class KuesionerperkembanganController extends Controller
{
    public function getsoal(Request $request){
        $jumlahsoal=Soal_perkembangan::count();
        //jika bukan soal pertama dan nomor soal lebih kecil dari maksimal soal kuesioner proses jawaban
        if($request->nomorsoal>1){  
            $currentdate=date("Y-m-d");
            //jika ada record update jika tidak ada insert record baru
            Jawaban_perkembangan::updateOrCreate(
                [
                    'ibu_id' => $request->ibu_id,
                    'jawaban_perkembangan_id' => $request->nomorjawaban,
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
        $record=Soal_perkembangan::find($nomorsoal);
        //tarik jawaban dan tambahkan ke respon
        $currentdate=date("Y-m-d");
        $jawaban_model=Jawaban_perkembangan::whereIbu_id($ibu_id)->whereTanggal($currentdate)->whereJawaban_perkembangan_id($nomorsoal);
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
