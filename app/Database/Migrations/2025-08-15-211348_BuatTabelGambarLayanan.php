<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTabelGambarLayanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_layanan' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'nama_file' => ['type' => 'VARCHAR', 'constraint' => '255'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_layanan', 'layanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('gambar_layanan');
    }

    public function down()
    {
        $this->forge->dropTable('gambar_layanan');
    }
}
