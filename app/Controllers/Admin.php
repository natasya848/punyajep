<?php

namespace App\Controllers;
    
class Admin extends BaseController
{

    public function index()
    {
        if (session()->get('id_user')>0) {
        $data = [
            'title' => 'Dashboard Admin',
        ];

        echo view('header', $data);
        echo view('menu');
        echo view('dashboard');
        echo view('footer');
    }}
    public function api()
    {
        echo view('menu');
    }
}
