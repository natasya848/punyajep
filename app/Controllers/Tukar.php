<?php

namespace App\Controllers;
use App\Models\M_sold;
use App\Models\M_mobil;
use App\Models\M_tukar_tambah;

class tukar extends BaseController
{
    public function index()
    {
        $model = new M_tukar_tambah();
        $data['title'] = 'Tukar Tambah Mobil';
        $data['tukar'] = $model
            ->asObject()
            ->select('
                tukar_tambah.*,
                sold_mobil.*,
                stok_mobil.nama_mobil, stok_mobil.plat_mobil
            ')
            ->join('sold_mobil', 'sold_mobil.id_sold = tukar_tambah.id_sold', 'left')
            ->join('stok_mobil', 'stok_mobil.id_mobil = sold_mobil.id_mobil', 'left')
            ->orderBy('tukar_tambah.id', 'desc')
            ->findAll();

        echo view('header', $data);
        echo view('menu');
        echo view('tukar/v_tukar', $data);
        echo view('footer');
    }

    public function kredit()
    {
        $M_tukar = new M_sold();
        $data = [
            'title' => 'Pemtukaran Mobil Metode Credit',
            'tukar' => $M_tukar
                ->where('metode_pembayaran', 'Kredit')
                ->asObject()
                ->findAll()
        ];

        echo view('header', $data);
        echo view('menu');
        echo view('tukar/kredit', $data);
        echo view('footer');
    }

    public function tambah()
    {
        $model = new M_mobil();
        $data = [
            'title' => 'Tukar Tambah Mobil',
            'mobil' => $model
                ->where('status', 'Tersedia')
                ->asObject()
                ->findAll()
        ];

        return view('header', $data)
            . view('menu')
            . view('tukar/tambah', $data)
            . view('footer');
    }

    public function aksi_tambah_tukar()
    {
        $request = $this->request;
        $id_mobil = $request->getPost('id_mobil');
        $nama_pembeli = $request->getPost('pembeli');
        $nama_mobil_tukar = $request->getPost('nama_mobil_tukar');
        $harga_tukar = str_replace(['Rp', '.', ' '], '', $request->getPost('harga_tukar'));
        $harga_jual = str_replace(['Rp', '.', ' '], '', $request->getPost('harga_jual'));
        $metode = $request->getPost('metode_pembayaran');
        $tanggal_jual = $request->getPost('tanggal_jual');

        $fileTukar = $request->getFile('foto_mobil_tukar');
        $fotoTukar = null;
        if ($fileTukar && $fileTukar->isValid()) {
            $fotoTukar = $fileTukar->getRandomName();
            $fileTukar->move('uploads/mobil_tukar', $fotoTukar);
        }

        $dokumenJson = $request->getPost('dokumen_pembeli_data');
        $dokumenDecoded = [];
        if ($dokumenJson) {
            $dataImages = json_decode($dokumenJson, true);
            foreach ($dataImages as $imgData) {
                $newName = uniqid().'-'.$imgData['name'];
                $imgContent = explode(',', $imgData['dataUrl'])[1];
                file_put_contents('uploads/dokumen_pembeli/'.$newName, base64_decode($imgContent));
                $dokumenDecoded[] = $newName;
            }
        }
        $namaDokumen = json_encode($dokumenDecoded);

        $modelMobil = new M_mobil();
        $mobil = $modelMobil->find($id_mobil);

        $total_modal = $mobil['harga_beli'] + $mobil['total_perbaikan'];
        $profit = $harga_jual - $total_modal; 

        $modelSold = new M_sold();
        $id_sold = $modelSold->insert([
            'id_mobil' => $id_mobil,
            'foto_mobil' => $mobil['foto_mobil'],
            'plat_mobil' => $mobil['plat_mobil'],
            'pembeli' => $nama_pembeli,
            'dokumen_pembeli' => $namaDokumen,
            'metode_pembayaran' => $metode,
            'harga_beli' => $mobil['harga_beli'],
            'harga_jual' => $harga_jual,
            'total_perbaikan' => $mobil['total_perbaikan'],
            'profit' => $profit,
            'tanggal_jual' => $tanggal_jual,
        ]);

        $modelTukar = new M_tukar_tambah();
        $modelTukar->insert([
            'id_sold' => $id_sold,
            'nama_pembeli' => $nama_pembeli,
            'tukar_mobil' => $nama_mobil_tukar,
            'foto' => $fotoTukar,
            'harga_tukar' => $harga_tukar,
            'tambahan_harga' => ($harga_jual - $harga_tukar)
        ]);

        $modelMobil->update($id_mobil, [
            'status' => 'Sold',
            'harga_jual' => $harga_jual
        ]);

        return redirect()->to('/tukar')->with('success', 'Data tukar tambah berhasil disimpan.');
    }

    public function edit($id_tukar)
    {
        $modelTukar = new M_tukar_tambah();
        $dataTukar = $modelTukar
            ->select('tukar_tambah.*, sold_mobil.*, stok_mobil.nama_mobil, stok_mobil.plat_mobil')
            ->join('sold_mobil', 'sold_mobil.id_sold = tukar_tambah.id_sold')
            ->join('stok_mobil', 'stok_mobil.id_mobil = sold_mobil.id_mobil')
            ->where('tukar_tambah.id', $id_tukar)
            ->asObject()
            ->first();

        $modelMobil = new M_mobil();
        $dataMobil = $modelMobil->where('status', 'Tersedia')->asObject()->findAll();

        if (!$dataTukar) {
            return redirect()->to('/tukar')->with('error', 'Data tidak ditemukan');
        }

        return view('header', ['title' => 'Edit Tukar Tambah'])
            . view('menu')
            . view('tukar/edit', [
                'data' => $dataTukar,
                'mobil' => $dataMobil
            ])
            . view('footer');
    }

    public function update($id_tukar)
    {
        $request = $this->request;

        $modelTukar = new M_tukar_tambah();
        $modelSold = new M_sold();

        $tukar = $modelTukar->asObject()->find($id_tukar);
        $sold = $modelSold->asObject()->find($tukar->id_sold);

        if (!$tukar || !$sold) {
            return redirect()->to('/tukar')->with('error', 'Data tidak ditemukan');
        }

        $fotoTukar = $tukar->foto;
        $fileTukar = $request->getFile('foto_mobil_tukar');
        if ($fileTukar && $fileTukar->isValid()) {
            $fotoTukar = $fileTukar->getRandomName();
            $fileTukar->move('uploads/mobil_tukar', $fotoTukar);
        }

        $existingDokumen = json_decode($sold->dokumen_pembeli ?? '[]', true);
        $dokumenBaru = json_decode($request->getPost('dokumen_pembeli_data'), true);
        $dokumenFinal = $existingDokumen;

        if ($dokumenBaru) {
            foreach ($dokumenBaru as $imgData) {
                $newName = uniqid().'-'.$imgData['name'];
                $imgContent = explode(',', $imgData['dataUrl'])[1];
                file_put_contents('uploads/dokumen_pembeli/'.$newName, base64_decode($imgContent));
                $dokumenFinal[] = $newName;
            }
        }

        $harga_jual = str_replace(['Rp', '.', ' '], '', $request->getPost('harga_jual'));
        $harga_tukar = str_replace(['Rp', '.', ' '], '', $request->getPost('harga_tukar'));
        $profit = $harga_jual - ($sold->harga_beli + $sold->total_perbaikan);

        $modelSold->update($sold->id_sold, [
            'pembeli' => $request->getPost('pembeli'),
            'dokumen_pembeli' => json_encode($dokumenFinal),
            'harga_jual' => $harga_jual,
            'metode_pembayaran' => $request->getPost('metode_pembayaran'),
            'profit' => $profit,
            'tanggal_jual' => $request->getPost('tanggal_jual'),
        ]);

        $modelTukar->update($id_tukar, [
            'tukar_mobil' => $request->getPost('nama_mobil_tukar'),
            'foto' => $fotoTukar,
            'harga_tukar' => $harga_tukar,
            'tambahan_harga' => ($harga_jual - $harga_tukar)
        ]);

        return redirect()->to('/tukar')->with('success', 'Data berhasil diperbarui.');
    }

     public function hapus_tukar($id_tukar)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $modelTukar = new M_tukar_tambah();
        $modelSold = new M_sold();
        $modelMobil = new M_mobil();

        $tukar = $modelTukar->asObject()->find($id_tukar);
        if (!$tukar) {
            return redirect()->to('/tukar')->with('error', 'Data tukar tidak ditemukan');
        }

        $sold = $modelSold->asObject()->find($tukar->id_sold);
        if (!$sold) {
            return redirect()->to('/tukar')->with('error', 'Data mobil sold tidak ditemukan');
        }

        if ($tukar->foto && file_exists('uploads/mobil_tukar/' . $tukar->foto)) {
            unlink('uploads/mobil_tukar/' . $tukar->foto);
        }

        if ($sold->dokumen_pembeli) {
            foreach (json_decode($sold->dokumen_pembeli) as $file) {
                if (file_exists('uploads/dokumen_pembeli/' . $file)) {
                    unlink('uploads/dokumen_pembeli/' . $file);
                }
            }
        }

        $modelTukar->delete($id_tukar);

        $modelSold->delete($sold->id_sold);

        $modelMobil->update($sold->id_mobil, [
            'status' => 'Tersedia',
            'harga_jual' => null
        ]);

        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            return redirect()->to('/tukar')->with('error', 'Gagal menghapus data tukar');
        }

        return redirect()->to('/tukar')->with('success', 'Data tukar berhasil dihapus');
    }

}