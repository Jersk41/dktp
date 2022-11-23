<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penduduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nik' => [
                'type'          => 'BIGINT',
                'constraint'    => 16
            ],
            'no_kk' => [
                'type'          => 'BIGINT',
                'constraint'    => 20
            ],
            'nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100
            ],
            'tempat_lahir' => [
                'type'          => 'VARCHAR',
                'constraint'    => 50
            ],
            'tgl_lahir' => [
                'type'          => 'DATE'
            ],
            'jenis_kelamin' => [
                'type'          => 'ENUM',
                'constraint'    => ['L','P']
            ],
            'alamat' => [
                'type'          => 'TEXT'
            ],
            'rt_rw' => [
                'type'          => 'VARCHAR',
                'constraint'    => 7
            ],
            'agama' => [
                'type'          => 'VARCHAR',
                'constraint'    => 25
            ],
            'golongan_darah' => [
                'type'          => 'ENUM',
                'constraint'    => ['A','B','AB','O'],
                'null'          => true
            ],
            'status_perkawinan' => [
                'type'          => 'VARCHAR',
                'constraint'    => 25
            ],
            'pekerjaan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ],
            'pendidikan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ],
            'kewarganegaraan' => [
                'type'          => 'ENUM',
                'constraint'    => ['wni','wna']
            ],
            'tgl_pembuatan' => [
                'type'          => 'DATE',
                'null'          => true
            ],
            'status' => [
                'type'          => 'ENUM',
                'constraint'    => ['aktif','mutasi']
            ],
            'kode_wilayah' => [
                'type'          => 'VARCHAR',
                'constraint'    => 20
            ],
            'created_by' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
        ])->addKey('nik',true)
        ->addForeignKey('kode_wilayah','setting','kode_wilayah')
        ->createTable('penduduk');
    }

    public function down()
    {
        $this->forge->dropTable('penduduk');
    }
}
