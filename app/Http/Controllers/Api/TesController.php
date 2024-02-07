<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\myclass\Helper;
use App\Balita;
use App\Beratbadan;
use App\Panjangbadan;

class TesController extends Controller
{
    public function statusberatbadan(){
        $ibu_id=17;
        $beratbadan=5.8;
        $jk='P'; //pria
        $tanggallahir='2020-12-02';
        $tanggalinput='2021-03-13';
        $recordbalita=Balita::find($ibu_id);
        $helper=new Helper();
        $selisihbulan=$helper->selisihbulan($tanggallahir,$tanggalinput);
        $parameter=Beratbadan::whereUmur($selisihbulan)->whereJkel($jk)->first();
        //return $parameterBeratbadan;
        $NikurangMe=$beratbadan-$parameter->median;  // ni/me
        if($NikurangMe>0){
            $ns=$parameter->kanan-$parameter->median;
        }else{
            $ns=$parameter->median-$parameter->kiri;
        }
        $z_score=$NikurangMe/$ns;
        if($z_score>1){
            $kategori='Resiko berat badan lebih';
        }elseif($z_score>=-2){
            $kategori='Berat badan normal';
        }elseif($z_score>=-3){
            $kategori='Berat badan kurang';
        }else{
            $kategori='Berat badan sangat kurang';
        }
        return $kategori;
        /*$tanggallahir = strtotime('2021-02-12');
        $now = strtotime(date("Y-m-d"));
        $months = 0;
        while (($tanggallahir = strtotime('+1 MONTH', $tanggallahir)) <= $now)
            $months++;
            echo $months;*/
    }

    public function statuspanjangbadan(){
        $ibu_id=17;
        $panjangbadan=68;
        $jk='P'; //pria
        $tanggallahir='2020-12-02';
        $tanggalinput='2021-03-13';
        $recordbalita=Balita::find($ibu_id);
        $helper=new Helper();
        $selisihbulan=$helper->selisihbulan($tanggallahir,$tanggalinput);
        $parameter=Panjangbadan::whereUmur($selisihbulan)->whereJkel($jk)->first();
        //return $parameterBeratbadan;
        $NikurangMe=$panjangbadan-$parameter->median;  // ni/me
        if($NikurangMe>0){
            $ns=$parameter->kanan-$parameter->median;
        }else{
            $ns=$parameter->median-$parameter->kiri;
        }
        $z_score=$NikurangMe/$ns;
        if($z_score>3){
            $kategori='Tinggi';
        }elseif($z_score>=-2){
            $kategori='Normal';
        }elseif($z_score>=-3){
            $kategori='Pendek';
        }else{
            $kategori='Sangat pendek';
        }
        return $kategori;
        /*$tanggallahir = strtotime('2021-02-12');
        $now = strtotime(date("Y-m-d"));
        $months = 0;
        while (($tanggallahir = strtotime('+1 MONTH', $tanggallahir)) <= $now)
            $months++;
            echo $months;*/
    }
}
