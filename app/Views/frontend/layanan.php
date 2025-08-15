<?= $this->extend('frontend/layout/template') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="playfair-display"><?= esc($title) ?></h1>
        <p>Kami menyediakan berbagai perawatan profesional untuk memenuhi kebutuhan Anda.</p>
    </div>

    <div class="row">
        <?php if (!empty($layanan)): ?>
            <?php foreach ($layanan as $l): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="/uploads/layanan/<?= esc($l['gambar_sampul'] ?? 'placeholder.jpg') ?>" class="card-img-top" alt="<?= esc($l['nama_layanan']) ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title playfair-display"><?= esc($l['nama_layanan']) ?></h5>

                            <?php if (!empty($l['harga_mulai'])): ?>
                                <h6 class="card-subtitle mb-2 text-muted">Mulai dari Rp <?= number_format($l['harga_mulai'], 0, ',', '.') ?></h6>
                            <?php else: ?>
                                <h6 class="card-subtitle mb-2 text-muted">Lihat detail untuk harga</h6>
                            <?php endif; ?>

                            <p class="card-text"><?= esc(word_limiter($l['deskripsi'], 15)) ?></p>

                            <div class="mt-auto">
                                <a href="/layanan/<?= $l['id'] ?>" class="btn btn-outline-primary w-100">Lihat Paket & Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Belum ada layanan yang tersedia saat ini.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>