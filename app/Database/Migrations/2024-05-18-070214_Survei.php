<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Survei extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nik' => [
                'type' => 'CHAR',
                'constraint' => 16
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'jk' => [
                'type' => 'CHAR',
                'constraint' => 10
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'pendidikan' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'pekerjaan' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'jenis_layanan' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'tempat_layanan' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'saran' => [
                'type' => 'TEXT'
            ],
            'id_question' => [
                'type' => 'INT',
                'constraint' => 20
            ],
            'option1' => [
                'type' => 'INT',
                'constraint' => 20,
            ],
            'option2' => [
                'type' => 'INT',
                'constraint' => 20,
            ],
            'option3' => [
                'type' => 'INT',
                'constraint' => 20,
            ],
            'option4' => [
                'type' => 'INT',
                'constraint' => 20,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addForeignKey('id_question', 'tb_question', 'id');
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('tb_survey');
    }

    public function down()
    {
        $this->forge->dropTable('tb_survey');
    }
}
