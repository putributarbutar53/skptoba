<?php

namespace App\Controllers\Admin2045;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SkpdModel;
use CodeIgniter\Config\Config;
use CodeIgniter\Database\Query;
use CodeIgniter\API\ResponseTrait;

class Admin extends BaseController
{
    use ResponseTrait;
    var $model, $skpd, $validation;
    function __construct()
    {
        $this->model = new AdminModel();
        $this->skpd = new SkpdModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }

    function index()
    {
        echo view('admin/auth/admin_list');
    }

    function loaddata()
    {
        $request = service('request');

        $draw = $request->getVar('draw');
        $row = $request->getVar('start');
        $rowperpage = $request->getVar('length');

        $columnIndex = $request->getVar('order')[0]['column'];
        $columnName = $request->getVar('columns')[$columnIndex]['data'];

        $columnSortOrder = $request->getVar('order')[0]['dir'];
        $searchValue = $request->getVar('search')['value'];

        $db = db_connect();

        // Total record tanpa filter
        $totalRecords = $db->table('tb_admin')->countAll();

        // Total record dengan filter pencarian
        $totalRecordsWithFilter = $db->table('tb_admin')
            ->join('skpd', 'skpd.id = tb_admin.id_skpd')
            ->where('tb_admin.id !=', '0')
            ->like('tb_admin.name', $searchValue)
            ->orLike('tb_admin.username', $searchValue)
            ->orLike('skpd.name', $searchValue)
            ->countAllResults();

        $orderBy = ($columnName == '') ? 'tb_admin.id DESC' : $columnName . ' ' . $columnSortOrder;
        $data = $db->table('tb_admin')
            ->select('tb_admin.*, skpd.name as skpd_name')
            ->join('skpd', 'skpd.id = tb_admin.id_skpd', 'left')
            ->where('tb_admin.id !=', '0')
            ->like('tb_admin.name', $searchValue)
            ->orLike('tb_admin.username', $searchValue)
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

    function add()
    {
        $data['title'] = "Tambah Admin";
        $data['detail'] = [];
        $data['skpd'] = $this->skpd->getSkpd();
        $data['action'] = "add";
        $data['alert'] = "";
        $data['tombol'] = "+ Tambah Admin";
        echo view('admin/auth/admin_add', $data);
    }
    function edit($id)
    {
        $data['title'] = "Edit Data Admin";
        $data['detail'] = $this->model->detailData($id);
        $data['action'] = "update";
        $data['alert'] = "Kosongkan password jika tidak ingin di ubah";
        $data['tombol'] = "Update Data";

        echo view('admin/auth/admin_add', $data);
    }
    function submitdata()
    {
        $action = $this->request->getVar('action');
        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi',
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
                $rulesadd = [
                    'password' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Password harus diisi'
                        ]
                    ],
                    'username' => [
                        'rules' => 'required|is_unique[tb_admin.username]',
                        'errors' => [
                            'is_unique' => 'Username sudah digunakan',
                        ]
                    ],
                ];
                if (!$this->validate($rulesadd)) {
                    $errorsadd = $this->validator->getErrors();
                    return $this->respond(['errors' => $errorsadd], 400);
                }
                $requestData = array(
                    'id_skpd' => $this->request->getVar('id_skpd'),
                    'name' => $this->request->getVar('name'),
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'role' => $this->request->getVar('role'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
                );
                $no_hp = $this->request->getVar('no_handphone');
                if (substr($no_hp, 0, 2) !== '62') {
                    $requestData['no_handphone'] = '62' . ltrim($no_hp, '0');
                }
                $image = $this->request->getFile('picture');
                if ($image->isValid()) {
                    $newName = $image->getRandomName();
                    $image->move(ROOTPATH . 'public/' . getenv('dir.upload.profile'), $newName);
                    $requestData['picture'] = $newName;
                }

                $this->model->insert($requestData);

                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data inserted successfully'
                ], 200);
            case "update":

                $requestData = array(
                    'id_skpd' => $this->request->getVar('id_skpd'),
                    'name' => $this->request->getVar('name'),
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'role' => $this->request->getVar('role'),
                    'no_handphone' => $this->request->getVar('no_handphone'),
                );
                $no_hp = $requestData['no_handphone'];
                if (substr($no_hp, 0, 2) !== '62') {
                    $requestData['no_handphone'] = '62' . ltrim($no_hp, '0');
                }
                if ($this->request->getVar('password') != "") {
                    $requestData['password'] = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
                }
                $detail = $this->model->detailData($this->request->getVar('id'));
                $image = $this->request->getFile('picture');
                if ($image->isValid()) {
                    $newName = $image->getRandomName();
                    $image->move(ROOTPATH . 'public/' . getenv('dir.upload.profile'), $newName);
                    $requestData['picture'] = $newName;
                    if ($detail['picture']) {
                        $imagePath = ROOTPATH . 'public/' . getenv('dir.upload.profile') . $detail['picture'];
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                }
                $this->model->update($detail['id'], $requestData);
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data updated successfully'
                ], 200);
        }
    }
    function deletedata($id)
    {
        $nameimg = $this->model->find($id);
        if ($nameimg['picture']) {
            $imagePath = ROOTPATH . 'public/' . getenv('dir.upload.profile') . $nameimg['picture'];
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
}
