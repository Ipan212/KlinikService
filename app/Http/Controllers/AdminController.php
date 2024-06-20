<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index(){
        return view('admin');
    }
    function pendaftaran(){
        return view('admin');
    }
    function rekme(){
        return view('admin');
    }
    function transaksi(){
        return view('admin');
    }
} 
