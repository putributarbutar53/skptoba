<?php

namespace App\Controllers\Admin2045;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\Config\Config;
use CodeIgniter\Database\Query;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;
use App\Models\SurveyModel;
use App\Models\TindakModel;
use App\Models\TanyaModel;

class Laporan extends BaseController
{
    use ResponseTrait;
    var $model, $tindak, $admin, $tanya;
    function __construct()
    {
        $this->model = new SurveyModel();
        $this->tindak = new TindakModel();
        $this->admin = new AdminModel();
        $this->tanya = new TanyaModel();
    }
    public function index()
    {
        $data['data'] = $this->model->groupDistinct();
        return view('admin/laporan/v_laporan', $data);
    }

    function loaddata()
    {

        // Melakukan proses pengaturan data sesuai dengan permintaan dari client
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
        $totalRecords = $db->table('lapor')->countAll();
        $totalRecordsWithFilter = $db->table('lapor')
            ->where('lapor.id !=', '0')
            ->like('lapor.name', $searchValue)
            ->orLike('lapor.address', $searchValue)
            ->orLike('skpd.name', $searchValue);

        $totalRecordsWithFilter = $totalRecordsWithFilter->countAllResults();

        $orderBy = ($columnName == '') ? 'lapor.id DESC' : $columnName . ' ' . $columnSortOrder;

        $query = $db->table('lapor')
            ->select('lapor.*, skpd.name as skpd_name')
            ->join('skpd', 'skpd.id = lapor.id_skpd')
            ->where('lapor.id !=', '0')
            ->like('lapor.name', $searchValue)
            ->orLike('lapor.address', $searchValue)
            ->orLike('skpd.name', $searchValue)
            ->orderBy($orderBy)
            ->limit($rowperpage, $row);


        $data = $query->get()->getResult();

        $response = [
            'draw' => intval($draw),
            'iTotalRecords' => $totalRecords,
            'iTotalDisplayRecords' => $totalRecordsWithFilter,
            'aaData' => $data
        ];

        return $this->response->setJSON($response);
    }

    function getdata()
    {

        $admin_id = session()->get('admin_id');
        $isAdmin = session()->get('admin_role') === 'admin' || session()->get('admin_role') === 'superadmin';

        if ($isAdmin) {
            $data['pemilih'] = $this->model->findAll();
        } else {
            $data['pemilih'] = $this->model->getDataId($admin_id);
        }
        return view('admin/laporan/v_laporan');
    }
    function add()
    {
        $data['title'] = "Pencapaian Kinerja";
        $data['detail'] = [];
        $data['action'] = "add";
        $data['alert'] = "";
        $data['tombol'] = "+ Tambah Data";
        echo view('admin/laporan/form', $data);
    }
    function tanggapi($id)
    {
        $data['title'] = "Tindak Lanjut";
        $data['detail'] = $this->model->find($id);
        $data['action'] = "add";
        $data['tombol'] = "Tanggapi Pengaduan";

        echo view('admin/tindaklanjut/form', $data);
    }

    public function detail($nik, $createdAt)
    {
        // Mengambil detail data berdasarkan nik dan created_at
        $detail = $this->model->where('nik', $nik)
            ->where('created_at', $createdAt)
            ->first();

        if ($detail) {
            // Mengambil data survey berdasarkan nik dan created_at
            $surveyData = $this->model->getSurveyData($nik, $createdAt);

            // Persiapkan data jawaban
            $jawaban = [];
            foreach ($surveyData as $row) {
                $jawaban[] = [
                    'id_question' => $row['id_question'],
                    'option1' => $row['option1'],
                    'option2' => $row['option2'],
                    'option3' => $row['option3'],
                    'option4' => $row['option4']
                ];
            }

            $data['title'] = "Detail Isian Survey Kepuasan Masyarakat An. ";
            $data['detail'] = $detail;
            $data['jawaban'] = $jawaban;
            $data['pertanyaan'] = $this->tanya->findAll();
            $data['surveyData'] = $surveyData;
            $data['action'] = "update";

            // Tampilkan view dengan data yang telah disiapkan
            return view('admin/laporan/detail', $data);
        } else {
            // Jika data tidak ditemukan, berikan respons data tidak ditemukan
            return $this->respond(['message' => 'Data tidak ditemukan'], 404);
        }
    }
    public function delete($nik, $createdAt)
    {
        $deleted = $this->model->where('nik', $nik)->where('created_at', $createdAt)->delete();
        if ($deleted) {
            return $this->respond([
                'status' => 'success',
                'message' => 'Data deleted successfully'
            ], 200);
        } else {
            return $this->respond([
                'message' => 'Ops! Data tidak valid'
            ], 400);
        }
    }
    public function chart()
    {
        $genderCounts = $this->model->countByGender();
        $jobCounts = $this->model->countByJob();
        $educationCounts = $this->model->countEducation();
        $satisfactionCounts = $this->model->countSatisfaction();
        $questionCounts = $this->model->countByQuestionWithOptions(); // Gunakan fungsi baru untuk menghitung jumlah jawaban berdasarkan pertanyaan dengan opsi

        // Perbarui hasil dengan menambahkan kolom 'question' dari setiap pertanyaan
        foreach ($questionCounts as &$question) {
            $question['question'] = $this->model->getQuestionById($question['id_question']);
        }

        $data = [
            'genderCounts' => $genderCounts,
            'jobCounts' => $jobCounts,
            'educationCounts' => $educationCounts,
            'satisfactionCounts' => $satisfactionCounts,
            'questionCounts' => $questionCounts,
        ];

        return view('admin/laporan/chart', $data);
    }
    public function qst()
    {
        $genderCounts = $this->model->countByGender();
        $jobCounts = $this->model->countByJob();
        $educationCounts = $this->model->countEducation();
        $satisfactionCounts = $this->model->countSatisfaction();
        $questionCounts = $this->model->countByQuestionWithOptions(); // Gunakan fungsi baru untuk menghitung jumlah jawaban berdasarkan pertanyaan dengan opsi

        // Perbarui hasil dengan menambahkan kolom 'question' dari setiap pertanyaan
        foreach ($questionCounts as &$question) {
            $question['question'] = $this->model->getQuestionById($question['id_question']);
        }

        $data = [
            'genderCounts' => $genderCounts,
            'jobCounts' => $jobCounts,
            'educationCounts' => $educationCounts,
            'satisfactionCounts' => $satisfactionCounts,
            'questionCounts' => $questionCounts,
        ];

        return view('admin/laporan/qst', $data);
    }
}
