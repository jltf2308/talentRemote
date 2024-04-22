<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
            ],
            'person_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'Unsigned' => TRUE,
                'null' => FALSE,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('person_id', 'people', 'id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
