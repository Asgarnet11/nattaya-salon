<?= $this->extend('frontend/layout/template') ?>
<?= $this->section('content') ?>
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="playfair-display"><?= esc($title) ?></h1>
    </div>
    <div class="row">
        <?php foreach ($artikel as $a): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title playfair-display"><?= esc($a['judul']) ?></h5>
                        <p class="card-text"><?= esc(word_limiter($a['isi_artikel'], 20)) ?></p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="/artikel/<?= esc($a['slug']) ?>" class="btn btn-outline-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>