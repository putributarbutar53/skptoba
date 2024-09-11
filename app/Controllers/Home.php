<?php

namespace App\Controllers;

use App\Models\TanyaModel;
use App\Models\LaporanModel;
use App\Models\AdminModel;
use App\Models\TindakModel;
use App\Models\SurveyModel;
use App\Models\PendidikanModel;
use App\Models\PekerjaanModel;
use App\Models\LayananModel;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;
    var $tanya, $validation, $model, $lapor, $tindak, $survey, $pendidikan, $pekerjaan, $layanan;
    function __construct()
    {
        $this->tanya = new TanyaModel();
        $this->model = new AdminModel();
        $this->lapor = new LaporanModel();
        $this->tindak = new TindakModel();
        $this->survey = new SurveyModel();
        $this->pendidikan = new PendidikanModel();
        $this->pekerjaan = new PekerjaanModel();
        $this->layanan = new LayananModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }
    public function index()
    {

        return view('web/index');
    }
    public function nilai()
    {
        // Tangkap tahun dari request, default ke tahun sekarang jika tidak ada
        $tahun = $this->request->getGet('tahun') ?: date('Y');

        // Menghitung jumlah JK dengan nilai 1, hanya dihitung sekali untuk setiap kombinasi nik dan created_at
        $countJK = $this->survey->countDistinctJK();
        $countPR = $this->survey->countDistinctPR();
        $data['counts'] = $this->survey->countAllByEducation();

        // Menghitung jumlah opsi yang berbeda
        $countOption1 = $this->survey->countOption1();
        $countOption2 = $this->survey->countOption2();
        $countOption3 = $this->survey->countOption3();
        $countOption4 = $this->survey->countOption4();
        $pendidikan = $this->pendidikan->findAll();

        // Menghitung jumlah pendidikan
        $colspan = count($pendidikan);
        $bulan = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];

        // Array untuk menyimpan jumlah responden per bulan per jenis pendidikan
        $jumlahResponden = [];
        $totalRespondenPerBulan = [];
        $indeksKepuasanPerBulan = [];
        $keteranganPerBulan = [];

        // Menghitung jumlah responden per bulan per jenis pendidikan
        foreach ($bulan as $kodeBulan => $namaBulan) {
            $totalRespondenPerBulan[$namaBulan] = 0; // Inisialisasi total responden per bulan
            foreach ($pendidikan as $pend) {
                // Menghitung jumlah responden menggunakan method dari model Survey (countResponden)
                $jumlah = $this->survey->countResponden($kodeBulan, $pend['name'], $tahun);
                $jumlahResponden[$namaBulan][$pend['name']] = $jumlah;
                $totalRespondenPerBulan[$namaBulan] += $jumlah; // Menambahkan jumlah responden ke total per bulan
            }
            // Menghitung indeks kepuasan per bulan
            $indeks = $this->survey->getIndeksKepuasan($kodeBulan, $tahun)['indeks_kepuasan'];
            $indeksKepuasanPerBulan[$namaBulan] = $indeks;

            // Menentukan keterangan berdasarkan nilai indeks
            if ($indeks >= 80) {
                $keterangan = 'Sangat Baik';
            } elseif ($indeks >= 70) {
                $keterangan = 'Baik';
            } elseif ($indeks >= 60) {
                $keterangan = 'Kurang Baik';
            } else {
                $keterangan = $indeks > 0 ? 'Tidak Baik' : '';
            }
            $keteranganPerBulan[$namaBulan] = $keterangan;
        }

        $data['data'] = $this->survey->groupDistinct();

        // Menggabungkan semua data ke dalam array $data
        $data = [
            'countOption1' => $countOption1[0]['option1'],
            'countOption2' => $countOption2[0]['option2'],
            'countOption3' => $countOption3[0]['option3'],
            'countOption4' => $countOption4[0]['option4'],
            'countJK' => $countJK, // Menambahkan jumlah JK dengan nilai 1
            'countPR' => $countPR, // Menambahkan jumlah JK dengan nilai 1
            'data' => $data['data'],
            'counts' => $data['counts'],
            'colspan' => $colspan,
            'bulan' => $bulan,
            'jumlahResponden' => $jumlahResponden,
            'totalRespondenPerBulan' => $totalRespondenPerBulan,
            'indeksKepuasanPerBulan' => $indeksKepuasanPerBulan,
            'keteranganPerBulan' => $keteranganPerBulan,
            'tahun' => $tahun,
        ];
        $data['pendidikan'] = $this->pendidikan->findAll();

        return view('web/nilai', $data);
    }

    public function faq()
    {
        return view('web/faq');
    }
    public function contact()
    {
        return view('web/contact');
    }
    public function survey()
    {
        $data['action'] = "add";
        $data['tanya'] = $this->tanya->findAll();
        $data['pendidikan'] = $this->pendidikan->findAll();
        $data['pekerjaan'] = $this->pekerjaan->findAll();
        $data['layanan'] = $this->layanan->findAll();
        return view('web/survey', $data);
    }
    public function submitskm()
    {
        // Menerima data dari formulir
        $requestData = $this->request->getVar();

        // Menyiapkan data untuk disimpan ke database
        $dataToInsert = [
            'nik' => $requestData['nik'],
            'nama' => $requestData['nama'],
            'jk' => $requestData['jk'],
            'no_hp' => $requestData['no_hp'],
            'pendidikan' => $requestData['pendidikan'],
            'pekerjaan' => $requestData['pekerjaan'],
            'jenis_layanan' => $requestData['jenis_layanan'],
            'tempat_layanan' => $requestData['tempat_layanan'],
            'saran' => $requestData['saran'],
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Mengambil jawaban dari setiap pertanyaan yang di-looping
        foreach ($requestData['answers'] as $questionId => $answerValue) {
            // Menambahkan jawaban ke data yang akan disimpan ke database
            $dataToInsert['id_question'] = $questionId;
            $dataToInsert['option1'] = ($answerValue == 'option1') ? 1 : 0;
            $dataToInsert['option2'] = ($answerValue == 'option2') ? 1 : 0;
            $dataToInsert['option3'] = ($answerValue == 'option3') ? 1 : 0;
            $dataToInsert['option4'] = ($answerValue == 'option4') ? 1 : 0;

            // Menyimpan data ke database
            $this->survey->insert($dataToInsert);
        }

        // Memberikan respons berhasil kepada pengguna
        return $this->respond([
            'status' => 'success',
            'message' => 'Data Berhasil disimpan'
        ], 200);
    }
    public function chart()
    {
        $genderCounts = $this->survey->countByGender();
        $jobCounts = $this->survey->countByJob();
        $educationCounts = $this->survey->countEducation();
        $satisfactionCounts = $this->survey->countSatisfaction();
        $questionCounts = $this->survey->countByQuestionWithOptions(); // Gunakan fungsi baru untuk menghitung jumlah jawaban berdasarkan pertanyaan dengan opsi

        // Perbarui hasil dengan menambahkan kolom 'question' dari setiap pertanyaan
        foreach ($questionCounts as &$question) {
            $question['question'] = $this->survey->getQuestionById($question['id_question']);
        }

        $data = [
            'genderCounts' => $genderCounts,
            'jobCounts' => $jobCounts,
            'educationCounts' => $educationCounts,
            'satisfactionCounts' => $satisfactionCounts,
            'questionCounts' => $questionCounts,
        ];

        return view('web/chart', $data);
    }
}
