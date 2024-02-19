<?php

namespace App\Http\Controllers\Api\perkembangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Soal_kpsp;
use App\Jawaban_kpsp;

class KuesionerkpspController extends Controller
{
    public function getsoal(Request $request){
        $jumlahsoal=Soal_kpsp::whereUmur($request->umur)->count();
        //jika bukan soal pertama dan nomor soal lebih kecil dari maksimal soal kuesioner proses jawaban
        if($request->nomorsoal>1){
            $currentdate=date("Y-m-d");
            //jika ada record update jika tidak ada insert record baru
            Jawaban_kpsp::updateOrCreate(
                [
                    'ibu_id' => $request->ibu_id,
                    'umur'=>$request->umur,
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
                $record=$this->setstatusandgeneratesoal($request->ibu_id,$request->umur,$request->nomorsoal);
            }else{ //sebaliknya, jika sudah max soal, tidak perlu generate soal cukup set status ke 'finish'
                $record=['status'=>'finish'];
                $currentdate=date("Y-m-d");
                $jawabanYa=Jawaban_kpsp::whereIbu_id($request->ibu_id)->whereTanggal($currentdate)->whereUmur($request->umur)->whereJawaban("Y")->count();
                if($jawabanYa>8){
                    $statusmonitoring='Sesuai Umur';
                    $saran="Perkembangan anak normal\n\nLanjutkan stimulasi perkembangan\n\nKunjungi petugas kesehatan (Dokter/Bidan/Perawat) 6 bulan lagi";
                }else if($jawabanYa>6){
                        $statusmonitoring='Meragukan';
                        $saran="Perkembangan anak anda meragukan\n\nLakukan stimulasi perkembangan lebih dan giat dengan penuh kasih sayang\n\nKunjungi petugas kesehatan (Dokter/Bidan/Perawat) setiap dua minggu";
                }else{
                    $statusmonitoring='Penyimpangan';
                    $saran="Terdapat penyimpangan terhadap perkembangan anak\n\nSegera kunjungi petugas kesehatan (Dokter/Bidan/Perawat)";
                }
                
                $record=[
                    'status'=>'finish',
                    'statusmonitoring'=>$statusmonitoring,
                    'saran'=>$saran
                ];
            }
        }else{  //jika nomor soal=1 cukup generate soal, tidak perlu proses jawaban
            //set status dan generatesoal
            $record=$this->setstatusandgeneratesoal($request->ibu_id,$request->umur,$request->nomorsoal);
        }
        return response()->json($record);
    }

    private function setstatusandgeneratesoal($ibu_id,$umur,$nomorsoal){
        $status='next';
        $record=Soal_kpsp::whereUmur($umur)->whereNomor($nomorsoal)->first();
        //tarik jawaban dan tambahkan ke respon
        $currentdate=date("Y-m-d");
        //cari apakah jawaban sudah ada,jika ada munclkan jawaban, jika tidak kosongkan jawaban
        $jawaban_model=Jawaban_kpsp::whereIbu_id($ibu_id)->whereUmur($umur)->whereNomor($nomorsoal)->whereTanggal($currentdate);
        //return $jawaban_model->count();
        if($jawaban_model->count()>0){
            $jawaban=$jawaban_model->first()->jawaban;
        }else{
            $jawaban="";
        }
        $record->jawaban=$jawaban;  //tambah properti jawaban di record
        $record->status='next';
        return $record;
    }
}