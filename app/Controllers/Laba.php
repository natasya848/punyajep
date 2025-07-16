<?php

namespace App\Controllers;
use App\Models\M_laba;

class Laba extends BaseController
{

    public function index()
    {
        $db = \Config\Database::connect();

$query = $db->query("
    SELECT 
        MONTH(tanggal_jual) AS bulan,
        YEAR(tanggal_jual) AS tahun,

        -- Total Penjualan: harga_jual + profit dan/atau profit_credit
        SUM(
            harga_jual + 
            CASE 
                WHEN profit = 0 OR profit IS NULL THEN IFNULL(profit_credit, 0)
                WHEN profit_credit = 0 OR profit_credit IS NULL THEN IFNULL(profit, 0)
                ELSE IFNULL(profit, 0) + IFNULL(profit_credit, 0)
            END
        ) AS total_penjualan,

        -- Total Modal
        SUM(harga_beli + total_perbaikan) AS total_modal,

        -- Total Laba = (Penjualan - Modal) jika positif
        SUM(
            CASE 
                WHEN (
                    (harga_jual + 
                        CASE 
                            WHEN profit = 0 OR profit IS NULL THEN IFNULL(profit_credit, 0)
                            WHEN profit_credit = 0 OR profit_credit IS NULL THEN IFNULL(profit, 0)
                            ELSE IFNULL(profit, 0) + IFNULL(profit_credit, 0)
                        END
                    ) - (harga_beli + total_perbaikan)
                ) >= 0
                THEN (
                    (harga_jual + 
                        CASE 
                            WHEN profit = 0 OR profit IS NULL THEN IFNULL(profit_credit, 0)
                            WHEN profit_credit = 0 OR profit_credit IS NULL THEN IFNULL(profit, 0)
                            ELSE IFNULL(profit, 0) + IFNULL(profit_credit, 0)
                        END
                    ) - (harga_beli + total_perbaikan)
                )
                ELSE 0
            END
        ) AS total_laba,

        -- Total Rugi = (Penjualan - Modal) jika negatif
        SUM(
            CASE 
                WHEN (
                    (harga_jual + 
                        CASE 
                            WHEN profit = 0 OR profit IS NULL THEN IFNULL(profit_credit, 0)
                            WHEN profit_credit = 0 OR profit_credit IS NULL THEN IFNULL(profit, 0)
                            ELSE IFNULL(profit, 0) + IFNULL(profit_credit, 0)
                        END
                    ) - (harga_beli + total_perbaikan)
                ) < 0
                THEN (
                    (harga_jual + 
                        CASE 
                            WHEN profit = 0 OR profit IS NULL THEN IFNULL(profit_credit, 0)
                            WHEN profit_credit = 0 OR profit_credit IS NULL THEN IFNULL(profit, 0)
                            ELSE IFNULL(profit, 0) + IFNULL(profit_credit, 0)
                        END
                    ) - (harga_beli + total_perbaikan)
                )
                ELSE 0
            END
        ) AS total_rugi

    FROM sold_mobil
    GROUP BY YEAR(tanggal_jual), MONTH(tanggal_jual)
    ORDER BY YEAR(tanggal_jual) DESC, MONTH(tanggal_jual) DESC
");


            $keuangan = $db->table('keuangan')
                            ->select("MONTH(tanggal) as bulan, YEAR(tanggal) as tahun,
                                      SUM(CASE WHEN jenis = 'Pemasukan' THEN nominal ELSE 0 END) as pemasukan,
                                      SUM(CASE WHEN jenis = 'Pengeluaran' THEN nominal ELSE 0 END) as pengeluaran")
                            ->groupBy(['bulan', 'tahun'])
                            ->get()
                            ->getResult();
            $rekap = $query->getResult(); 

            foreach ($rekap as &$r) {
        // Default value
        $r->pemasukan = 0;
        $r->pengeluaran = 0;

        foreach ($keuangan as $k) {
            if ($k->bulan == $r->bulan && $k->tahun == $r->tahun) {
                $r->pemasukan = $k->pemasukan;
                $r->pengeluaran = $k->pengeluaran;
                break;
            }
        }
    }

        $tahun_query = $db->query("
            SELECT DISTINCT YEAR(tanggal_jual) AS tahun 
            FROM sold_mobil 
            ORDER BY tahun DESC
        ");
        $tahun_list = array_column($tahun_query->getResultArray(), 'tahun');

        $data = [
            'title' => 'Laporan Laba Bulanan',
            'rekap' => $rekap,
            'tahun_list' => $tahun_list,
        ];

        echo view('header', $data);
        echo view('menu');
        echo view('laba/v_laba', $data);
        echo view('footer');
    }
    public function simpan_keuangan()
    {
        $jenis = $this->request->getPost('jenis');
        $nominal = (float) $this->request->getPost('nominal');
        $keterangan = $this->request->getPost('keterangan');
        
         $tanggal = $this->request->getPost('tanggal'); 
        if (!$tanggal) {
            $tanggal = date('Y-m-d');
        }
        $bulan = date('n', strtotime($tanggal)); 
        $tahun = date('Y', strtotime($tanggal));

        $db = \Config\Database::connect();

        $db->table('keuangan')->insert([
            'jenis' => $jenis,
            'nominal' => $nominal,
            'keterangan' => $keterangan,
            'tanggal' => $tanggal
        ]);

        $cek = $db->table('laba_bulanan')
                  ->where('bulan', $bulan)
                  ->where('tahun', $tahun)
                  ->get()
                  ->getRow();

        if ($cek) {
            if ($jenis === 'Pemasukan') {
                $db->table('laba_bulanan')
                   ->where('id_laba', $cek->id_laba)
                   ->set('total_laba', 'total_laba + ' . $nominal, false)
                   ->update();
            } else {
                $db->table('laba_bulanan')
                   ->where('id_laba', $cek->id_laba)
                   ->set('total_rugi', 'total_rugi + ' . $nominal, false)
                   ->update();
            }
        } else {
            $data = [
                'bulan' => $bulan,
                'tahun' => $tahun,
                'total_laba' => $jenis === 'Pemasukan' ? $nominal : 0,
                'total_rugi' => $jenis === 'Pengeluaran' ? $nominal : 0,
            ];
            $db->table('laba_bulanan')->insert($data);
        }

        return redirect()->to('/laba/detail/' . $bulan . '/' . $tahun)
                ->with('success', 'Data keuangan berhasil disimpan dan dimasukkan ke laba.');

    }
    public function detail($bulan, $tahun)
    {
        $db = \Config\Database::connect();
        $kas = $db->table('keuangan')
                  ->where('MONTH(tanggal)', $bulan)
                  ->where('YEAR(tanggal)', $tahun)
                  ->orderBy('tanggal', 'ASC')
                  ->get()
                  ->getResult();
        $data = [
            'title' => 'Laporan Laba Bulanan',
            'kas' => $kas,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];
        echo view('header', $data);
        echo view('menu');
        echo view('laba/detail', $data);
        echo view('footer');

    }

    // public function tambah_laba()
	// {
	// 	$model = new M_laba();
	// 	$data['title']='Tambah Data Stok laba';

	// 	echo view('header', $data);
    //     echo view('menu');
    //     echo view('data/tambah_laba', $data);
    //     echo view('footer');
	// }

    // public function aksi_tambah_laba()
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
    //         $fileFoto->move('uploads/laba', $namaFoto); 
    //     }

    //     $data = [
    //         'nama_laba'   => $nama,
    //         'kode_laba'   => $kode,
    //         'plat_laba'   => $plat,
    //         'harga_laba'  => $harga_bersih,
    //         'stok'         => $stok,
    //         'keterangan'   => $keterangan,
    //         'tanggal_masuk'    => $masuk,
    //         'tanggal_keluar'   => $keluar ?: null, 
    //         'foto_laba'   => $namaFoto,
    //         'created_at'   => date('Y-m-d H:i:s'),
    //     ];

    //     $model = new M_laba();
    //     $model->insert($data);

    //     return redirect()->to(base_url('laba'))->with('success', 'laba berhasil ditambahkan.');
    // }

    // public function edit_laba($id)
    // {
    //     $model = new M_laba();
    //     $data['title'] = 'Edit Stok laba';
    //     $data['laba'] = $model->asObject()->find($id);

    //     if (!$data['laba']) {
    //         return redirect()->to('/laba')->with('error', 'laba tidak ditemukan.');
    //     }

    //     echo view('header', $data);
    //     echo view('menu');
    //     echo view('data/edit_laba', $data);
    //     echo view('footer');
    // }

    // public function update_laba($id)
    // {
    //     $model = new \App\Models\M_laba();
    //     $laba = $model->find($id);

    //     if (!$laba) {
    //         return redirect()->to('/laba')->with('error', 'laba tidak ditemukan.');
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
    //     $namaFoto = $laba['foto_laba']; 

    //     if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
    //         $namaFoto = $fileFoto->getRandomName();
    //         $fileFoto->move('uploads/laba', $namaFoto);

    //         if ($laba['foto_laba'] && file_exists('uploads/laba/' . $laba['foto_laba'])) {
    //             unlink('uploads/laba/' . $laba['foto_laba']);
    //         }
    //     }

    //     $data = [
    //         'nama_laba'   => $nama,
    //         'kode_laba'   => $kode,
    //         'plat_laba'   => $plat,
    //         'harga_laba'  => $harga,
    //         'stok'         => $stok,
    //         'keterangan'   => $keterangan,
    //         'tanggal_masuk'    => $masuk,
    //         'tanggal_keluar'   => $keluar,
    //         'foto_laba'   => $namaFoto,
    //         'updated_at'   => date('Y-m-d H:i:s'),
    //     ];

    //     $model->update($id, $data);

    //     return redirect()->to(base_url('laba'))->with('success', 'Data laba berhasil diupdate.');
    // }

    // public function dihapus_laba()
    // {
    //     // $this->logActivity("Mengakses Tabel Data Data laba yang Dihapus");

    //     // if (!session()->has('id_user')) { 
    //     //     return redirect()->to('login/halaman_login');
    //     // }

    //     // if (!in_array(session()->get('level'), [1])) {
    //     //     return redirect()->to('home/dashboard'); 
    //     // }

    //     $M_laba = new M_laba();
    //     $data = [
    //         'title' => 'Stok laba yang Dihapus',
    //         'deleted_laba' => $M_laba->getDeletedlaba(),
    //         'showWelcome' => false 
    //     ];

    //     echo view('header', $data);
    //     echo view('menu');
    //     echo view('data/deleted_laba', $data);
    //     echo view('footer');
    // }

    // public function hapus_laba($id)
    // {
    //     $M_laba = new M_laba();
    //     if ($M_laba->deletePermanen($id)) {
    //         // $this->logActivity("Menghapus permanen laba ID: $id");

    //         return redirect()->to(base_url('laba/dihapus_laba'))->with('success', 'Data laba berhasil dihapus secara permanen');
    //     }
    //     return redirect()->to(base_url('laba/dihapus_laba'))->with('error', 'Data laba tidak ditemukan atau gagal dihapus');
    // }

    // public function delete_laba($id)
    // {
    //     $M_laba = new M_laba();
    //     if ($M_laba->softDelete($id)) {
    //         // $this->logActivity("Menghapus laba ID: $id (soft delete)");

    //         return redirect()->to(base_url('laba/dihapus_laba'))->with('success', 'Data laba berhasil dihapus (soft delete)');
    //     }
    //     return redirect()->to(base_url('laba'))->with('error', 'Data laba tidak ditemukan atau gagal dihapus');
    // }

    // public function restore_laba($id)
    // {
    //     $M_laba = new M_laba();

    //     if ($M_laba->restore($id)) {
    //         // $this->logActivity("Mengembalikan laba ID: $id (soft delete)");
    //         return redirect()->to(base_url('laba'))->with('success', 'Data laba berhasil direstore');
    //     }
    //     return redirect()->to(base_url('laba/dihapus_laba'))->with('error', 'Data laba tidak ditemukan');
    // }

    // public function detail_laba($id)
    // {
    //     // $session = session();
    //     // $user_id = $session->get('id_user'); 
    //     // $user_level = $session->get('level'); 

    //     // $logModel = new \App\Models\M_log();
    //     $M_laba = new M_laba();
    //     $laba = $M_laba->getlabaById($id);

    //     // $logModel->saveLog($laba_id, "id_laba={$laba_id} berhasil melihat detail laba ID {$id}", $ip_address);

    //     $data = [
    //         'title' => 'Detail Stok laba',
    //         'laba' => $laba
    //     ];

    //     echo view('header', $data);
    //     echo view('menu');
    //     echo view('data/detail_laba', $data);
    //     echo view('footer');
    // }

}