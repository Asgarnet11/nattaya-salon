<?= $this->extend('frontend/layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4 py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <div class="header-decoration mx-auto mb-4"></div>
        <h1 class="playfair-display display-4 text-burgundy mb-3 fw-bold"><?= esc($title) ?></h1>
        <p class="lead text-muted mx-auto" style="max-width: 600px;">
            Kunjungi kami di salah satu lokasi strategis kami yang nyaman dan mudah dijangkau di Kendari
        </p>
        <div class="header-decoration mx-auto mt-4"></div>
    </div>

    <!-- Interactive Map Section -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="map-container">
                <div class="map-header">
                    <h3 class="text-burgundy fw-semibold mb-0">
                        <i class="fas fa-map-marked-alt me-2 text-gold"></i>
                        Peta Lokasi Kami
                    </h3>
                    <p class="text-muted mb-0">Temukan cabang terdekat dengan Anda</p>
                </div>
                <div class="map-wrapper">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15919.10692518131!2d122.51330085!3d-3.99849905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2da1111111111111%3A0x1111111111111111!2sKendari%2C%20Kota%20Kendari%2C%20Sulawesi%20Tenggara!5e0!3m2!1sid!2sid!4v1628181818181!5m2!1sid!2sid"
                            allowfullscreen=""
                            loading="lazy"
                            class="map-iframe"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Branch Locations -->
    <?php if (!empty($cabang)): ?>
        <div class="branches-section">
            <div class="text-center mb-5">
                <h2 class="playfair-display text-burgundy fw-bold mb-3">Lokasi Cabang Kami</h2>
                <p class="text-muted">Pilih cabang yang paling dekat dengan Anda untuk pengalaman terbaik</p>
            </div>

            <div class="row g-4">
                <?php foreach ($cabang as $index => $c): ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                        <div class="branch-card h-100">
                            <div class="branch-header">
                                <div class="branch-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="branch-number">
                                    <?= sprintf('%02d', $index + 1) ?>
                                </div>
                            </div>

                            <div class="branch-content">
                                <h4 class="branch-title playfair-display text-burgundy fw-bold mb-3">
                                    <?= esc($c['nama_cabang']) ?>
                                </h4>

                                <div class="branch-info mb-4">
                                    <div class="info-item mb-3">
                                        <div class="info-icon">
                                            <i class="fas fa-map-marker-alt text-gold"></i>
                                        </div>
                                        <div class="info-content">
                                            <strong class="text-dark">Alamat</strong>
                                            <p class="text-muted mb-0"><?= esc($c['alamat']) ?></p>
                                        </div>
                                    </div>

                                    <?php if (!empty($c['no_telepon'])): ?>
                                        <div class="info-item mb-3">
                                            <div class="info-icon">
                                                <i class="fas fa-phone text-burgundy"></i>
                                            </div>
                                            <div class="info-content">
                                                <strong class="text-dark">Telepon</strong>
                                                <p class="text-muted mb-0">
                                                    <a href="tel:<?= esc($c['no_telepon']) ?>" class="text-decoration-none text-muted">
                                                        <?= esc($c['no_telepon']) ?>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="fas fa-clock text-gold"></i>
                                        </div>
                                        <div class="info-content">
                                            <strong class="text-dark">Jam Operasional</strong>
                                            <p class="text-muted mb-0">Senin - Minggu: 09.00 - 21.00 WITA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="branch-footer">
                                <div class="d-grid gap-2">
                                    <a href="/booking" class="btn btn-burgundy fw-medium">
                                        <i class="fas fa-calendar-plus me-2"></i>
                                        Booking di Cabang Ini
                                    </a>
                                    <?php if (!empty($c['no_telepon'])): ?>
                                        <a href="tel:<?= esc($c['no_telepon']) ?>" class="btn btn-outline-gold fw-medium">
                                            <i class="fas fa-phone me-2"></i>
                                            Hubungi Langsung
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-section mt-5 py-5">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-icon bg-burgundy text-white mb-3">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="text-burgundy fw-bold"><?= count($cabang) ?></h3>
                        <p class="text-muted">Lokasi Cabang</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-icon bg-gold text-dark mb-3">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h3 class="text-burgundy fw-bold">1</h3>
                        <p class="text-muted">Kota Terlayani</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-icon bg-burgundy-light text-white mb-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="text-burgundy fw-bold">12</h3>
                        <p class="text-muted">Jam Operasional</p>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Empty State -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="empty-state text-center py-5">
                    <div class="empty-icon mb-4">
                        <i class="fas fa-map-marker-alt fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">Informasi Lokasi Segera Hadir</h4>
                    <p class="text-muted mb-4">
                        Kami sedang mempersiapkan informasi lokasi cabang untuk Anda.
                        Hubungi kami untuk informasi lebih lanjut tentang layanan kami.
                    </p>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="/" class="btn btn-burgundy">
                            <i class="fas fa-home me-2"></i>
                            Kembali ke Beranda
                        </a>
                        <a href="/contact" class="btn btn-outline-gold">
                            <i class="fas fa-phone me-2"></i>
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- AOS Library -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 50
    });

    // Add interactive map loading
    document.addEventListener('DOMContentLoaded', function() {
        const mapWrapper = document.querySelector('.map-wrapper');
        const iframe = mapWrapper.querySelector('iframe');

        // Add loading state
        mapWrapper.classList.add('loading');

        iframe.addEventListener('load', function() {
            mapWrapper.classList.remove('loading');
            mapWrapper.classList.add('loaded');
        });
    });
