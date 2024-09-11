<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveyModel extends Model
{
    protected $table = "tb_survey";
    protected $primaryKey = "id";
    protected $allowedFields = ['nik', 'nama', 'jk', 'umur', 'no_hp', 'pendidikan', 'pekerjaan', 'jenis_layanan', 'tempat_layanan', 'saran', 'id_question', 'option1', 'option2', 'option3', 'option4', 'created_at'];
    protected $validationRules = [];
    protected $validationMessages = [];
    public function groupDistinct()
    {
        // Membuat array kosong untuk menyimpan data unik
        $uniqueData = [];

        // Mengambil semua data dari tabel
        $allData = $this->findAll();

        // Iterasi melalui data
        foreach ($allData as $row) {
            // Kunci gabungan untuk setiap baris
            $key = $row['nik'] . $row['created_at'];

            // Jika kunci belum ada dalam array unik, tambahkan baris ke array
            if (!array_key_exists($key, $uniqueData)) {
                $uniqueData[$key] = $row;
            }
        }

        // Mengembalikan array data unik
        return $uniqueData;
    }
    // Model SurveyModel
    public function getSurveyData($nik, $createdAt)
    {
        return $this->where('nik', $nik)
            ->where('created_at', $createdAt)
            ->findAll();
    }

    public function countOption1()
    {
        return $this->selectSum('option1')->findAll();
    }
    public function countOption2()
    {
        return $this->selectSum('option2')->findAll();
    }
    public function countOption3()
    {
        return $this->selectSum('option3')->findAll();
    }
    public function countOption4()
    {
        return $this->selectSum('option4')->findAll();
    }
    public function countDistinctJK()
    {
        $sql = "SELECT COUNT(*) as count_JK 
            FROM (SELECT DISTINCT nik, created_at 
                  FROM tb_survey 
                  WHERE JK = 1) AS subquery";

        $query = $this->db->query($sql);
        $row = $query->getRow();

        return $row->count_JK;
    }
    public function countDistinctPR()
    {
        $sql = "SELECT COUNT(*) as count_PR 
            FROM (SELECT DISTINCT nik, created_at 
                  FROM tb_survey 
                  WHERE JK = 2) AS subquery";

        $query = $this->db->query($sql);
        $row = $query->getRow();

        return $row->count_PR;
    }
    public function countByEducation($education)
    {
        return $this->select('COUNT(*) as count')
            ->where('pendidikan', $education)
            ->groupBy('nik, created_at')
            ->countAllResults();
    }

    public function countAllByEducation()
    {
        $educations = ['SD', 'SMP', 'SMA', 'Diploma III', 'Diploma IV / Sarjana', 'Magister', 'Doktor'];
        $result = [];

        foreach ($educations as $education) {
            $result[$education] = $this->countByEducation($education);
        }

        return $result;
    }
    public function countByGender()
    {
        $query = $this->db->query("
            SELECT JK, COUNT(*) as count 
            FROM (
                SELECT DISTINCT nik, created_at, JK 
                FROM tb_survey
            ) as distinct_survey
            GROUP BY JK
        ");

        return $query->getResultArray();
    }
    public function countByJob()
    {
        $query = $this->db->query("
            SELECT pekerjaan, COUNT(*) as count 
            FROM (
                SELECT DISTINCT nik, created_at, pekerjaan 
                FROM tb_survey
            ) as distinct_survey
            GROUP BY pekerjaan
        ");

        return $query->getResultArray();
    }

    public function countEducation()
    {
        $query = $this->db->query("
            SELECT pendidikan, COUNT(*) as count 
            FROM (
                SELECT DISTINCT nik, created_at, pendidikan 
                FROM tb_survey
            ) as distinct_survey
            GROUP BY pendidikan
        ");

        return $query->getResultArray();
    }

    public function countSatisfaction()
    {
        $query = $this->db->query("
        SELECT 
            SUM(option4) as sangat_puas, 
            SUM(option3) as puas, 
            SUM(option2) as kurang_puas, 
            SUM(option1) as tidak_puas
        FROM tb_survey
    ");

        return $query->getRowArray();
    }

    public function getDistinctEducations()
    {
        // Ambil nilai unik dari kolom pendidikan
        $distinctEducations = $this->db->table($this->table)
            ->distinct()
            ->select('pendidikan')
            ->get()
            ->getResultArray();

        return $distinctEducations;
    }

    public function countByQuestionWithOptions()
    {
        // Lakukan query untuk menghitung jumlah jawaban berdasarkan pertanyaan (id_question) dan ambil opsi dan pertanyaan dari tb_question
        $query = $this->db->query("
        SELECT q.id AS question_id,
               q.question,  -- tambahkan kolom pertanyaan di sini
               q.option1 AS option1_name,
               q.option2 AS option2_name,
               q.option3 AS option3_name,
               q.option4 AS option4_name,
               s.id_question,
               SUM(s.option1) as count_option1,
               SUM(s.option2) as count_option2,
               SUM(s.option3) as count_option3,
               SUM(s.option4) as count_option4
        FROM tb_survey s
        JOIN tb_question q ON s.id_question = q.id
        GROUP BY s.id_question
    ");

        return $query->getResultArray();
    }
    public function getQuestionById($id)
    {
        // Ambil pertanyaan dari tabel tb_question berdasarkan ID
        $query = $this->db->query("SELECT question FROM tb_question WHERE id = $id");
        $result = $query->getRow();

        // Pastikan query berhasil dan ada hasil
        if ($result) {
            return $result->question;
        } else {
            return null; // Atau sesuaikan dengan penanganan kesalahan Anda
        }
    }
    public function countResponden($bulan, $pendidikan, $tahun)
    {
        // Menghitung jumlah responden berdasarkan bulan dan jenis pendidikan
        $this->select('COUNT(*) as jumlah');
        $this->where('MONTH(created_at)', $bulan);
        $this->where('YEAR(created_at)', $tahun);
        $this->where('pendidikan', $pendidikan);
        $this->groupBy('nik, created_at'); // Mengelompokkan berdasarkan kombinasi nik dan created_at
        $result = $this->countAllResults('tb_survey');

        // Mengembalikan jumlah responden
        return $result;
    }
    public function getIndeksKepuasan($bulan, $tahun)
    {
        return $this->db->table('tb_survey')
            ->select('(SUM(option1) + SUM(option2) * 2 + SUM(option3) * 3 + SUM(option4) * 4) / (COUNT(DISTINCT id_question) * 4 * COUNT(DISTINCT CONCAT(nik, created_at))) * 100 AS indeks_kepuasan')
            ->where('MONTH(created_at)', $bulan)
            ->where('YEAR(created_at)', $tahun)
            ->get()
            ->getRowArray();
    }
}
