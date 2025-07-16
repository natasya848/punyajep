<?php

namespace App\Controllers;
use App\Models\M_mobil;
use App\Models\M_sold;


class Mobil extends BaseController
{
   public function index()
    {
        $M_mobil = new M_mobil();
        $data = [
            'title' => 'Stok Mobil',
            'a' => $M_mobil
                ->where('status_delete', 0)
                ->orderBy('id_mobil', 'desc')
                ->asObject()
                ->findAll()
        ];

        echo view('header', $data);
        echo view('menu');
        echo view('data/v_mobil', $data);
        echo view('footer');
    }


    public function tambah_mobil()
	{
		$model = new M_mobil();
		$data['title']='Tambah Data Stok Mobil';

		echo view('header', $data);
        echo view('menu');
        echo view('data/tambah_mobil', $data);
        echo view('footer');
	}

    public function aksi_tambah_mobil()
    {
        $plat            = $this->request->getPost('plat');
        $nama            = $this->request->getPost('nama');
        $harga_beli      = str_replace(['Rp', '.', ' '], '', $this->request->getPost('harga_beli'));
        $harga_jual      = str_replace(['Rp', '.', ' '], '', $this->request->getPost('harga_jual'));
        $total_perbaikan = str_replace(['Rp', '.', ' '], '', $this->request->getPost('total_perbaikan'));
        $keterangan      = $this->request->getPost('keterangan');
        $masuk           = $this->request->getPost('masuk');
        $status          = $this->request->getPost('status');

        $fileFoto = $this->request->getFile('foto');
        $namaFoto = null;

        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName(); 
            $fileFoto->move('uploads/mobil', $namaFoto); 
        }

        $data = [
            'plat_mobil'      => $plat,
            'nama_mobil'      => $nama,
            'harga_beli'      => $harga_beli,
            'harga_jual'      => $harga_jual,
            'total_perbaikan' => $total_perbaikan,
            'keterangan'      => $keterangan,
            'tanggal_masuk'   => $masuk,
            'foto_mobil'      => $namaFoto,
            'status'          => $status,
            'created_at'      => date('Y-m-d H:i:s'),
        ];

        $model = new M_mobil();
        $model->insert($data);

