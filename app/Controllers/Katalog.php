<?php

namespace App\Controllers;

class Katalog extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('stok_mobil')->where('status', 'Tersedia');

        $search = $this->request->getGet('search');
        $price  = $this->request->getGet('price');

        if (!empty($search)) {
            $builder->like('nama_mobil', $search);
        }

        if (!empty($price)) {
            if ($price == '1') {
                $builder->where('harga_mobil >=', 1000)
                        ->where('harga_mobil <=', 999999999);
            } elseif ($price == '2') {
                $builder->where('harga_mobil >', 100000000)
                        ->where('harga_mobil <=', 500000000);
            } elseif ($price == '3') {
                $builder->where('harga_mobil >', 500000000);
            }
        }

        $mobil = $builder->get()->getResult();

        $data = [
            'title' => 'Katalog',
            'mobil' => $mobil,
        ];

        echo view('katalog/index', $data);
    }

}