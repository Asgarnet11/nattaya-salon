<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTabelPelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_lengkap' => ['type' => 'VARCHAR', 'constraint' => '150'],
            'email' => ['type' => 'VARCHAR', 'constraint' => '150', 'unique' => true],
            'no_telepon' => ['type' => 'VARCHAR', 'constraint' => '20'],
            'password' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggan');
    }
}
