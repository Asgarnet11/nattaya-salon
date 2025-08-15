<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Layanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'nama_layanan' => ['type' => 'VARCHAR', 'constraint' => '200'],
            'deskripsi' => ['type' => 'TEXT', 'null' => true],
            'harga' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'durasi_menit' => ['type' => 'INT', 'constraint' => 5],
            'gambar' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('layanan');
    }

    public function down()
    {
        $this->forge->dropTable('layanan');
    }
}
