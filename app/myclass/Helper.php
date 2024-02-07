<?php
namespace App\myclass;
use DateTime;
use App\Ibu;
use App\Beratbadan;
use App\Panjangbadan;
//use Illuminate\Support\Facades\DB;
class Helper{
    public function tes(){
        echo 's';
    }
    public function selisihbulan($tanggallahir,$tanggalinput){
        $tanggallahir = strtotime($tanggallahir);
        $tanggalinput=strtotime($tanggalinput);
        //$tanggalinput = strtotime(date("Y-m-d"));
        $selisihbulan = 0;
        while (($tanggallahir = strtotime('+1 MONTH', $tanggallahir)) <= $tanggalinput)
            $selisihbulan++;
        return $selisihbulan;
    }
    public function statusberatbadan($ibu_id,$beratbadan,$tanggalinput){
        $record=Ibu::find($ibu_id);
        $jk=$record->jeniskelamin;
        $tanggallahir=$record->tanggallahir;
        $selisihbulan=$this->selisihbulan($tanggallahir,$tanggalinput);
        $parameter=Beratbadan::whereUmur($selisihbulan)->whereJkel($jk)->first();

        $NikurangMe=$beratbadan-$parameter->median;  // ni/me
        if($NikurangMe>0){
            $ns=$parameter->kanan-$parameter->median;
        }else{
            $ns=$parameter->median-$parameter->kiri;
        }
        $z_score=$NikurangMe/$ns;
        if($z_score>1){
            $kategori='Resiko berat badan lebih';
            $anjuran='Segera bawa balita pada tenaga kesehatan terdekat untuk dilakukan pemeriksaan tumbuh kembang lanjutan';
        }elseif($z_score>=-2){
            $kategori='Berat badan normal';
            $anjuran='Pertahankan pemberian asuhan yang dianjurkan';
        }elseif($z_score>=-3){
            $kategori='Berat badan kurang';
            $anjuran='Segera bawa balita pada tenaga kesehatan terdekat untuk dilakukan pemeriksaan tumbuh kembang lanjutan';
        }else{
            $kategori='Berat badan sangat kurang';
            $anjuran='Segera bawa balita pada tenaga kesehatan terdekat untuk dilakukan pemeriksaan tumbuh kembang lanjutan';
        }
        return ['kategori'=>$kategori,'anjuran'=>$anjuran];
    }

    public function statuspanjangbadan($ibu_id,$panjangbadan,$tanggalinput){
        $record=Ibu::find($ibu_id);
        $jk=$record->jeniskelamin;
        $tanggallahir=$record->tanggallahir;
        $selisihbulan=$this->selisihbulan($tanggallahir,$tanggalinput);
        $parameter=Panjangbadan::whereUmur($selisihbulan)->whereJkel($jk)->first();

        $NikurangMe=$panjangbadan-$parameter->median;  // ni/me
        if($NikurangMe>0){
            $ns=$parameter->kanan-$parameter->median;
        }else{
            $ns=$parameter->median-$parameter->kiri;
        }
        $z_score=$NikurangMe/$ns;

        $z_score=$NikurangMe/$ns;
        if($z_score>3){
            $kategori='Tinggi';
            $anjuran='Segera bawa balita pada tenaga kesehatan terdekat untuk dilakukan pemeriksaan tumbuh kembang lanjutan';
        }elseif($z_score>=-2){
            $kategori='Normal';
            $anjuran='Pertahankan pemberian asuhan yang dianjurkan';
        }elseif($z_score>=-3){
            $kategori='Pendek';
            $anjuran='Segera bawa balita pada tenaga kesehatan terdekat untuk dilakukan pemeriksaan tumbuh kembang lanjutan';
        }else{
            $kategori='Sangat pendek';
            $anjuran='Segera bawa balita pada tenaga kesehatan terdekat untuk dilakukan pemeriksaan tumbuh kembang lanjutan';
        }
        return ['kategori'=>$kategori,'anjuran'=>$anjuran];
    }
}
?>