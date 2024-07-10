<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Pendaftaran;

class AdminController extends Controller
{
    public function index()
    {
        $klinikId = 1; // Sesuaikan dengan ID klinik Al-Basmallah yang sesuai

        // Hitung jumlah pasien yang terdaftar di klinik Al-Basmallah
        $totalPasien = Pasien::whereHas('pendaftaran', function ($query) use ($klinikId) {
            $query->where('id_klinik', $klinikId);
        })->count();

        // Hitung jumlah pasien yang sedang menunggu
        $menunggu = Pendaftaran::where('id_klinik', $klinikId)
            ->where('status', 'menunggu')
            ->count();

        // Hitung jumlah pasien yang sudah dipanggil
        $dipanggil = Pendaftaran::where('id_klinik', $klinikId)
            ->where('status', 'dipanggil')
            ->count();

        return view('admin', compact('totalPasien', 'menunggu', 'dipanggil'));
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

