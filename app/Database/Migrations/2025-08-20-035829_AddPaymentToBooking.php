<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPaymentToBooking extends Migration
{
    public function up()
    {
        // 1. Modifikasi kolom status
        $this->forge->modifyColumn('jadwal_booking', [
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['waiting_payment', 'waiting_verification', 'confirmed', 'completed', 'canceled'],
                'default'    => 'waiting_payment',
            ],
        ]);

        // 2. Tambahkan kolom baru untuk bukti pembayaran
        $this->forge->addColumn('jadwal_booking', [
            'bukti_pembayaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'after'      => 'status'
            ],
        ]);
    }

    public function down()
    {
        // Mengembalikan perubahan jika diperlukan
        $this->forge->dropColumn('jadwal_booking', 'bukti_pembayaran');
        $this->forge->modifyColumn('jadwal_booking', [
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'confirmed', 'completed', 'canceled'],
                'default'    => 'pending',
            ],
        ]);
    }
}
