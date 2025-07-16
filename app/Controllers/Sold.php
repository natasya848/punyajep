<?php

namespace App\Controllers;
use App\Models\M_sold;
use App\Models\M_mobil;

class Sold extends BaseController
{
   public function index()
    {
        $M_sold = new M_sold();
        $data = [
            'title' => 'Sold',
            'sold' => $M_sold
                ->asObject()
                ->orderBy('id_sold', 'desc')
                ->findAll()
        ];

        echo view('header', $data);
        echo view('menu');
        echo view('sold/v_sold', $data);
        echo view('footer');
    }

    // public function tambah_sold()
	// {
	// 	$model = new M_sold();
	// 	$data['title']='Tambah Data Stok sold';

	// 	echo view('header', $data);
    //     echo view('menu');
    //     echo view('data/tambah_sold', $data);
    //     echo view('footer');
	// }

    // public function aksi_tambah_sold()
    // {
    //     $nama       = $this->request->getPost('nama');
    //     $kode       = $this->request->getPost('kode');
    //     $plat       = $this->request->getPost('plat');
    //     $harga      = $this->request->getPost('harga');
    //     $stok       = $this->request->getPost('stok');
    //     $keterangan = $this->request->getPost('keterangan');
    //     $masuk      = $this->request->getPost('masuk');
    //     $keluar     = $this->request->getPost('keluar'); 

    //     $harga_bersih = str_replace(['Rp', '.', ' '], '', $harga);

    //     $fileFoto = $this->request->getFile('foto');
    //     $namaFoto = null;

    //     if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
    //         $namaFoto = $fileFoto->getRandomName(); 
    //         $fileFoto->move('uploads/sold', $namaFoto); 
    //     }

    //     $data = [
    //         'nama_sold'   => $nama,
    //         'kode_sold'   => $kode,
    //         'plat_sold'   => $plat,
    //         'harga_sold'  => $harga_bersih,
    //         'stok'         => $stok,
    //         'keterangan'   => $keterangan,
    //         'tanggal_masuk'    => $masuk,
    //         'tanggal_keluar'   => $keluar ?: null, 
    //         'foto_sold'   => $namaFoto,
    //         'created_at'   => date('Y-m-d H:i:s'),
    //     ];

    //     $model = new M_sold();
    //     $model->insert($data);

    //     return redirect()->to(base_url('sold'))->with('success', 'sold berhasil ditambahkan.');
    // }

    // public function edit_sold($id)
    // {
    //     $model = new M_sold();
    //     $data['title'] = 'Edit Stok sold';
    //     $data['sold'] = $model->asObject()->find($id);

    //     if (!$data['sold']) {
    //         return redirect()->to('/sold')->with('error', 'sold tidak ditemukan.');
    //     }

    //     echo view('header', $data);
    //     echo view('menu');
    //     echo view('data/edit_sold', $data);
    //     echo view('footer');
    // }

    // public function update_sold($id)
    // {
    //     $model = new \App\Models\M_sold();
    //     $sold = $model->find($id);

    //     if (!$sold) {
    //         return redirect()->to('/sold')->with('error', 'sold tidak ditemukan.');
    //     }

    //     $nama       = $this->request->getPost('nama');
    //     $kode       = $this->request->getPost('kode');
    //     $plat       = $this->request->getPost('plat');
    //     $harga      = str_replace(['Rp', '.', ' '], '', $this->request->getPost('harga'));
    //     $stok       = $this->request->getPost('stok');
    //     $keterangan = $this->request->getPost('keterangan');
    //     $masuk      = $this->request->getPost('masuk');
    //     $keluar     = $this->request->getPost('keluar') ?: null;

    //     $fileFoto = $this->request->getFile('foto');
    //     $namaFoto = $sold['foto_sold']; 

    //     if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
    //         $namaFoto = $fileFoto->getRandomName();
    //         $fileFoto->move('uploads/sold', $namaFoto);

    //         if ($sold['foto_sold'] && file_exists('uploads/sold/' . $sold['foto_sold'])) {
    //             unlink('uploads/sold/' . $sold['foto_sold']);
    //         }
    //     }

    //     $data = [
    //         'nama_sold'   => $nama,
    //         'kode_sold'   => $kode,
    //         'plat_sold'   => $plat,
    //         'harga_sold'  => $harga,
    //         'stok'         => $stok,
    //         'keterangan'   => $keterangan,
    //         'tanggal_masuk'    => $masuk,
    //         'tanggal_keluar'   => $keluar,
    //         'foto_sold'   => $namaFoto,
    //         'updated_at'   => date('Y-m-d H:i:s'),
    //     ];

    //     $model->update($id, $data);

    //     return redirect()->to(base_url('sold'))->with('success', 'Data sold berhasil diupdate.');
    // }


    public function hapus_sold($id)
    {
        $M_beli = new M_sold(); 
        $M_mobil = new M_mobil(); 
        $dataSold = $M_beli->asObject()->find($id);

        if ($dataSold) {
            $M_mobil->update($dataSold->id_mobil, [
                'status' => 'Tersedia'
            ]);

            if ($M_beli->deletePermanen($id)) {
                return redirect()->to(base_url('sold'))->with('success', 'Data beli berhasil dihapus & mobil kembali tersedia');
            } 
        }

        return redirect()->to(base_url('sold'))->with('error', 'Data beli tidak ditemukan atau gagal dihapus');
    }


    public function printImage($id)
{
    $M_sold = new M_sold();
    $dataSold = $M_sold->getsoldById($id);
    $dataSold = $M_sold->getSoldWithMobil($id);


    if (!$dataSold) {
        return redirect()->to('/sold')->with('error', 'Data tidak ditemukan.');
    }

    return view('sold/kwitansi_image', ['sold_mobil' => $dataSold]);
}


}