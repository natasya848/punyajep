<?php

namespace App\Models;

use CodeIgniter\Model;

class M_sold extends Model
{
    protected $table = 'sold_mobil'; 
    protected $primaryKey = 'id_sold'; 
    protected $allowedFields = [
        'id_mobil', 'foto_mobil', 'plat_mobil', 'pembeli', 'dokumen_pembeli', 'harga_beli', 'metode_pembayaran', 'harga_jual', 'total_perbaikan', 'profit', 'profit_credit', 'tanggal_jual', 'created_at', 'updated_at', 'deleted_at', 'status_delete'];

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
        return $this->where('id_sold', $id)->delete();
    }

    public function getDeletedsold()
    {
        return $this->db->table('sold')->where('status_delete', 1)->get()->getResult();
    }

    public function getsoldById($id)
    {
        return $this->asObject()->find($id);
    }

    public function getSoldWithMobil($id)
{
    return $this->select('sold_mobil.*, stok_mobil.nama_mobil')
                ->join('stok_mobil', 'stok_mobil.id_mobil = sold_mobil.id_mobil', 'left')
                ->where('sold_mobil.id_sold', $id)
                ->get()
                ->getRow(); // returns as object
}

}
