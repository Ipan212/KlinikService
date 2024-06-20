<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index(){
        return view('login');
    }
    function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email wajib di isi..!',
            'password.required'=>'Password wajib di isi..!',
        ]);
        $infologin = [
            'email'=> $request->email,
            'password'=> $request->password,
        ];
        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'pendaftaran') {
                return redirect('admin/pendaftaran');
            }elseif (Auth::user()-> role == 'rekme') {
                return redirect('admin/rekme');
            }elseif (Auth::user()-> role == 'transaksi') {
                return redirect('admin/transaksi');
            }
        }else {
            return redirect('')->withErrors('Username dan Password yang dimaukan Salah.!')->withInput();
        }
    }
    function logout(){
        Auth::logout();
        return redirect('');
    }
}
