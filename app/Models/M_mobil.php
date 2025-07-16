<?php

namespace App\Models;

use CodeIgniter\Model;

class M_mobil extends Model
{
    protected $table = 'stok_mobil'; 
    protected $primaryKey = 'id_mobil'; 
    protected $allowedFields = [
        'foto_mobil', 'harga_beli', 'nama_mobil', 'harga_jual', 'status',
        'plat_mobil', 'keterangan', 'tanggal_masuk','stok', 'total_perbaikan',
        'status_delete', 'created_at', 'updated_at', 'deleted_at' ];

    public function softDelete($id)
    {
        return $this->update($id, ['status_delete' => 1]);
    }

    public function restore($id)
    {
        return $this->update($id, ['status_delete' => 0]);
    }

    public function deletePermanen($id)
    {
        return $this->where('id_mobil', $id)->delete();
    }

    public function getDeletedMobil()
    {
        return $this->db->table('stok_mobil')->where('status_delete', 1)->get()->getResult();
    }

    public function getMobilById($id)
    {
        return $this->asObject()->find($id);
    }

    public function getStokMobil()
    {
        return $this->db->table('mobil')
            ->select('mobil.*, penjualan.total_perbaikan, penjualan.harga_jual')
            ->join('penjualan', 'penjualan.id_mobil = mobil.id_mobil', 'left')
            ->where('mobil.status_delete', 0)
            ->get()->getResult();
    }


}
