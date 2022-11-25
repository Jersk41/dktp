<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_user' => 'superadmin',
                'email' => 'super@admin.com',
                'password' => password_hash('Masteradminw3b',PASSWORD_DEFAULT),
                'no_telp' => '082111222333',
                'level' => 'superadmin',
                'foto_profil' => 'avatar.svg',
                'active' => 1,
                'verify_key' => bin2hex(random_bytes(3)),
                'time_verified' => time(),
            ],
            [
                'nama_user' => 'admin1',
                'email' => 'admin1@admin.com',
                'password' => password_hash('Adminweb1',PASSWORD_DEFAULT),
                'no_telp' => '082111222334',
                'level' => 'admin',
                'foto_profil' => 'avatar.svg',
                'active' => 1,
                'verify_key' => bin2hex(random_bytes(3)),
                'time_verified' => time(),
            ],
            [
                'nama_user' => 'Si A',
                'email' => 'sia@ektp.com',
                'password' => password_hash('Penduduk62',PASSWORD_DEFAULT),
                'no_telp' => '082111222335',
                'level' => 'user',
                'foto_profil' => 'avatar.svg',
                'active' => 1,
                'verify_key' => bin2hex(random_bytes(3)),
                'time_verified' => time(),
            ]
        ];
        $this->db->table('user')->insertBatch($data);
        // dummy data
        $faker = \Faker\Factory::create('id_ID');
        for ($i=0; $i < 98; $i++) { 
            $fakedata = [
                'nama_user' => $faker->name,
                'email' => $faker->safeEmail,
                'password' => password_hash('Penduduk1',PASSWORD_DEFAULT),
                'no_telp' => $faker->phoneNumber,
                'level' => $faker->randomElement(['superadmin','admin','user']),
                'foto_profil' => 'avatar.svg',
                'active' => 0,
                'verify_key' => bin2hex(random_bytes(3)),
                'time_verified' => time(),
            ];
            $this->db->table('user')->insert($fakedata);
        }
    }
}
