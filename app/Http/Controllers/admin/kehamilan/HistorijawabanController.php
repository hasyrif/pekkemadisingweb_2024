<?php

namespace App\Http\Controllers\admin\Kehamilan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jawabanprakehamilan;
use App\Jawabanpostkehamilan;
use App\Soalprakehamilan;

class HistorijawabanController extends Controller
{
    public function historijawaban($user_id){
        for($nomor=1;$nomor<=15;$nomor++){
            $jawabanpra=Jawabanprakehamilan::whereUser_id($user_id)->whereSoalprakehamilan_id($nomor);
            if($jawabanpra->count()<1){
                $jawaban='?';
            }else{
                $jawaban=$jawabanpra->first()->jawaban;
            }
            $jawabanpras[]=$jawaban;
        }

        for($nomor=1;$nomor<=15;$nomor++){
            $jawabanpost=Jawabanpostkehamilan::whereUser_id($user_id)->whereSoalprakehamilan_id($nomor);
            if($jawabanpost->count()<1){
                $jawaban='?';
            }else{
                $jawaban=$jawabanpost->first()->jawaban;
            }
            $jawabanposts[]=$jawaban;
        }

        //ambil pertanyaan untuk di munculkan di view
        $soals=Soalprakehamilan::all();
        
        return view('admin.kehamilan.historijawaban',compact('jawabanpras','jawabanposts','soals'));
    }
}
