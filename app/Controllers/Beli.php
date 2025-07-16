<?php

namespace App\Controllers;
use App\Models\M_sold;
use App\Models\M_mobil;


class Beli extends BaseController
{
   public function index()
    {
        $M_beli = new M_sold();
        $data = [
            'title' => 'Cash Mobil',
            'beli' => $M_beli
                ->where('metode_pembayaran', 'Cash')
                ->orderBy('id_sold', 'desc')
                ->asObject()
                ->findAll()
        ];

        echo view('header', $data);
        echo view('menu');
        echo view('beli/v_beli', $data);
        echo view('footer');
    }
    
    public function kredit()
    {
        $M_beli = new M_sold();
        $data = [
            'title' => 'Pembelian Mobil Metode Credit',
            'beli' => $M_beli
                ->where('metode_pembayaran', 'Kredit')
                ->orderBy('id_sold', 'desc')
                ->asObject()
                ->findAll()
        ];

        echo view('header', $data);
        echo view('menu');
        echo view('beli/kredit', $data);
        echo view('footer');
    }

    public function tambah_beli()
    {
        $M_mobil = new M_mobil();
        $data['title'] = 'Tambah Penjualan';
        $data['mobil'] = $M_mobil->asObject()->where('status', 'Tersedia')->findAll();

        echo view('header', $data);
        echo view('menu');
        echo view('beli/tambah_beli', $data);
        echo view('footer');
    }


    public function aksi_tambah_beli()
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
            return redirect()->to('/jual/manual')->with('error', 'Mobil tidak ditemukan.');
        }

        $profit = $harga_jual - ($mobil->harga_beli + $mobil->total_perbaikan);

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
            'tanggal_jual' => $tanggal_jual
        ]);

        $M_mobil->update($id_mobil, [
            'status' => 'Sold',
            'harga_jual' => $harga_jual
        ]);

        return redirect()->to('beli')->with('success', 'Penjualan mobil berhasil disimpan.');
    }


    public function edit_beli($id_sold)
    {
        $M_sold = new M_sold();
        $M_mobil = new M_mobil();

        $sold = $M_sold->asObject()->find($id_sold);

        if (!$sold) {
            return redirect()->to('/beli')->with('error', 'Data penjualan tidak ditemukan.');
        }

        $data['title'] = 'Edit Penjualan';
        $data['sold'] = $sold;
        $data['mobil'] = $M_mobil->asObject()->where('status', 'Sold')->orWhere('id_mobil', $sold->id_mobil)->findAll();

        echo view('header', $data);
        echo view('menu');
        echo view('beli/edit_beli', $data);
        echo view('footer');
    }

    public function update_beli ($id_sold)
    {
        $M_sold = new M_sold();
        $M_mobil = new M_mobil();

        $sold = $M_sold->asObject()->find($id_sold);
        if (!$sold) {
            return redirect()->to('/beli')->with('error', 'Data penjualan tidak ditemukan.');
        }

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

                if (str_starts_with($imgData['dataUrl'], 'data:')) {
                    $imgContent = explode(',', $imgData['dataUrl'])[1];
                    file_put_contents('uploads/dokumen_pembeli/' . $newName, base64_decode($imgContent));
                    $savedFiles[] = $newName;
                } else {
                    $oldName = basename($imgData['dataUrl']);
                    $savedFiles[] = $oldName;
                }
            }
        }

        $namaDokumen = json_encode($savedFiles);

        $mobil = $M_mobil->asObject()->find($id_mobil);
        if (!$mobil) {
            return redirect()->to('/beli')->with('error', 'Mobil tidak ditemukan.');
        }

        $profit = $harga_jual - ($mobil->harga_beli + $mobil->total_perbaikan);

        $M_sold->update($id_sold, [
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
            'tanggal_jual' => $tanggal_jual
        ]);

        $M_mobil->update($id_mobil, [
            'status' => 'Sold',
            'harga_jual' => $harga_jual
        ]);

        return redirect()->to('/beli')->with('success', 'Data penjualan berhasil diupdate.');
    }

    public function hapus_beli($id)
    {
        $M_beli = new M_sold(); 
        $M_mobil = new M_mobil(); 
        $dataSold = $M_beli->asObject()->find($id);

        if ($dataSold) {
            $M_mobil->update($dataSold->id_mobil, [
                'status' => 'Tersedia'
            ]);

            if ($M_beli->deletePermanen($id)) {
                return redirect()->to(base_url('beli'))->with('success', 'Data beli berhasil dihapus & mobil kembali tersedia');
            } 
        }

        return redirect()->to(base_url('beli'))->with('error', 'Data beli tidak ditemukan atau gagal dihapus');
    }

    public function hapus_kredit($id)
    {
        $M_beli = new M_sold(); 
        $M_mobil = new M_mobil(); 
        $dataSold = $M_beli->asObject()->find($id);

        if ($dataSold) {
            $M_mobil->update($dataSold->id_mobil, [
                'status' => 'Tersedia'
            ]);

            if ($M_beli->deletePermanen($id)) {
                return redirect()->to(base_url('beli/kredit'))->with('success', 'Data beli berhasil dihapus & mobil kembali tersedia');
            } 
        }

        return redirect()->to(base_url('beli/kredit'))->with('error', 'Data beli tidak ditemukan atau gagal dihapus');
    }


}