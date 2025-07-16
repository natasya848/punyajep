<?php

namespace App\Models;

use CodeIgniter\Model;

class M_user extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; 
    protected $useSoftDeletes   = true; 

    protected $allowedFields    = [
        'foto',
        'username',
        'nama_user',
        'password',
        'level',
        'email',
        'created_at',
        'updated_at',
        'deleted_at',
        'status_delete'
    ];

    protected $useTimestamps = true; 
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
