<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table            = 'lapor';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'id_users', 'id_skpd', 'name', 'address', 'no_hpe', 'title', 'report', 'picture', 'created_at'
    ];
    // Dates
    // protected $useTimestamps = true;
    function getSKPDName($id_skpd)
    {
        return $this->db->table('skpd')->where('id', $id_skpd)->get()->getRowArray()['name'];
    }
    public function getDataId($id_skpd)
    {
        $builder = $this->db->table('lapor')
            ->select('lapor.*, skpd.name AS skpd_name, tindak_lanjut.status AS tindak_status, tb_admin.no_handphone AS no_hp')
            ->join('skpd', 'skpd.id = lapor.id_skpd')
            ->join('tindak_lanjut', 'tindak_lanjut.id_lapor = lapor.id', 'left')
            ->join('tb_admin', 'tb_admin.id_skpd = lapor.id_skpd', 'left');

        if ($id_skpd != 0) {
            $builder->where('lapor.id_skpd', $id_skpd);
        }

        $builder->orderBy('lapor.created_at', 'DESC');

        return $builder->get()->getResultArray();
    }


    public function getLaporanWithSkpd($id_users)
    {
        return $this->select('lapor.*, skpd.name as skpd_name')
            ->join('skpd', 'skpd.id = lapor.id_skpd')
            ->join('tindak_lanjut', 'tindak_lanjut.id_lapor = lapor.id', 'left')
            ->where('tindak_lanjut.status IS NULL')
            ->where('lapor.id_users', $id_users)
            ->orderBy('lapor.created_at', 'DESC')
            ->findAll();
    }

    public function jumlahlaporan($id_users)
    {
        return $this->select('lapor.*, skpd.name as skpd_name')
            ->join('skpd', 'skpd.id = lapor.id_skpd')
            ->join('tindak_lanjut', 'tindak_lanjut.id_lapor = lapor.id', 'left')
            ->where('tindak_lanjut.status IS NULL')
            ->where('lapor.id_users', $id_users)
            ->countAllResults();
    }
}
