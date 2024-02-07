<?php

namespace App\Http\Controllers\Api\pertumbuhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Historiakses;
use App\Ibu;
use App\Balita;

class IbuController extends Controller
{
    public function login(Request $request)
    {
        $record=Ibu::whereUsername($request->username)->wherePassword($request->password)->get();
        if($record->isEmpty()){
            $response=[
                'msg'=>'User / Password Salah',
            ];
        }
        else{
            $record=Ibu::whereUsername($request->username)->wherePassword($request->password)->first();
            $recordbaru=new Historiakses;
                $recordbaru->user_id=$record->id;
            $recordbaru->save();
            $response=[
                'msg'=>'Berhasil Login',
                'user_id'=>$record->id,
                'nama'=>$record->nama,
                'umur'=>$record->umur,
                'alamat'=>$record->alamat,
                'pekerjaan'=>$record->pekerjaan,
                'pendidikan'=>$record->pendidikan,
                'username'=>$record->username
            ];
        }
        return response()->json($response);
    }

    public function register(Request $request){
        $record=New Ibu;
            $record->nama=$request->nama;
            $record->umur=$request->umur;
            $record->pendidikan=$request->pendidikan;
            $record->pekerjaan=$request->pekerjaan;
            $record->alamat=$request->alamat;
            $record->username=$request->username;
            $record->password=$request->password;
            //data balita
            $record->nama_balita='?';
            $record->tanggallahir='2021-01-01';
            $record->jeniskelamin='P';
            $record->beratbadan='0';
            $record->panjangbadan='0';
        $record->save();
        return response()->json(['msg'=>'Sukses']);
    }

    public function edit(Request $request){
        $record=Ibu::find($request->id);
            $record->nama=$request->nama;
            $record->umur=$request->umur;
            $record->pendidikan=$request->pendidikan;
            $record->pekerjaan=$request->pekerjaan;
            $record->alamat=$request->alamat;
        $record->save();
        return response()->json(['msg'=>'Sukses']);
    }
}
