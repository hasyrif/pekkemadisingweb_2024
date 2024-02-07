<?php

namespace App\Http\Controllers\admin\pertumbuhan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ibu;

class IbuController extends Controller
{
    public function ibu(){
        $records=Ibu::all();
        return view('pertumbuhan/ibu',compact('records'));
    }
}
