<?= $this->extend('frontend/layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4 py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <div class="header-decoration mx-auto mb-4"></div>
        <h1 class="playfair-display display-4 text-burgundy mb-3 fw-bold"><?= esc($title) ?></h1>
        <p class="lead text-muted mx-auto" style="max-width: 600px;">
            Lihat hasil karya terbaik dari para stylist profesional kami yang telah menciptakan transformasi menakjubkan
        </p>
        <div class="header-decoration mx-auto mt-4"></div>
    </div>

    <!-- Gallery Grid -->
    <?php if (!empty($galeri)): ?>
        <div class="row g-4" id="galleryGrid">
            <?php foreach ($galeri as $index => $g): ?>
                <div class="col-lg-4 col-md-6 gallery-item" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                    <div class="gallery-card">
                        <div class="image-container">
                            <a href="/uploads/gallery/<?= esc($g['nama_file']) ?>"
                                data-toggle="lightbox"
                                data-gallery="gallery"
                                data-title="<?= esc($g['judul']) ?>">
                                <img src="/uploads/gallery/<?= esc($g['nama_file']) ?>"
                                    class="gallery-image"
                                    alt="<?= esc($g['judul']) ?>"
                                    loading="lazy">
                                <div class="image-overlay">
                                    <div class="overlay-content">
                                        <i class="fas fa-search-plus fa-2x text-white mb-2"></i>
                                        <p class="text-white mb-0 fw-medium"><?= esc($g['judul']) ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php if (!empty($g['judul'])): ?>
                            <div class="gallery-caption">
                                <h6 class="text-dark fw-semibold mb-0"><?= esc($g['judul']) ?></h6>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Load More Button (if needed) -->
        <div class="text-center mt-5">
            <div class="gallery-stats">
                <span class="badge bg-burgundy px-3 py-2 me-2">
                    <i class="fas fa-images me-1"></i>
                    <?= count($galeri) ?> Karya
                </span>
                <span class="badge bg-gold text-dark px-3 py-2">
                    <i class="fas fa-star me-1"></i>
                    Koleksi Terbaik
                </span>
            </div>
        </div>
    <?php else: ?>
        <!-- Empty State -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="empty-state text-center py-5">
                    <div class="empty-icon mb-4">
                        <i class="fas fa-images fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">Galeri Sedang Dipersiapkan</h4>
                    <p class="text-muted mb-4">
                        Kami sedang menyiapkan koleksi karya terbaik untuk Anda.
                        Kembali lagi nanti untuk melihat transformasi menakjubkan dari stylist profesional kami.
                    </p>
                    <a href="/" class="btn btn-burgundy px-4 py-2">
                        <i class="fas fa-home me-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- AOS Library -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<!-- Lightbox CSS & JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 50
    });

    // Initialize Lightbox
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true,
            showArrows: true
        });
    });

    // Masonry-like layout for better image arrangement
    window.addEventListener('load', function() {
        const grid = document.getElementById('galleryGrid');
        if (grid && window.innerWidth > 768) {
            // Simple responsive masonry effect
            const items = grid.querySelectorAll('.gallery-item');
            items.forEach((item, index) => {
                if (index % 3 === 1) {
                    item.style.marginTop = '2rem';
                } else if (index % 3 === 2) {
                    item.style.marginTop = '4rem';
                }
            });
        }
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

    .bg-gold {
        background-color: var(--gold) !important;
    }

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

    /* Header Decoration */
    .header-decoration {
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, var(--burgundy), var(--gold), var(--burgundy));
        border-radius: 2px;
    }

    /* Gallery Card Styles */
    .gallery-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        height: 100%;
    }

    .gallery-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(128, 0, 32, 0.15);
    }

    .image-container {
        position: relative;
        overflow: hidden;
        height: 300px;
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.4s ease;
    }

    .gallery-card:hover .gallery-image {
        transform: scale(1.05);
    }

    /* Image Overlay */
    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg,
                rgba(128, 0, 32, 0.9),
                rgba(255, 215, 0, 0.7));
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.4s ease;
    }

    .gallery-card:hover .image-overlay {
        opacity: 1;
    }

    .overlay-content {
        text-align: center;
        transform: translateY(20px);
        transition: all 0.4s ease;
    }

    .gallery-card:hover .overlay-content {
        transform: translateY(0);
    }

    .gallery-caption {
        padding: 1.5rem;
        background: white;
    }

    /* Gallery Stats */
    .gallery-stats {
        display: inline-flex;
        gap: 0.5rem;
        align-items: center;
    }

    .badge {
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 25px;
    }

    /* Empty State */
    .empty-state {
        background: linear-gradient(135deg,
                rgba(255, 215, 0, 0.05),
                rgba(128, 0, 32, 0.05));
        border-radius: 20px;
        border: 2px dashed rgba(128, 0, 32, 0.2);
    }

    .empty-icon {
        opacity: 0.6;
    }

    /* Playfair Display Enhancement */
    .playfair-display {
        font-family: 'Playfair Display', serif;
        letter-spacing: -0.5px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .display-4 {
            font-size: 2.5rem;
        }

        .image-container {
            height: 250px;
        }

        .gallery-card {
            margin-bottom: 1.5rem;
        }

        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .lead {
            font-size: 1rem;
        }
    }

    /* Lightbox Customization */
    .ekko-lightbox .modal-dialog {
        max-width: 90vw;
    }

    .ekko-lightbox .modal-content {
        background-color: rgba(0, 0, 0, 0.9);
        border: none;
    }

    .ekko-lightbox .close {
        color: white;
        font-size: 2rem;
        font-weight: 300;
        opacity: 0.8;
    }

    .ekko-lightbox .close:hover {
        opacity: 1;
    }

    /* Animation for gallery items */
    .gallery-item {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
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

    /* Staggered animation delays */
    .gallery-item:nth-child(1) {
        animation-delay: 0.1s;
    }

    .gallery-item:nth-child(2) {
        animation-delay: 0.2s;
    }

    .gallery-item:nth-child(3) {
        animation-delay: 0.3s;
    }

    .gallery-item:nth-child(4) {
        animation-delay: 0.4s;
    }

    .gallery-item:nth-child(5) {
        animation-delay: 0.5s;
    }

    .gallery-item:nth-child(6) {
        animation-delay: 0.6s;
    }
</style>

<?= $this->endSection() ?>