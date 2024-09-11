<?php

namespace App\Controllers\Admin2045;

use App\Controllers\BaseController;
use App\Models\TindakModel;
use CodeIgniter\API\ResponseTrait;

class Tindak extends BaseController
{
    var $model, $validation;
    use ResponseTrait;
    function __construct()
    {
        $this->model = new TindakModel();
        $this->validation = \Config\Services::validation();
    }
    // function index()
    // {
    //     $data['row'] = $this->model->getDatalapor();
    //     echo view('admin/tindaklanjut/index', $data);
    // }
    public function index()
    {
        $id_skpd = session()->get('admin_skpd');
        $data['row'] = $this->model->getDatalapor($id_skpd);
        echo view('admin/tindaklanjut/index', $data);
    }
    function loaddata()
    {
        // Mendapatkan peran pengguna dari session
        $adminRole = session()->get('admin_role');
        // Mendapatkan id SKPD dari session
        $id_skpd = session()->get('id_skpd');

        // Memeriksa apakah pengguna memiliki peran admin atau superadmin
        $isAdmin = $adminRole === 'admin' || $adminRole === 'superadmin';

        // Menentukan query berdasarkan peran pengguna
        if ($isAdmin) {
            $query = $this->model;
        } else {
            $query = $this->model->where('id_skpd', $id_skpd);
        }

        // Melakukan proses pengaturan data sesuai dengan permintaan dari client
        $request = service('request');

        $draw = $request->getVar('draw');
        $row = $request->getVar('start');
        $rowperpage = $request->getVar('length');

        $columnIndex = $request->getVar('order')[0]['column'];
        $columnName = $request->getVar('columns')[$columnIndex]['data'];

        $columnSortOrder = $request->getVar('order')[0]['dir'];

        $searchValue = $request->getVar('search')['value'];

        // Total Records without Filtering
        $totalRecords = $this->model->countAll();
        $totalRecordsWithFilter = $this->model
            ->table('tindak_lanjut')
            ->join('lapor', 'lapor.id = tindak_lanjut.id_lapor', 'left')
            ->join('skpd', 'skpd.id = lapor.id_skpd', 'left')
            ->where('tindak_lanjut.id !=', '0')
            ->like('lapor.title', $searchValue)
            ->countAllResults();

        // Fetch Records
        $orderBy = ($columnName == '') ? 'tindak_lanjut.id DESC' : $columnName . ' ' . $columnSortOrder;
        $data = $this->model
            ->table('tindak_lanjut')
            ->select('tindak_lanjut.*, lapor.name AS lapor_name, lapor.title AS lapor_title, skpd.name AS skpd_name')
            ->join('lapor', 'lapor.id = tindak_lanjut.id_lapor', 'left')
            ->join('skpd', 'skpd.id = lapor.id_skpd', 'left')
            ->where('tindak_lanjut.id !=', '0')
            ->like('lapor.title', $searchValue)
            ->orderBy($orderBy)
            ->limit($rowperpage, $row)
            ->get()
            ->getResult();

        $response = [
            'draw' => intval($draw),
            'iTotalRecords' => $totalRecordsWithFilter,
            'iTotalDisplayRecords' => $totalRecords,
            'aaData' => $data
        ];

        return $this->response->setJSON($response);
    }

    function submitdata()
    {
        $action = $this->request->getVar('action');
        $rules = [
            'solution' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggapan harus diisi'
                ]
            ],
            'picture' => [
                'rules' => 'max_size[picture,2048]|ext_in[picture,png,jpg,jpeg,gif]',
                'errors' => [
                    'max_size' => "Ukuran File Terlalu Besar",
                    'ext_in' => 'Tipe file tidak diizinkan',
                ]
            ]
        ];
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            return $this->respond(['errors' => $errors], 400);
        }
        switch ($action) {
            case "add":
                $requestData = $this->request->getVar();
                $image = $this->request->getFile('picture');
                if ($image->isValid()) {
                    $newName = $image->getRandomName();
                    $image->move(ROOTPATH . 'public/' . getenv('dir.upload.tindak'), $newName);
                    $requestData['picture'] = $newName;
                }
                $status = $this->request->getVar('status') == 'on' ? 0 : 1;
                $requestData['status'] = $status;
                $this->model->insert($requestData);
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data Berhasil disimpan'
                ], 200);
            case "update":
                $requestData = $this->request->getPost();
                unset($requestData['id']);
                $detail = $this->model->find($this->request->getVar('id'));
                $image = $this->request->getFile('image');
                if ($image->isValid()) {
                    $newName = $image->getRandomName();
                    $image->move(ROOTPATH . 'public/' . getenv('dir.upload.tindak'), $newName);
                    if (!empty($detail['image'])) {
                        $imagePath = ROOTPATH . 'public/' . getenv('dir.upload.tindak') . $detail['image'];
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                    $requestData['image'] = $newName;
                }
                $cek = $this->model->where('slug', $this->request->getPost('slug'))->first();
                if (!empty($cek['slug']) and $cek['id'] != $detail['id']) {
                    $requestData['slug'] = $cek['slug'] . "-" . rand();
                }

                $this->model->update($detail['id'], $requestData);
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data updated successfully'
                ], 200);
        }
    }
    function deletetindak($id)
    {
        $nameimg = $this->model->find($id);
        if ($nameimg['picture']) {
            $imagePath = ROOTPATH . 'public/' . getenv('dir.upload.tindak') . $nameimg['picture'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $deleted = $this->model->delete($id);
        if ($deleted) {
            return $this->respond([
                'status' => 'success',
                'message' => 'Data deleted successfully'
            ], 200);
        } else {
            return $this->respond([
                'message' => 'Ops! Id tidak valid'
            ], 400);
        }
    }
    function lihattanggapan($id_lapor)
    {
        $data['title'] = "Lihat Tindak Lanjut";
        $data['detail'] = $this->model->where('id_lapor', $id_lapor)
            ->orderBy('created_at', 'DESC')
            ->first();
        $data['action'] = "add";
        $data['tombol'] = "Tanggapi Pengaduan";

        echo view('admin/tindaklanjut/detail', $data);
    }
    function lihattindak($id_lapor)
    {
        $data['title'] = "Lihat Tindak Lanjut";
        $data['detail'] = $this->model->where('id_lapor', $id_lapor)
            ->orderBy('created_at', 'DESC')
            ->first();
        $data['action'] = "add";
        $data['tombol'] = "Tanggapi Pengaduan";

        echo view('admin/tindaklanjut/detaillanjut', $data);
    }
}
