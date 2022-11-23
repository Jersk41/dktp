<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Penduduk extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $wilayah = $this->db->table('setting')->select('kode_wilayah')->get()->getResultArray();
        for ($i=0; $i < 98; $i++) { 
            $jk = $faker->randomElement(['L','P']);
            if($jk == 'L'){
                $name = $faker->name('male');
            }else{
                $name = $faker->name('female');
            }
            $fakedata = [
                'nik' => $faker->nik(),
                'no_kk' => $faker->nik(),
                'nama' => $name,
                'tempat_lahir' => $faker->state,
                'tgl_lahir' => $faker->date,
                'jenis_kelamin' => $jk,
                'alamat' => $faker->streetAddress,
                'rt_rw' => $faker->randomNumber(3).'/'.$faker->randomNumber(3),
                'agama' => $faker->randomElement(['islam','kristen','hindu','buddha']),
                'golongan_darah' => $faker->randomElement(['A','B','AB','O']),
                'status_perkawinan' => $faker->randomElement(['belum menikah','menikah']),
                'pekerjaan' => $faker->jobTitle,
                'pendidikan' => $faker->randomElement(['sd sederajat','smp sederajat','sma sederajat','s1','s2','s3']),
                'kewarganegaraan' => $faker->randomElement(['wni','wna']),
                'tgl_pembuatan' => $faker->date(),
                'kode_wilayah' => $faker->randomElement($wilayah),
                'status' => $faker->randomElement(['aktif','mutasi'])
            ];
            $this->db->table('penduduk')->insert($fakedata);
        }
    }
}
