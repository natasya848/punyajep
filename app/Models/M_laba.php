<?php

namespace App\Models;

use CodeIgniter\Model;

class M_laba extends Model
{
    protected $table = 'laba_bulanan'; 
    protected $primaryKey = 'id_laba'; 
    protected $allowedFields = [
        'bulan', 'tahun', 'total_laba', 'total_rugi', 'created_at', 'updated_at'];

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
        return $this->where('id_laba', $id)->delete();
    }

    public function getDeletedlaba()
    {
        return $this->db->table('laba')->where('status_delete', 1)->get()->getResult();
    }

    public function getlabaById($id)
    {
        return $this->asObject()->find($id);
    }
}
