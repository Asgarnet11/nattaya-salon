<?= $this->extend('frontend/layout/template') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="playfair-display"><?= esc($title) ?></h1>
        <p>Lihat hasil karya terbaik dari para stylist profesional kami.</p>
    </div>

    <div class="row">
        <?php if (!empty($galeri)): ?>
            <?php foreach ($galeri as $g): ?>
                <div class="col-md-4 mb-4">
                    <a href="/uploads/gallery/<?= esc($g['nama_file']) ?>" data-toggle="lightbox">
                        <img src="/uploads/gallery/<?= esc($g['nama_file']) ?>" class="img-fluid rounded shadow-sm" alt="<?= esc($g['judul']) ?>" style="height: 250px; width: 100%; object-fit: cover;">
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Belum ada gambar di galeri.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>