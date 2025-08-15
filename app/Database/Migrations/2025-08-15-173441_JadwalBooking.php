<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JadwalBooking extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_pelanggan' => ['type' => 'VARCHAR', 'constraint' => '150'],
            'no_telepon' => ['type' => 'VARCHAR', 'constraint' => '20'],
            'id_cabang' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'id_layanan' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'id_karyawan' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'null' => true],
            'tanggal_booking' => ['type' => 'DATE'],
            'jam_booking' => ['type' => 'TIME'],
            'status' => ['type' => 'ENUM', 'constraint' => ['pending', 'confirmed', 'canceled', 'completed'], 'default' => 'pending'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_cabang', 'cabang', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_layanan', 'layanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_karyawan', 'karyawan', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('jadwal_booking');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal_booking');
    }
}
