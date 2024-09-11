<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Lapor extends Migration
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
            'id_skpd' => [
                'type' => 'INT',
                'constraint' => 20
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'no_hpe' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'report' => [
                'type' => 'TEXT'
            ],
            'picture' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addForeignKey('id_skpd','tb_admin','id');
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('lapor');
    }

    public function down()
    {
        $this->forge->dropTable('lapor');
    }
}
