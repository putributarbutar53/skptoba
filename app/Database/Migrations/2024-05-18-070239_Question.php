<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Question extends Migration
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
            'question' => [
                'type' => 'INT',
                'constraint' => 20
            ],
            'option1' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'option2' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'option3' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'option4' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('tb_question');
    }

    public function down()
    {
        $this->forge->dropTable('tb_question');
    }
}
