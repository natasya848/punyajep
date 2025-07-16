<?php

namespace App\Models;

use CodeIgniter\Model;

class M_tukar_tambah extends Model
{
    protected $table = 'tukar_tambah';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_sold', 'nama_pembeli', 'tukar_mobil', 
        'foto', 'harga_tukar', 'tambahan_harga', 
        'metode_pembayaran', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
}
