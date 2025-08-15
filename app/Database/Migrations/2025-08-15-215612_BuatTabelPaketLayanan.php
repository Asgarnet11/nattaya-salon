<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTabelPaketLayanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_layanan' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'nama_paket' => ['type' => 'VARCHAR', 'constraint' => '150'],
            'harga' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'durasi_menit' => ['type' => 'INT', 'constraint' => 5],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_layanan', 'layanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('paket_layanan');
    }

    public function down()
    {
        $this->forge->dropTable('paket_layanan');
    }
}
