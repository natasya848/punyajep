<?php

namespace App\Controllers;
use App\Models\M_mobil;

class Home extends BaseController
{

    public function index()
    {
        $mobilModel = new M_mobil();
        $mobil = $mobilModel->where('status', 'Tersedia')->findAll();

        $data = [
            'title' => 'Anugrah Mobilindo Batam | Showroom Mobil Terpercaya',
            'mobil' => $mobil
        ];

        return view('dashboard2', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'contact',
        ];

        echo view('forms/contact', $data);
    }

    public function newsletter()
    {
        $data = [
            'title' => 'berita',
        ];

        echo view('forms/newsletter', $data);
    }
    
}
