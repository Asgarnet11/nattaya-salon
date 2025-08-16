<?= $this->extend('frontend/layout/template') ?>

<?= $this->section('content') ?>

<style>
    :root {
        --gold-color: #DAA520;
        --light-gold: #F4E4BC;
        --burgundy-color: #800020;
        --dark-burgundy: #5D001E;
        --white: #ffffff;
        --light-gray: #f8f9fa;
        --shadow-light: rgba(0, 0, 0, 0.1);
        --shadow-medium: rgba(0, 0, 0, 0.15);
    }

    .services-hero {
        background: linear-gradient(135deg, var(--burgundy-color) 0%, var(--dark-burgundy) 100%);
        color: white;
        padding: 80px 0;
        margin-bottom: 60px;
        position: relative;
        overflow: hidden;
    }

    .services-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.03"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.03"/><circle cx="50" cy="10" r="0.5" fill="%23ffffff" opacity="0.02"/><circle cx="10" cy="60" r="0.5" fill="%23ffffff" opacity="0.02"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        animation: float 20s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-10px) rotate(1deg);
        }
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .hero-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .services-container {
        padding: 0 20px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .service-card {
        background: var(--white);
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px var(--shadow-light);
        height: 100%;
        position: relative;
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--gold-color) 0%, var(--light-gold) 100%);
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px var(--shadow-medium);
    }

    .service-card:hover::before {
        transform: scaleX(1);
    }

    .service-image {
        height: 250px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
        position: relative;
    }

    .service-card:hover .service-image {
        transform: scale(1.05);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, var(--burgundy-color) 0%, transparent 50%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .service-card:hover .image-overlay {
        opacity: 0.1;
    }

    .card-body {
        padding: 30px;
        display: flex;
        flex-direction: column;
        height: calc(100% - 250px);
    }

    .service-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--burgundy-color);
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .service-price {
        color: var(--gold-color);
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .service-price i {
        margin-right: 8px;
        font-size: 0.9rem;
    }

    .service-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 25px;
        flex-grow: 1;
    }

    .service-btn {
        background: linear-gradient(135deg, var(--gold-color) 0%, #B8860B 100%);
        border: none;
        color: var(--white);
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .service-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .service-btn:hover::before {
        left: 100%;
    }

    .service-btn:hover {
        background: linear-gradient(135deg, #B8860B 0%, var(--gold-color) 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(218, 165, 32, 0.4);
        color: var(--white);
    }

    .service-btn i {
        margin-left: 8px;
        transition: transform 0.3s ease;
    }

    .service-btn:hover i {
        transform: translateX(3px);
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #666;
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--gold-color);
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: var(--burgundy-color);
        margin-bottom: 10px;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        margin-bottom: 60px;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .services-grid {
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .services-hero {
            padding: 60px 0;
            margin-bottom: 40px;
        }

        .services-grid {
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 40px;
        }

        .service-image {
            height: 200px;
        }

        .card-body {
            padding: 20px;
            height: calc(100% - 200px);
        }

        .services-container {
            padding: 0 10px;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 2rem;
        }

        .services-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .service-card {
            border-radius: 15px;
        }

        .service-image {
            height: 180px;
        }

        .card-body {
            padding: 15px;
            height: calc(100% - 180px);
        }

        .service-title {
            font-size: 1.3rem;
        }
    }

    /* Loading animation for images */
    .service-image[loading] {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% {
            background-position: 200% 0;
        }

        100% {
            background-position: -200% 0;
        }
    }
</style>

<!-- Hero Section -->
<div class="services-hero">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="hero-title"><?= esc($title) ?></h1>
            <p class="hero-subtitle">
                Temukan pengalaman perawatan yang tak terlupakan dengan layanan profesional kami.
                Setiap treatment dirancang khusus untuk memberikan hasil terbaik dan kepuasan optimal.
            </p>
        </div>
    </div>
</div>

<!-- Services Section -->
<div class="services-container">
    <?php if (!empty($layanan)): ?>
        <div class="services-grid">
            <?php foreach ($layanan as $l): ?>
                <div class="service-card">
                    <div class="position-relative overflow-hidden">
                        <img src="/uploads/layanan/<?= esc($l['gambar_sampul'] ?? 'placeholder.jpg') ?>"
                            class="service-image"
                            alt="<?= esc($l['nama_layanan']) ?>"
                            loading="lazy"
                            onerror="this.src='/assets/images/placeholder-service.jpg'">
                        <div class="image-overlay"></div>
                    </div>

                    <div class="card-body">
                        <h5 class="service-title"><?= esc($l['nama_layanan']) ?></h5>

                        <div class="service-price">
                            <i class="fas fa-tag"></i>
                            <?php if (!empty($l['harga_mulai'])): ?>
                                Mulai dari Rp <?= number_format($l['harga_mulai'], 0, ',', '.') ?>
                            <?php else: ?>
                                Konsultasi untuk harga
                            <?php endif; ?>
                        </div>

                        <p class="service-description">
                            <?= esc(word_limiter($l['deskripsi'], 20)) ?>
                        </p>

                        <a href="/layanan/<?= $l['id'] ?>" class="service-btn">
                            Lihat Detail & Paket
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-spa"></i>
            <h3>Layanan Akan Segera Hadir</h3>
            <p>Kami sedang mempersiapkan berbagai layanan menarik untuk Anda. Silakan kembali lagi nanti.</p>
        </div>
    <?php endif; ?>
</div>

<!-- Add FontAwesome if not already included -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add loading animation to images
        const images = document.querySelectorAll('.service-image');
        images.forEach(img => {
            if (!img.complete) {
                img.setAttribute('loading', 'true');
                img.addEventListener('load', function() {
                    img.removeAttribute('loading');
                });
            }
        });

        // Add smooth scroll behavior
        const serviceButtons = document.querySelectorAll('.service-btn');
        serviceButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                // Add subtle click animation
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    });
</script>

<?= $this->endSection() ?>