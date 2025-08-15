<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="card shadow">
    <div class="card-header">
        <h5 class="mb-0">Tambah Layanan Baru (Langkah 1 dari 2)</h5>
    </div>
    <div class="card-body">
        <form action="/admin/layanan" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="nama_layanan" class="form-label">Nama Layanan Utama</label>
                <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" placeholder="Contoh: Facial Treatment" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Umum</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" placeholder="Jelaskan secara singkat tentang layanan ini..."></textarea>
            </div>

            <p class="form-text">
                Setelah ini, Anda akan diarahkan ke halaman selanjutnya untuk menambahkan variasi paket (harga & durasi) dan mengupload gambar.
            </p>

            <button type="submit" class="btn btn-primary">Lanjutkan ke Langkah 2</button>
            <a href="/admin/layanan" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>