<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pelanggan extends Model
{
    protected $table = 'pelanggan'; 
    protected $primaryKey = 'id_pelanggan'; 
    protected $allowedFields = [
        'id_pelanggan', 'nama_pelanggan', 'no_hp', 'alamat', 'created_at', 'updated_at', 'deleted_at', 'status_delete'];

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
        return $this->where('id_pelanggan', $id)->delete();
    }

    public function getDeletedpelanggan()
    {
        return $this->db->table('pelanggan')->where('status_delete', 1)->get()->getResult();
    }

    public function getPelangganById($id)
    {
        return $this->asObject()->find($id);
    }
}
