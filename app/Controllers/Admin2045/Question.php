<?php

namespace App\Controllers\Admin2045;

use App\Controllers\BaseController;
use App\Models\TanyaModel;
use CodeIgniter\API\ResponseTrait;

class Question extends BaseController
{
    var $model, $validation;
    use ResponseTrait;
    function __construct()
    {
        $this->model = new TanyaModel();
        $this->validation = \Config\Services::validation();
    }
    function index()
    {
        echo view('admin/tanya/index');
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
        // $columnSortOrder = ($request->getVar('order')[0]['dir'] == 'asc') ? 'desc' : 'asc';
        $searchValue = $request->getVar('search')['value'];

        // Total Records without Filtering
        $totalRecords = $this->model->countAll();
        $totalRecordsWithFilter = $this->model
            ->where('id !=', '0')
            ->like('question', $searchValue)
            ->countAllResults();

        // Fetch Records
        $orderBy = ($columnName == '') ? 'id DESC' : $columnName . ' ' . $columnSortOrder;
        $data = $this->model
            ->select('*')
            ->where('id !=', '0')
            ->like('question', $searchValue)
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
        $data['title'] = "Tambah SKPD";
        $data['detail'] = [];
        $data['action'] = "add";
        $data['alert'] = "";
        $data['tombol'] = "+ Tambah SKPD";
        echo view('admin/tanya/form', $data);
    }
    function edit($id)
    {
        $data['title'] = "Edit SKPD";
        $data['detail'] = $this->model->find($id);
        $data['action'] = "update";
        $data['tombol'] = "Update SKPD";

        echo view('admin/tanya/form', $data);
    }
    function submitdata()
    {

        $action = $this->request->getVar('action');
        switch ($action) {
            case "add":
                $requestData = $this->request->getPost();
                $this->model->insert($requestData);
                return $this->respond(['status' => 'success', 'message' => 'Data inserted successfully'], 200);


            case "update":
                $requestData = $this->request->getPost();
                unset($requestData['id']);
                $detail = $this->model->find($this->request->getVar('id'));

                $this->model->update($detail['id'], $requestData);
                return $this->respond([
                    'status' => 'success',
                    'message' => 'Data updated successfully'
                ], 200);
        }
    }
    function delete($id)
    {
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
