<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SidikJari extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'auto_increment' => true
            ],
            'nik' => [
                'type'          => 'BIGINT',
                'constraint'    => 16
            ],
            'kanan_jempol' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'kanan_telunjuk' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'kanan_jaritengah' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'kanan_jarimanis' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'kanan_kelingking' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'kiri_jempol' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'kiri_telunjuk' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'kiri_jaritengah' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'kiri_jarimanis' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'kiri_kelingking' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
        ])->addKey('id', true)
            ->addForeignKey('nik', 'penduduk', 'nik', 'CASCADE', 'CASCADE')
            ->createTable('sidik_jari');
    }

    public function down()
    {
        $this->forge->dropTable('sidik_jari');
    }
}
