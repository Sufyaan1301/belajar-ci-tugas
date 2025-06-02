<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primarykey = 'id';
    protected $allowedFields = [
        'nama',
        'harga',
        'jumlah',
        'foto',
        'created_at',
        'updated_at'
    ];
}
