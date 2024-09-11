<?php

namespace App\Models;

use CodeIgniter\Model;

class PendidikanModel extends Model
{
    protected $table = "tb_pendidikan";
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
