<?php

namespace App\Models;

use CodeIgniter\Model;

class TindakModel extends Model
{
    protected $table = "tindak_lanjut";
    protected $primaryKey = "id";
    protected $allowedFields = ['id_lapor', 'solution', 'status', 'picture', 'created_at'];
    protected $validationRules = [
        'solution' => 'required',
    ];
    protected $validationMessages = [
        'solution' => [
            'required' => 'Kolom Tanggapan wajib diisi.'
        ]
    ];

    // public function getDatalapor()
    // {
    //     return $this->db->table('tindak_lanjut')
    //         ->select('tindak_lanjut.solution, tindak_lanjut.status, lapor.name, lapor.title, lapor.report')
    //         ->join('lapor', 'lapor.id = tindak_lanjut.id_lapor')
    //         ->get()
    //         ->getResultArray();
    // }

    // public function getDatalapor()
    // {
    //     return $this->db->table('tindak_lanjut')
    //         ->select('tindak_lanjut.solution, tindak_lanjut.status, lapor.name, lapor.title, lapor.report AS lapor_report, tindak_lanjut.picture AS tindak_picture, tindak_lanjut.id AS tindak_id, lapor.id AS lapor_id, tindak_lanjut.created_at AS tgl_tindak')
    //         ->join('lapor', 'lapor.id = tindak_lanjut.id_lapor')
    //         ->get()
    //         ->getResultArray();
    // }

    // public function getDatalapor($id_skpd)
    // {
    //     $builder = $this->db->table('tindak_lanjut')
    //         ->select('tindak_lanjut.solution, tindak_lanjut.status, lapor.name, lapor.title, lapor.report AS lapor_report, tindak_lanjut.picture AS tindak_picture, tindak_lanjut.id AS tindak_id, lapor.id AS lapor_id, tindak_lanjut.created_at AS tgl_tindak')
    //         ->join('lapor', 'lapor.id = tindak_lanjut.id_lapor');

    //     if ($id_skpd != 0) {
    //         $builder->join('skpd', 'skpd.id = lapor.id_skpd');
    //         $builder->where('skpd.id', $id_skpd);
    //     }

    //     $builder->orderBy('tindak_lanjut.created_at', 'DESC');

    //     return $builder->get()->getResultArray();
    // }

    public function getDatalapor($id_skpd)
    {
        $builder = $this->db->table('tindak_lanjut')
            ->select('tindak_lanjut.solution, tindak_lanjut.status, lapor.name, lapor.title, lapor.report AS lapor_report, tindak_lanjut.picture AS tindak_picture, tindak_lanjut.id AS tindak_id, lapor.id AS lapor_id, tindak_lanjut.created_at AS tgl_tindak, skpd.name AS skpd_name')
            ->join('lapor', 'lapor.id = tindak_lanjut.id_lapor')
            ->join('skpd', 'skpd.id = lapor.id_skpd');

        if ($id_skpd != 0) {
            $builder->where('lapor.id_skpd', $id_skpd);
        }

        $builder->orderBy('tindak_lanjut.created_at', 'DESC');

        return $builder->get()->getResultArray();
    }

    public function getTindakLanjut($id_users)
    {
        $builder = $this->db->table('tindak_lanjut')
            ->select('tindak_lanjut.solution, tindak_lanjut.status, lapor.name AS lapor_name, lapor.title, lapor.report AS lapor_report, tindak_lanjut.picture AS tindak_picture, tindak_lanjut.id AS tindak_id, lapor.id AS lapor_id, tindak_lanjut.created_at AS tgl_tindak, skpd.name AS skpd_name')
            ->join('lapor', 'lapor.id = tindak_lanjut.id_lapor')
            ->join('skpd', 'skpd.id = lapor.id_skpd')
            ->where('lapor.id_users', $id_users);

        $builder->orderBy('tindak_lanjut.created_at', 'DESC');

        return $builder->get()->getResultArray();
    }

    public function jumlahtindak($id_users)
    {
        return $this->join('lapor', 'tindak_lanjut.id_lapor = lapor.id')
            ->where('lapor.id_users', $id_users)
            ->countAllResults();
    }

    public function findTindak($tindak_id)
    {
        $builder = $this->db->table('tindak_lanjut')
            ->select('tindak_lanjut.solution, tindak_lanjut.status, lapor.name AS lapor_name, lapor.title, lapor.report AS lapor_report, tindak_lanjut.id AS tindak_id, tindak_lanjut.picture AS gambar, lapor.id AS lapor_id, tindak_lanjut.created_at AS tgl_tindak, skpd.name AS skpd_name')
            ->join('lapor', 'lapor.id = tindak_lanjut.id_lapor')
            ->join('skpd', 'skpd.id = lapor.id_skpd')
            ->where('tindak_lanjut.id', $tindak_id);

        $query = $builder->get();

        return $query->getRowArray();
    }
}
