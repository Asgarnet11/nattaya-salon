<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UbahBookingUntukPaket extends Migration
{
    public function up()
    {
        // Hapus foreign key dan kolom lama
        $this->forge->dropForeignKey('jadwal_booking', 'jadwal_booking_id_layanan_foreign');
        $this->forge->dropColumn('jadwal_booking', 'id_layanan');

        // Tambah kolom baru untuk paket
        $this->forge->addColumn('jadwal_booking', [
            'id_paket_layanan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'after'      => 'id_cabang'
            ]
        ]);

        // Tambahkan foreign key baru
        $this->db->query('ALTER TABLE jadwal_booking ADD CONSTRAINT FK_booking_paket FOREIGN KEY (id_paket_layanan) REFERENCES paket_layanan(id) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down()
    {
        // Logika untuk mengembalikan perubahan (jika perlu)
        $this->forge->dropForeignKey('jadwal_booking', 'FK_booking_paket');
        $this->forge->dropColumn('jadwal_booking', 'id_paket_layanan');
        $this->forge->addColumn('jadwal_booking', [
            'id_layanan' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
        ]);
    }
}
