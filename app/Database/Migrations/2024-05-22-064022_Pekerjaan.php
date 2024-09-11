<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pekerjaan extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255, // Tambahkan panjang maksimum untuk kolom name
                'null' => false
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('tb_pekerjaan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pekerjaan');
    }
}
