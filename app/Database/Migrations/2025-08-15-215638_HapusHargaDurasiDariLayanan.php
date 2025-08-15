<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HapusHargaDurasiDariLayanan extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('layanan', ['harga', 'durasi_menit']);
    }

    public function down()
    {
        $this->forge->addColumn('layanan', [
            'harga' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'durasi_menit' => ['type' => 'INT', 'constraint' => 5],
        ]);
    }
}
