<?= $this->extend('frontend/layout/template') ?>

<?= $this->section('content') ?>

<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(128, 0, 32, 0.8), rgba(128, 0, 32, 0)),
            url('/asset/images/hero-bg.jpg') center/cover;
        color: white;
        position: relative;
        overflow: hidden;
        min-height: 70vh;
        display: flex;
        align-items: center;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(128, 0, 32, 0.1) 25%, transparent 25%),
            linear-gradient(-45deg, rgba(255, 215, 0, 0.1) 25%, transparent 25%),
            linear-gradient(45deg, transparent 75%, rgba(128, 0, 32, 0.1) 75%),
            linear-gradient(-45deg, transparent 75%, rgba(255, 215, 0, 0.1) 75%);
        background-size: 60px 60px;
        background-position: 0 0, 0 30px, 30px -30px, -30px 0px;
        opacity: 0.3;
        animation: float 5s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-section h1 {
        font-size: 3.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        margin-bottom: 1.5rem;
        animation: fadeInUp 1s ease-out;
    }

    .hero-section .lead {
        font-size: 1.3rem;
        margin-bottom: 2rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 1s ease-out 0.2s both;
    }

    .hero-section .btn {
        animation: fadeInUp 1s ease-out 0.4s both;
        padding: 1rem 2.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
        transition: all 0.3s ease;
    }

    .hero-section .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(255, 215, 0, 0.4);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Service Section */
    .service-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        position: relative;
    }

    .service-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--gold) 0%, var(--burgundy) 50%, var(--gold) 100%);
    }

    .section-title {
        position: relative;
        display: inline-block;
        margin-bottom: 3rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, var(--gold), var(--burgundy));
        border-radius: 2px;
    }

    /* Enhanced Cards */
    .service-card {
        background: white;
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s ease;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        position: relative;
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--burgundy), var(--gold));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .service-card:hover::before {
        transform: scaleX(1);
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(128, 0, 32, 0.15);
    }

    .service-card .card-body {
        padding: 2rem;
        text-align: center;
    }

    .service-card .card-title {
        color: var(--burgundy);
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 1.25rem;
    }

    .service-card .card-text {
        color: var(--gold);
        font-weight: 600;
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
    }

    .service-card .btn {
        border-radius: 25px;
        padding: 0.7rem 1.8rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .service-card .btn:hover {
        transform: scale(1.05);
    }

    /* Gallery Section */
    .gallery-section {
        background: linear-gradient(rgba(128, 0, 32, 0.95), rgba(128, 0, 32, 0.9)),
            url('/asset/images/salon-bg.jpg') center/cover;
        color: white;
        position: relative;
    }

    .gallery-section .section-title {
        color: white;
    }

    .gallery-section .section-title::after {
        background: linear-gradient(90deg, var(--gold), white);
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        transition: all 0.4s ease;
    }

    .gallery-item:hover {
        transform: scale(1.05);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
    }

    .gallery-item img {
        height: 250px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    .gallery-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(128, 0, 32, 0.3), rgba(255, 215, 0, 0.3));
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }

    .gallery-item:hover::before {
        opacity: 1;
    }

    /* Info Section */
    .info-section {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        color: white;
        position: relative;
    }

    .info-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--gold) 0%, var(--burgundy) 50%, var(--gold) 100%);
    }

    .info-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 215, 0, 0.2);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        transition: all 0.4s ease;
        height: 100%;
    }

    .info-card:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--gold);
        transform: translateY(-5px);
    }

    .info-card .icon {
        font-size: 3rem;
        color: var(--gold);
        margin-bottom: 1rem;
        display: block;
    }

    .info-card h4 {
        color: var(--gold);
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .info-card p {
        color: #cccccc;
        margin: 0;
        line-height: 1.6;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(rgba(255, 215, 0, 0.95), rgba(255, 215, 0, 0.9)),
            url('/public/asset/images/cta-bg.jpg') center/cover;
        color: var(--burgundy);
        text-align: center;
        position: relative;
    }

    .cta-section h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .cta-section p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        font-weight: 500;
    }

    .cta-section .btn {
        background: var(--burgundy);
        border: none;
        color: white;
        padding: 1rem 3rem;
        font-size: 1.2rem;
        font-weight: 600;
        border-radius: 50px;
        box-shadow: 0 10px 30px rgba(128, 0, 32, 0.3);
        transition: all 0.3s ease;
    }

    .cta-section .btn:hover {
        background: #a00028;
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(128, 0, 32, 0.4);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2.5rem;
        }

        .hero-section .lead {
            font-size: 1.1rem;
        }

        .gallery-item img {
            height: 200px;
        }

        .info-card {
            margin-bottom: 2rem;
        }

        .cta-section h2 {
            font-size: 2rem;
        }
    }

    /* Variable definitions */
    :root {
        --burgundy: #800020;
        --gold: #FFD700;
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center hero-content">
                <h1 class="playfair-display">Kecantikan & Relaksasi Profesional</h1>
                <p class="lead">Temukan perawatan terbaik untuk Anda di Nattaya Salon Kendari dengan layanan berkualitas tinggi dan teknologi terdepan.</p>
                <a href="/booking" class="btn btn-primary btn-lg">
                    <i class="bi bi-calendar-check me-2"></i>Buat Janji Temu
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="service-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="section-title playfair-display">Layanan Unggulan Kami</h2>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($layanan_unggulan as $layanan): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body">
                            <div class="icon mb-3">
                                <i class="bi bi-stars" style="font-size: 2.5rem; color: var(--gold);"></i>
                            </div>
                            <h5 class="card-title"><?= esc($layanan['nama_layanan']) ?></h5>
                            <?php if (!empty($layanan['harga_mulai'])): ?>
                                <p class="card-text">Mulai dari Rp <?= number_format($layanan['harga_mulai'], 0, ',', '.') ?></p>
                            <?php endif; ?>
                            <a href="/layanan" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-right me-2"></i>Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Info Cards Section -->
<section class="info-section py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="info-card">
                    <i class="bi bi-award icon"></i>
                    <h4>Profesional Bersertifikat</h4>
                    <p>Tim ahli berpengalaman dengan sertifikasi internasional untuk hasil terbaik</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="info-card">
                    <i class="bi bi-heart icon"></i>
                    <h4>Produk Berkualitas</h4>
                    <p>Menggunakan produk premium dan aman untuk semua jenis kulit dan rambut</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="info-card">
                    <i class="bi bi-clock icon"></i>
                    <h4>Pelayanan Fleksibel</h4>
                    <p>Jam operasional yang fleksibel dengan sistem booking online yang mudah</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="info-card">
                    <i class="bi bi-shield-check icon"></i>
                    <h4>Standar Kebersihan</h4>
                    <p>Menerapkan protokol kebersihan ketat untuk kenyamanan dan keamanan Anda</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title playfair-display">Galeri Terbaru</h2>
                <p class="lead text-light">Lihat hasil karya terbaik dari para ahli kami</p>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($galeri_terbaru as $galeri): ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="gallery-item">
                        <img src="/uploads/gallery/<?= esc($galeri['nama_file']) ?>"
                            class="img-fluid"
                            alt="<?= esc($galeri['judul']) ?>"
                            loading="lazy">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-12 text-center mt-4">
                <a href="/galeri" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-images me-2"></i>Lihat Semua Galeri
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="cta-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="playfair-display">Siap Merasakan Pengalaman Berbeda?</h2>
                <p>Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran khusus untuk pelanggan baru</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="/booking" class="btn btn-dark btn-lg">
                        <i class="bi bi-calendar-plus me-2"></i>Book Sekarang
                    </a>
                    <!-- <a href="/kontak" class="btn btn-outline-dark btn-lg">
                        <i class="bi bi-chat-dots me-2"></i>Konsultasi Gratis
                    </a> -->
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>