</script>

<style>
    :root {
        --burgundy: #800020;
        --burgundy-light: #a0002a;
        --burgundy-dark: #600018;
        --gold: #ffd700;
        --gold-light: #fff8dc;
        --gold-dark: #daa520;
    }

    .text-burgundy {
        color: var(--burgundy) !important;
    }

    .bg-burgundy {
        background-color: var(--burgundy) !important;
    }

    .bg-burgundy-light {
        background-color: var(--burgundy-light) !important;
    }

    .bg-gold {
        background-color: var(--gold) !important;
    }

    .text-gold {
        color: var(--gold-dark) !important;
    }

    /* Header Decoration */
    .header-decoration {
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, var(--burgundy), var(--gold), var(--burgundy));
        border-radius: 2px;
    }

    /* Map Container */
    .map-container {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .map-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(128, 0, 32, 0.15);
    }

    .map-header {
        background: linear-gradient(135deg, var(--burgundy), var(--burgundy-light));
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .map-wrapper {
        position: relative;
        background: #f8f9fa;
    }

    .map-wrapper.loading::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        border: 3px solid var(--burgundy-light);
        border-top: 3px solid var(--gold);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        z-index: 10;
    }

    @keyframes spin {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

    .map-iframe {
        border: none;
        transition: all 0.3s ease;
    }

    /* Branch Cards */
    .branch-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        overflow: hidden;
        position: relative;
    }

    .branch-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(128, 0, 32, 0.15);
    }

    .branch-header {
        background: linear-gradient(135deg, var(--burgundy), var(--burgundy-light));
        color: white;
        padding: 2rem;
        text-align: center;
        position: relative;
    }

    .branch-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .branch-number {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: var(--gold);
        color: var(--burgundy);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.875rem;
    }

    .branch-content {
        padding: 2rem;
    }

    .branch-title {
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(128, 0, 32, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-content strong {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .branch-footer {
        padding: 2rem;
        background: rgba(128, 0, 32, 0.02);
    }

    /* Buttons */
    .btn-burgundy {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
        color: white;
        transition: all 0.3s ease;
    }

    .btn-burgundy:hover {
        background-color: var(--burgundy-dark);
        border-color: var(--burgundy-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(128, 0, 32, 0.3);
    }

    .btn-outline-gold {
        border-color: var(--gold-dark);
        color: var(--gold-dark);
        transition: all 0.3s ease;
    }

    .btn-outline-gold:hover {
        background-color: var(--gold);
        border-color: var(--gold);
        color: #333;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.3);
    }

    /* Stats Section */
    .stats-section {
        background: linear-gradient(135deg,
                rgba(128, 0, 32, 0.02),
                rgba(255, 215, 0, 0.02));
        border-radius: 20px;
    }

    .stat-item {
        padding: 1rem;
    }

    .stat-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }

    /* Empty State */
    .empty-state {
        background: linear-gradient(135deg,
                rgba(255, 215, 0, 0.05),
                rgba(128, 0, 32, 0.05));
        border-radius: 20px;
        border: 2px dashed rgba(128, 0, 32, 0.2);
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .display-4 {
            font-size: 2.5rem;
        }

        .branch-header,
        .branch-content,
        .branch-footer {
            padding: 1.5rem;
        }

        .map-header {
            padding: 1.5rem;
        }

        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }

        .d-flex.gap-2 {
            flex-direction: column;
        }
    }

    /* Playfair Display Enhancement */
    .playfair-display {
        font-family: 'Playfair Display', serif;
        letter-spacing: -0.5px;
    }
</style>

<?= $this->endSection() ?>