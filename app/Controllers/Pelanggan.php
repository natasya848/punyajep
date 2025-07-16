<?php

namespace App\Controllers;
use App\Models\M_pelanggan;

class Pelanggan extends BaseController
{
   public function index()
    {
        $M_pelanggan = new M_pelanggan();
        $data = [
            'title' => 'Data Pelanggan',
            'pelanggan' => $M_pelanggan
                ->where('status_delete', 0)
                ->asObject()
                ->findAll()
        ];

        echo view('header', $data);
        echo view('menu');
        echo view('pelanggan/v_pelanggan', $data);
        echo view('footer');
    }

    public function tambah_pelanggan()
	{
        $pelanggan = new M_pelanggan();
        $data['title']='Tambah Data Pelanggan';

		echo view('header', $data);
        echo view('menu');
        echo view('pelanggan/tambah_pelanggan', $data);
        echo view('footer');
	}

    public function aksi_tambah_pelanggan()
    {
        $nama       = $this->request->getPost('nama');
        $nohp       = $this->request->getPost('nohp');
        $alamat       = $this->request->getPost('alamat');

        $data = [
            'nama_pelanggan'   => $nama,
            'no_hp'            => $nohp,
            'alamat'           => $alamat ?: null,
            'created_at'       => date('Y-m-d H:i:s'),
        ];

        $model = new M_pelanggan();
        $model->insert($data);

        return redirect()->to(base_url('pelanggan'))->with('success', 'pelanggan berhasil ditambahkan.');
    }

    public function edit_pelanggan($id)
    {
        $model = new M_pelanggan();
        $data['title'] = 'Edit pelanggan';
        $data['pelanggan'] = $model->asObject()->find($id);

        if (!$data['pelanggan']) {
            return redirect()->to('/pelanggan')->with('error', 'pelanggan tidak ditemukan.');
        }

        echo view('header', $data);
        echo view('menu');
        echo view('pelanggan/edit_pelanggan', $data);
        echo view('footer');
    }

    public function update_pelanggan($id)
    {
        $model = new \App\Models\M_pelanggan();
        $pelanggan = $model->find($id);

        if (!$pelanggan) {
            return redirect()->to('/pelanggan')->with('error', 'pelanggan tidak ditemukan.');
        }

        $nama       = $this->request->getPost('nama');
        $nohp       = $this->request->getPost('nohp');
        $alamat       = $this->request->getPost('alamat') ?: null;

        $data = [
            'nama_pelanggan'   => $nama,
            'no_hp'   => $nohp,
            'alamat'   => $alamat,
            'updated_at'   => date('Y-m-d H:i:s'),
        ];

        $model->update($id, $data);

        return redirect()->to(base_url('pelanggan'))->with('success', 'Data pelanggan berhasil diupdate.');
    }

    public function dihapus_pelanggan()
    {
        // $this->logActivity("Mengakses Tabel Data Data pelanggan yang Dihapus");

        // if (!session()->has('id_user')) { 
        //     return redirect()->to('login/halaman_login');
        // }

        // if (!in_array(session()->get('level'), [1])) {
        //     return redirect()->to('home/dashboard'); 
        // }

        $M_pelanggan = new M_pelanggan();
        $data = [
            'title' => 'Data pelanggan yang Dihapus',
            'deleted_pelanggan' => $M_pelanggan->getDeletedpelanggan(),
            'showWelcome' => false 
        ];

        echo view('header', $data);
        echo view('menu');
        echo view('pelanggan/deleted_pelanggan', $data);
        echo view('footer');
    }

    public function hapus_pelanggan($id)
    {
        $M_pelanggan = new M_pelanggan();
        if ($M_pelanggan->deletePermanen($id)) {
            // $this->logActivity("Menghapus permanen pelanggan ID: $id");

            return redirect()->to(base_url('pelanggan/dihapus_pelanggan'))->with('success', 'Data pelanggan berhasil dihapus secara permanen');
        }
        return redirect()->to(base_url('pelanggan/dihapus_pelanggan'))->with('error', 'Data pelanggan tidak ditemukan atau gagal dihapus');
    }

    public function delete_pelanggan($id)
    {
        $M_pelanggan = new M_pelanggan();
        if ($M_pelanggan->softDelete($id)) {
            // $this->logActivity("Menghapus pelanggan ID: $id (soft delete)");

            return redirect()->to(base_url('pelanggan/dihapus_pelanggan'))->with('success', 'Data pelanggan berhasil dihapus (soft delete)');
        }
        return redirect()->to(base_url('pelanggan'))->with('error', 'Data pelanggan tidak ditemukan atau gagal dihapus');
    }

    public function restore_pelanggan($id)
    {
        $M_pelanggan = new M_pelanggan();

        if ($M_pelanggan->restore($id)) {
            // $this->logActivity("Mengembalikan pelanggan ID: $id (soft delete)");
            return redirect()->to(base_url('pelanggan'))->with('success', 'Data pelanggan berhasil direstore');
        }
        return redirect()->to(base_url('pelanggan/dihapus_pelanggan'))->with('error', 'Data pelanggan tidak ditemukan');
    }

    public function detail_pelanggan($id)
    {
        // $session = session();
        // $user_id = $session->get('id_user'); 
        // $user_level = $session->get('level'); 

        // $logModel = new \App\Models\M_log();
        $M_pelanggan = new M_pelanggan();
        $pelanggan = $M_pelanggan->getpelangganById($id);

        // $logModel->saveLog($pelanggan_id, "id_pelanggan={$pelanggan_id} berhasil melihat detail pelanggan ID {$id}", $ip_address);

        $data = [
            'title' => 'Detail pelanggan',
            'pelanggan' => $pelanggan
        ];

        echo view('header', $data);
        echo view('menu');
        echo view('pelanggan/detail_pelanggan', $data);
        echo view('footer');
    }

}