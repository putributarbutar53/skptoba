<?php

namespace App\Models;

use CodeIgniter\Model;

class TanyaModel extends Model
{
    protected $table = "tb_question";
    protected $primaryKey = "id";
    protected $allowedFields = ['question', 'option1', 'option2', 'option3', 'option4', 'created_at'];
    protected $validationRules = [
        'question' => 'required',
        'option1' => 'required',
        'option2' => 'required',
        'option3' => 'required',
        'option4' => 'required',
    ];
    protected $validationMessages = [
        'question' => [
            'required' => 'Kolom pertanyaan wajib diisi.'
        ],
        'option1' => [
            'required' => 'Kolom Option 1 wajib diisi.'
        ],
        'option2' => [
            'required' => 'Kolom Option 2 wajib diisi.'
        ],
        'option3' => [
            'required' => 'Kolom Option 3 wajib diisi.'
        ],
        'option4' => [
            'required' => 'Kolom Option 4 wajib diisi.'
        ]
    ];
}
