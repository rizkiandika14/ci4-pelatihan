<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'phone' => '08123456789',
            'gender' => 'Laki-laki',],
            ['name' => 'user',
            'password' => password_hash('user', PASSWORD_DEFAULT),
            'email' => 'user@gmail.com',
            'role' => 'user',
            'phone' => '08123456789',
            'gender' => 'Laki-laki',],
            ['name' => 'trainer',
            'password' => password_hash('trainer', PASSWORD_DEFAULT),
            'email' => 'trainer@gmail.com',
            'role' => 'trainer',
            'phone' => '08123456789',
            'gender' => 'Laki-laki',],
            ['name' => 'superadmin',
            'password' => password_hash('superadmin', PASSWORD_DEFAULT),
            'email' => 'superadmin@gmail.com',
            'role' => 'superadmin',
            'phone' => '08123456789',
            'gender' => 'Laki-laki',],
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
