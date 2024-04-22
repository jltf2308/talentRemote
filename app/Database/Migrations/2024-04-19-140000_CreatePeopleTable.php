<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePeopleTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => FALSE,
            ],
            'type_person' => [
                'type' => 'ENUM("Recruiter","Talent")',
                'null' => FALSE,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('people');
    }

    public function down()
    {
        $this->forge->dropTable('people');
    }
}
