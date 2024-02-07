<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\User;
use Session;

class UserController extends Controller
{
    public function login(){
		return view('admin/login');
	}

	public function login_action(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $recorduser=Admin::whereUsername($request->username)->wherePassword($request->password)->get();
        if(count($recorduser)){
            $record=Admin::whereUsername($request->username)->wherePassword($request->password)->first();
            Session::put('ses_id',$record->id);
            Session::put('ses_username',$record->username);
            return redirect('admin/welcome');
        }else{
            Session::flash('message', 'Username / Password Salah!');
            return redirect('admin/welcome');
        }
    }
    
    public function welcome(){
        return view('admin/welcome');
    }
	
	public function getuser(){
		$products = User::all();
        return view('admin/user', compact('products'));
    }
    
    public function logout(){
        return redirect('admin/login');
    }
}
