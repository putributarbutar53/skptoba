<?php

namespace App\Models;

use CodeIgniter\Model;

class SkpdModel extends Model
{
    protected $table = "skpd";
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
    public function getSkpd()
    {
        return $this->findAll();
    }
}
