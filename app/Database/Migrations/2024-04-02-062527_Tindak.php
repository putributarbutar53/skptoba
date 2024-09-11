<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tindak extends Migration
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
            'id_lapor' => [
                'type' => 'INT',
                'constraint' => 20
            ],
            'solution' => [
                'type' => 'TEXT'
            ],
            'status' => [
                'type' => 'CHAR',
                'constraint' => 1
            ],
            'picture' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'NULL' => true
            ]

        ]);
        $this->forge->addForeignKey('id_lapor','id','lapor');
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('tindak_lanjut');
    }

    public function down()
    {
        $this->forge->dropTable('tindak_lanjut');
    }
}

//id_lapor, solution, picture_tl, created_at