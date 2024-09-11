<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table = "tb_layanan";
    protected $primaryKey = "id";
    protected $allowedFields = ['name'];
    protected $validationRules = [
        'name' => 'required',
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'Kolom name wajib diisi.'
        ]
    ];
    public function getAll()
    {
        return $this->findAll();
    }
}
