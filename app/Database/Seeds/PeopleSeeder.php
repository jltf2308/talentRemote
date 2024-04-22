<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PeopleSeeder extends Seeder
{
    public function run()
    {
        $person = [
            'first_name' => 'Jose',
            'last_name' => 'Tovar',
            'type_person' => 'Recruiter'
        ];
        // Using Query Builder
        $this->db->table('people')->insert($person);

        $user = [
            'username' => 'jltf2308',
            'email' => 'jtf2308@gmail.com',
            'password' => password_hash('Jltf238*', PASSWORD_DEFAULT),
            'person_id' => 1
        ];

        $this->db->table('users')->insert($user);

    }
}
