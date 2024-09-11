<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\Config\Config;
use CodeIgniter\Database\Query;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;
use App\Models\LaporanModel;
use App\Models\TindakModel;

class Report extends BaseController
{
    use ResponseTrait;
    var $model, $tindak, $admin;
    function __construct()
    {
        $this->model = new LaporanModel();
        $this->tindak = new TindakModel();
        $this->admin = new AdminModel();
    }
    public function index()
    {
        $id_users = user()->id;
        $data['row'] = $this->model->getLaporanWithSkpd($id_users);
        $data['tindak'] = $this->tindak->getTindakLanjut($id_users);
        $data['jumlah_tindak'] = $this->tindak->jumlahtindak($id_users);
        $data['jumlah_laporan'] = $this->model->jumlahlaporan($id_users);
        return view('web/lapor/index', $data);
    }

    public function v_lapor()
    {
        $id_users = user()->id;
        $data['row'] = $this->model->getLaporanWithSkpd($id_users);
        $data['tindak'] = $this->tindak->getTindakLanjut($id_users);
        $data['jumlah_tindak'] = $this->tindak->jumlahtindak($id_users);
        $data['jumlah_laporan'] = $this->model->jumlahlaporan($id_users);
        return view('web/lapor/v_lapor', $data);
    }

    function detail($id)
    {
        $detail = $this->model->find($id);
        $skpd = $this->model->getSKPDName($detail['id_skpd']);
        $data['title'] = "Detail Laporan Pengaduan An. ";
        $data['detail'] = $detail;
        $data['skpd'] = $skpd;
        $data['action'] = "update";

        echo view('web/lapor/detail', $data);
    }
    function detailtindak($tindak_id)
    {
        $detail = $this->tindak->findTindak($tindak_id);
        $data['title'] = "Detail Laporan Pengaduan An. ";
        $data['detail'] = $detail;
        $data['action'] = "update";

        echo view('web/lapor/detail_tindak', $data);
    }
}
