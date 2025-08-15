<?= $this->extend('frontend/layout/template') ?>
<?= $this->section('content') ?>

<!-- Minimal Custom CSS -->
<style>
    .service-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .carousel-wrapper {
        border-radius: 15px;
        overflow: hidden;
    }

    .service-title {
        color: #2c3e50;
        font-weight: 700;
    }

    .package-table tr:hover {
        background-color: #f8f9fa;
        transform: translateX(3px);
        transition: all 0.2s ease;
    }

    .btn-booking {
        background: linear-gradient(45deg, #007bff, #0056b3);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-booking:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
    }
</style>

<div class="container my-5">
    <div class="service-card p-4">
        <div class="row">
            <div class="col-md-6">
                <div class="carousel-wrapper">
                    <div id="serviceCarousel" class="carousel slide shadow-sm" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-indicators">
                            <?php foreach ($gambar as $key => $g): ?>
                                <button type="button" data-bs-target="#serviceCarousel" data-bs-slide-to="<?= $key ?>" <?= $key == 0 ? 'class="active"' : '' ?>></button>
                            <?php endforeach; ?>
                        </div>
                        <div class="carousel-inner">
                            <?php foreach ($gambar as $key => $g): ?>
                                <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
                                    <img src="/uploads/layanan/<?= esc($g['nama_file']) ?>" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Service Image">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#serviceCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#serviceCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="service-title playfair-display mb-3"><?= esc($layanan['nama_layanan']) ?></h1>
                <p class="lead text-muted"><?= esc($layanan['deskripsi']) ?></p>
                <hr class="my-4">

                <h4 class="mt-4 playfair-display mb-3">📋 Pilihan Paket</h4>
                <div class="table-responsive">
                    <table class="table package-table table-hover">
                        <tbody>
                            <?php foreach ($paket as $p): ?>
                                <tr>
                                    <td><strong>💎 <?= esc($p['nama_paket']) ?></strong></td>
                                    <td>⏱️ <?= esc($p['durasi_menit']) ?> Menit</td>
                                    <td class="text-end"><strong class="text-success">💰 Rp <?= number_format($p['harga'], 0, ',', '.') ?></strong></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <a href="/booking" class="btn btn-primary btn-lg btn-booking">
                        🚀 Booking Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>