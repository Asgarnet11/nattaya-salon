<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HapusKolomGambarDariLayanan extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('layanan', 'gambar');
    }

    public function down()
    {
        $this->forge->addColumn('layanan', [
            'gambar' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
        ]);
    }
}