        return redirect()->to(base_url('mobil'))->with('success', 'Mobil berhasil ditambahkan.');
    }

    public function jual($id) 
    {
        $M_mobil = new M_mobil();
        $data['title'] = 'Jual Mobil';
        $data['mobil'] = $M_mobil->asObject()->find($id);

        if (!$data['mobil']) {
            return redirect()->to('/mobil')->with('error', 'Mobil tidak ditemukan.');
        }

        echo view('header', $data);
        echo view('menu');
        echo view('data/jual_mobil', $data);
        echo view('footer');
    }

    // public function simpan_jual()
    // {
    //     $id_mobil = $this->request->getPost('id_mobil');
    //     $pembeli = $this->request->getPost('pembeli');
    //     $tanggal_jual = $this->request->getPost('tanggal_jual');
    //     $metode_pembayaran = $this->request->getPost('metode_pembayaran');
    //     $harga_jual_input = $this->request->getPost('harga_jual');
    //     $harga_jual = (int) str_replace(['Rp', '.', ' ', ','], '', $harga_jual_input);

    //     $dataImages = json_decode($this->request->getPost('dokumen_pembeli_data'), true);
    //     $savedFiles = [];

    //     if ($dataImages && is_array($dataImages)) {
    //         foreach ($dataImages as $imgData) {
    //             $newName = uniqid() . '-' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $imgData['name']);
    //             $imgContent = explode(',', $imgData['dataUrl'])[1];
    //             file_put_contents('uploads/dokumen_pembeli/' . $newName, base64_decode($imgContent));
    //             $savedFiles[] = $newName;
    //         }
    //     }

    //     $namaDokumen = json_encode($savedFiles);

    //     $M_mobil = new M_mobil();
    //     $mobil = $M_mobil->asObject()->find($id_mobil);

    //     if (!$mobil) {
    //         return redirect()->to('/mobil')->with('error', 'Mobil tidak ditemukan.');
    //     }

    //     $profit = $harga_jual - ($mobil->harga_beli + $mobil->total_perbaikan);

    //     $M_sold = new M_sold();
    //     $M_sold->insert([
    //         'id_mobil' => $id_mobil,
    //         'foto_mobil' => $mobil->foto_mobil,
    //         'plat_mobil' => $mobil->plat_mobil,
    //         'pembeli' => $pembeli,
    //         'metode_pembayaran' => $metode_pembayaran,
    //         'dokumen_pembeli' => $namaDokumen,
    //         'harga_beli' => $mobil->harga_beli,
    //         'harga_jual' => $harga_jual,
    //         'total_perbaikan' => $mobil->total_perbaikan,
    //         'profit' => $profit,
    //         'tanggal_jual' => $tanggal_jual
    //     ]);

    //     $M_mobil->update($id_mobil, [
    //         'status' => 'Sold',
    //         'harga_jual' => $harga_jual
    //     ]);

    //     return redirect()->to('/mobil')->with('success', 'Mobil berhasil dijual.');
    // }
    
    public function simpan_jual()
    {
        $id_mobil = $this->request->getPost('id_mobil');
        $pembeli = $this->request->getPost('pembeli');
        $tanggal_jual = $this->request->getPost('tanggal_jual');
        $metode_pembayaran = $this->request->getPost('metode_pembayaran');
        $harga_jual_input = $this->request->getPost('harga_jual');
        $harga_jual = (int) str_replace(['Rp', '.', ' ', ','], '', $harga_jual_input);

        $dataImages = json_decode($this->request->getPost('dokumen_pembeli_data'), true);
        $savedFiles = [];

        if ($dataImages && is_array($dataImages)) {
            foreach ($dataImages as $imgData) {
                $newName = uniqid() . '-' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $imgData['name']);
                $imgContent = explode(',', $imgData['dataUrl'])[1];
                file_put_contents('uploads/dokumen_pembeli/' . $newName, base64_decode($imgContent));
                $savedFiles[] = $newName;
            }
        }

        $namaDokumen = json_encode($savedFiles);

        $M_mobil = new M_mobil();
        $mobil = $M_mobil->asObject()->find($id_mobil);

        if (!$mobil) {
            return redirect()->to('/mobil')->with('error', 'Mobil tidak ditemukan.');
        }

        $profit = null;
        $profit_credit = null;

        if ($metode_pembayaran == 'Cash') {
            // Hitung profit langsung kalau cash
            $profit = $harga_jual - ($mobil->harga_beli + $mobil->total_perbaikan);
        }

        $M_sold = new M_sold();
        $M_sold->insert([
            'id_mobil' => $id_mobil,
            'foto_mobil' => $mobil->foto_mobil,
            'plat_mobil' => $mobil->plat_mobil,
            'pembeli' => $pembeli,
            'metode_pembayaran' => $metode_pembayaran,
            'dokumen_pembeli' => $namaDokumen,
            'harga_beli' => $mobil->harga_beli,
            'harga_jual' => $harga_jual,
            'total_perbaikan' => $mobil->total_perbaikan,
            'profit' => $profit,
            'profit_credit' => $profit_credit,
            'tanggal_jual' => $tanggal_jual
        ]);

        // Update mobil jadi sold
        $M_mobil->update($id_mobil, [
            'status' => 'Sold',
            'harga_jual' => $harga_jual
        ]);

        return redirect()->to('/mobil')->with('success', 'Mobil berhasil dijual.');
    }


    public function edit_mobil($id)
    {
        $model = new M_mobil();
        $data['title'] = 'Edit Data Stok Mobil';
        $data['mobil'] = (object) $model->find($id);

        echo view('header', $data);
        echo view('menu');
        echo view('data/edit_mobil', $data);
        echo view('footer');
    }

    public function aksi_edit_mobil($id)
    {
        $model = new M_mobil();
        $modelSold = new M_sold();

        $plat            = $this->request->getPost('plat');
        $nama            = $this->request->getPost('nama');
        $harga_beli      = str_replace(['Rp', '.', ' '], '', $this->request->getPost('harga_beli'));
        $harga_jual      = str_replace(['Rp', '.', ' '], '', $this->request->getPost('harga_jual'));
        $total_perbaikan = str_replace(['Rp', '.', ' '], '', $this->request->getPost('total_perbaikan'));
        $keterangan      = $this->request->getPost('keterangan');
        $masuk           = $this->request->getPost('masuk');
        $status          = $this->request->getPost('status');

        $mobil = $model->find($id);

        $fileFoto = $this->request->getFile('foto');
        $namaFoto = $mobil['foto_mobil'];

        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName(); 
            $fileFoto->move('uploads/mobil', $namaFoto);
        }

        $model->update($id, [
            'plat_mobil'      => $plat,
            'nama_mobil'      => $nama,
            'harga_beli'      => $harga_beli,
            'harga_jual'      => $harga_jual,
            'total_perbaikan' => $total_perbaikan,
            'keterangan'      => $keterangan,
            'tanggal_masuk'   => $masuk,
            'foto_mobil'      => $namaFoto,
            'status'          => $status,
            'updated_at'      => date('Y-m-d H:i:s'),
        ]);

        $soldExist = $modelSold->where('id_mobil', $id)->first();
        if ($soldExist) {
            $modelSold->where('id_mobil', $id)->set([
                'plat_mobil'      => $plat,
                'foto_mobil'      => $namaFoto,
                'harga_beli'      => $harga_beli,
                'harga_jual'      => $harga_jual,
                'total_perbaikan' => $total_perbaikan,
                'updated_at'      => date('Y-m-d H:i:s'),
            ])->update();
        }

        return redirect()->to(base_url('mobil'))->with('success', 'Data mobil berhasil diupdate.');
    }


    // public function dihapus_mobil()
    // {
    //     $this->logActivity("Mengakses Tabel Data Data Mobil yang Dihapus");

    //     if (!session()->has('id_user')) { 
    //         return redirect()->to('login/halaman_login');
    //     }

    //     if (!in_array(session()->get('level'), [1])) {
    //         return redirect()->to('home/dashboard'); 
    //     }

    //     $M_mobil = new M_mobil();
    //     $data = [
    //         'title' => 'Stok Mobil yang Dihapus',
    //         'deleted_mobil' => $M_mobil->getDeletedMobil(),
    //         'showWelcome' => false 
    //     ];

    //     echo view('header', $data);
    //     echo view('menu');
    //     echo view('data/deleted_mobil', $data);
    //     echo view('footer');
    // }

    public function hapus_mobil($id)
    {
        $M_mobil = new M_mobil();
        if ($M_mobil->deletePermanen($id)) {
            // $this->logActivity("Menghapus permanen mobil ID: $id");

            return redirect()->to(base_url('mobil'))->with('success', 'Data Mobil berhasil dihapus secara permanen');
        }
        return redirect()->to(base_url('mobil'))->with('error', 'Data Mobil tidak ditemukan atau gagal dihapus');
    }

    // public function delete_mobil($id)
    // {
    //     $M_mobil = new M_mobil();
    //     if ($M_mobil->softDelete($id)) {
    //         // $this->logActivity("Menghapus mobil ID: $id (soft delete)");

    //         return redirect()->to(base_url('mobil/dihapus_mobil'))->with('success', 'Data Mobil berhasil dihapus (soft delete)');
    //     }
    //     return redirect()->to(base_url('mobil'))->with('error', 'Data Mobil tidak ditemukan atau gagal dihapus');
    // }

    // public function restore_mobil($id)
    // {
    //     $M_mobil = new M_mobil();

    //     if ($M_mobil->restore($id)) {
    //         // $this->logActivity("Mengembalikan mobil ID: $id (soft delete)");
    //         return redirect()->to(base_url('mobil'))->with('success', 'Data Mobil berhasil direstore');
    //     }
    //     return redirect()->to(base_url('mobil/dihapus_mobil'))->with('error', 'Data Mobil tidak ditemukan');
    // }

    public function detail_mobil($id)
    {
        // $session = session();
        // $user_id = $session->get('id_user'); 
        // $user_level = $session->get('level'); 

        // $logModel = new \App\Models\M_log();
        $M_mobil = new M_mobil();
        $mobil = $M_mobil->getmobilById($id);

        // $logModel->saveLog($mobil_id, "id_mobil={$mobil_id} berhasil melihat detail mobil ID {$id}", $ip_address);

        $data = [
            'title' => 'Detail Stok mobil',
            'mobil' => $mobil
        ];

        echo view('header', $data);
        echo view('menu');
        echo view('data/detail_mobil', $data);
        echo view('footer');
    }

public function simpanProfitCredit($id)
{
    // echo '<pre>';
    // print_r($this->request->getPost());
    // echo '</pre>';
    // exit;

    $M_sold = new M_sold();
    $mobil = $M_sold->asObject()->find($id);

    if (!$mobil) {
        return redirect()->to('/beli/kredit')->with('error', 'Data penjualan tidak ditemukan.');
    }

    $profit_credit_input = $this->request->getPost('profit_credit');

    $profit_credit_clean = preg_replace('/[^\d]/', '', $profit_credit_input);

    $profit_credit = (int) $profit_credit_clean;

    $M_sold->update($id, [
        'profit_credit' => $profit_credit,
        'profit' => 0
    ]);

    return redirect()->to('/beli/kredit')->with('success', 'Profit Kredit berhasil disimpan.');
}





}