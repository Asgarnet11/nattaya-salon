<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UbahJadwalBookingUntukPelanggan extends Migration
{
    public function up()
    {
        // Hapus kolom lama
        $this->forge->dropColumn('jadwal_booking', 'nama_pelanggan');
        $this->forge->dropColumn('jadwal_booking', 'no_telepon');

        // Tambah kolom baru dan foreign key
        $this->forge->addColumn('jadwal_booking', [
            'id_pelanggan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'after'      => 'id' // Posisi kolom setelah 'id'
            ]
        ]);

        // Di CodeIgniter 4, penambahan foreign key setelah tabel dibuat
        // lebih aman dilakukan dengan query SQL langsung jika forge bermasalah.
        // Namun, cara Forge yang ideal adalah seperti ini (meskipun kadang butuh penyesuaian):
        $this->db->query('ALTER TABLE jadwal_booking ADD CONSTRAINT FK_booking_pelanggan FOREIGN KEY (id_pelanggan) REFERENCES pelanggan(id) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down()
    {
        // Logika untuk mengembalikan perubahan (jika diperlukan)
        $this->forge->dropForeignKey('jadwal_booking', 'FK_booking_pelanggan');
        $this->forge->dropColumn('jadwal_booking', 'id_pelanggan');
        $this->forge->addColumn('jadwal_booking', [
            'nama_pelanggan' => ['type' => 'VARCHAR', 'constraint' => '150'],
            'no_telepon' => ['type' => 'VARCHAR', 'constraint' => '20'],
        ]);
    }
}
