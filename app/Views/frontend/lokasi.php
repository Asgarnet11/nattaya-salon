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
                    <h3 class="text-white fw-semibold mb-0">
                        <i class="fas fa-map-marked-alt me-2 text-gold"></i>
                        Peta Lokasi Kami
                    </h3>
                    <p class="text-white-50 mb-0">Temukan cabang terdekat dengan Anda</p>
                </div>
                <div class="map-wrapper">
                    <div class="ratio ratio-16x9">
                        <!-- Updated embed with multiple Nattaya Salon locations in Kendari -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d31838.213851036262!2d122.49330085!3d-3.9984990499999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sNattaya%20Salon%20Kendari!5e0!3m2!1sid!2sid!4v1699000000000!5m2!1sid!2sid"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="map-iframe"
                            title="Lokasi Nattaya Salon Kendari"></iframe>
                    </div>
                    <div class="map-loading-overlay" id="mapLoading">
                        <div class="loading-spinner"></div>
                        <p class="mt-3 text-muted">Memuat peta lokasi...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Branch Locations -->
    <?php if (!empty($cabang) && is_array($cabang)): ?>
        <div class="branches-section">
            <div class="text-center mb-5">
                <h2 class="playfair-display text-burgundy fw-bold mb-3">Lokasi Cabang Kami</h2>
                <p class="text-muted">Pilih cabang yang paling dekat dengan Anda untuk pengalaman terbaik</p>
            </div>

            <div class="row g-4">
                <?php foreach ($cabang as $index => $c): ?>
                    <?php if (is_array($c) && !empty($c['nama_cabang'])): ?>
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
                                        <?php if (!empty($c['alamat'])): ?>
                                            <div class="info-item mb-3">
                                                <div class="info-icon">
                                                    <i class="fas fa-map-marker-alt text-gold"></i>
                                                </div>
                                                <div class="info-content">
                                                    <strong class="text-dark">Alamat</strong>
                                                    <p class="text-muted mb-0"><?= esc($c['alamat']) ?></p>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($c['no_telepon'])): ?>
                                            <div class="info-item mb-3">
                                                <div class="info-icon">
                                                    <i class="fas fa-phone text-burgundy"></i>
                                                </div>
                                                <div class="info-content">
                                                    <strong class="text-dark">Telepon</strong>
                                                    <p class="text-muted mb-0">
                                                        <a href="tel:<?= esc(preg_replace('/[^0-9+]/', '', $c['no_telepon'])) ?>"
                                                            class="text-decoration-none text-muted hover-burgundy">
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
                                                <p class="text-muted mb-0">
                                                    <?= !empty($c['jam_operasional']) ? esc($c['jam_operasional']) : 'Senin - Minggu: 09.00 - 21.00 WITA' ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="branch-footer">
                                    <div class="d-grid gap-2">
                                        <a href="<?= base_url('booking') ?>" class="btn btn-burgundy fw-medium">
                                            <i class="fas fa-calendar-plus me-2"></i>
                                            Booking di Cabang Ini
                                        </a>
                                        <?php if (!empty($c['no_telepon'])): ?>
                                            <a href="tel:<?= esc(preg_replace('/[^0-9+]/', '', $c['no_telepon'])) ?>"
                                                class="btn btn-outline-gold fw-medium">
                                                <i class="fas fa-phone me-2"></i>
                                                Hubungi Langsung
                                            </a>
                                        <?php endif; ?>
                                        <?php if (!empty($c['maps_url'])): ?>
                                            <a href="<?= esc($c['maps_url']) ?>"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="btn btn-outline-secondary fw-medium">
                                                <i class="fas fa-directions me-2"></i>
                                                Petunjuk Arah
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
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
                        <h3 class="text-burgundy fw-bold"><?= count(array_filter($cabang, function ($c) {
                                                                return is_array($c) && !empty($c['nama_cabang']);
                                                            })) ?></h3>
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
                    <div class="d-flex gap-2 justify-content-center flex-wrap">
                        <a href="<?= base_url('/') ?>" class="btn btn-burgundy">
                            <i class="fas fa-home me-2"></i>
                            Kembali ke Beranda
                        </a>
                        <a href="<?= base_url('contact') ?>" class="btn btn-outline-gold">
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
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS with error handling
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                once: true,
                offset: 50,
                disable: 'mobile' // Disable on mobile for better performance
            });
        }

        // Enhanced map loading functionality
        const mapWrapper = document.querySelector('.map-wrapper');
        const iframe = mapWrapper?.querySelector('iframe');
        const loadingOverlay = document.getElementById('mapLoading');

        if (iframe && loadingOverlay) {
            // Show loading state
            loadingOverlay.style.display = 'flex';

            // Handle successful load
            iframe.addEventListener('load', function() {
                setTimeout(function() {
                    loadingOverlay.style.opacity = '0';
                    setTimeout(function() {
                        loadingOverlay.style.display = 'none';
                        mapWrapper.classList.add('loaded');
                    }, 300);
                }, 500); // Small delay to ensure map is fully rendered
            });

            // Handle load error
            iframe.addEventListener('error', function() {
                loadingOverlay.innerHTML = `
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                        <p class="text-muted">Gagal memuat peta. <a href="#" onclick="location.reload()" class="text-burgundy">Muat ulang halaman</a></p>
                    </div>
                `;
            });

            // Fallback timeout for slow connections
            setTimeout(function() {
                if (loadingOverlay.style.display !== 'none') {
                    loadingOverlay.style.opacity = '0';
                    setTimeout(function() {
                        loadingOverlay.style.display = 'none';
                        mapWrapper.classList.add('loaded');
                    }, 300);
                }
            }, 10000); // 10 second timeout
        }

        // Enhanced phone number click tracking
        document.querySelectorAll('a[href^="tel:"]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                // Basic analytics tracking could be added here
                console.log('Phone number clicked:', this.href);
            });
        });

        // Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add intersection observer for branch cards
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            document.querySelectorAll('.branch-card').forEach(function(card) {
                observer.observe(card);
            });
        }
    });

    // Add error handling for external resources
    window.addEventListener('error', function(e) {
        if (e.target.tagName === 'LINK' && e.target.href.includes('aos')) {
            console.warn('AOS library failed to load, animations disabled');
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
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Color utilities */
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

    .hover-burgundy:hover {
        color: var(--burgundy) !important;
        transition: var(--transition);
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
        transition: var(--transition);
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
        min-height: 400px;
    }

    .map-loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.95);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 10;
        transition: opacity 0.3s ease;
    }

    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 3px solid var(--burgundy-light);
        border-top: 3px solid var(--gold);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .map-iframe {
        border: none;
        transition: var(--transition);
        width: 100%;
        height: 100%;
    }

    .map-wrapper.loaded .map-iframe {
        opacity: 1;
    }

    /* Branch Cards */
    .branch-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: var(--transition);
        overflow: hidden;
        position: relative;
        opacity: 0.8;
        transform: translateY(20px);
    }

    .branch-card.animate-in {
        opacity: 1;
        transform: translateY(0);
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
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
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
        box-shadow: 0 2px 8px rgba(255, 215, 0, 0.3);
    }

    .branch-content {
        padding: 2rem;
    }

    .branch-title {
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        line-height: 1.3;
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
        transition: var(--transition);
    }

    .info-item:hover .info-icon {
        background: rgba(128, 0, 32, 0.15);
        transform: scale(1.1);
    }

    .info-content strong {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .branch-footer {
        padding: 2rem;
        background: rgba(128, 0, 32, 0.02);
    }

    /* Enhanced Buttons */
    .btn {
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: var(--transition);
        border-width: 2px;
    }

    .btn-burgundy {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
        color: white;
    }

    .btn-burgundy:hover,
    .btn-burgundy:focus {
        background-color: var(--burgundy-dark);
        border-color: var(--burgundy-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(128, 0, 32, 0.3);
    }

    .btn-outline-gold {
        border-color: var(--gold-dark);
        color: var(--gold-dark);
        background: transparent;
    }

    .btn-outline-gold:hover,
    .btn-outline-gold:focus {
        background-color: var(--gold);
        border-color: var(--gold);
        color: #333;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.3);
    }

    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
    }

    .btn-outline-secondary:hover,
    .btn-outline-secondary:focus {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
        transform: translateY(-2px);
    }

    /* Stats Section */
    .stats-section {
        background: linear-gradient(135deg,
                rgba(128, 0, 32, 0.02),
                rgba(255, 215, 0, 0.02));
        border-radius: 20px;
        position: relative;
        overflow: hidden;
    }

    .stats-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--gold), transparent);
    }

    .stat-item {
        padding: 1rem;
        transition: var(--transition);
    }

    .stat-item:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        transition: var(--transition);
        margin: 0 auto;
    }

    .stat-item:hover .stat-icon {
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    /* Empty State */
    .empty-state {
        background: linear-gradient(135deg,
                rgba(255, 215, 0, 0.05),
                rgba(128, 0, 32, 0.05));
        border-radius: 20px;
        border: 2px dashed rgba(128, 0, 32, 0.2);
        transition: var(--transition);
    }

    .empty-state:hover {
        border-color: rgba(128, 0, 32, 0.3);
        background: linear-gradient(135deg,
                rgba(255, 215, 0, 0.08),
                rgba(128, 0, 32, 0.08));
    }

    /* Enhanced Responsiveness */
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

        .d-flex.gap-2.flex-wrap {
            gap: 0.5rem !important;
        }

        .d-flex.gap-2.flex-wrap .btn {
            flex: 1;
            min-width: 0;
        }

        .branch-card:hover {
            transform: translateY(-5px);
        }

        .map-wrapper {
            min-height: 300px;
        }
    }

    @media (max-width: 576px) {
        .branch-number {
            width: 35px;
            height: 35px;
            font-size: 0.75rem;
        }

        .branch-icon {
            font-size: 2rem;
        }

        .info-icon {
            width: 35px;
            height: 35px;
        }
    }

    /* Accessibility improvements */
    @media (prefers-reduced-motion: reduce) {

        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }

        .loading-spinner {
            animation: none;
        }
    }

    /* High contrast mode support */
    @media (prefers-contrast: high) {
        .branch-card {
            border: 2px solid var(--burgundy);
        }

        .btn-outline-gold,
        .btn-outline-secondary {
            border-width: 3px;
        }
    }

    /* Font enhancements */
    .playfair-display {
        font-family: 'Playfair Display', serif;
        letter-spacing: -0.5px;
        font-display: swap;
        /* Improve loading performance */
    }

    /* Focus styles for better accessibility */
    .btn:focus,
    a:focus {
        outline: 2px solid var(--gold);
        outline-offset: 2px;
    }

    /* Print styles */
    @media print {

        .map-container,
        .btn,
        .empty-state {
            display: none !important;
        }

        .branch-card {
            box-shadow: none;
            border: 1px solid #000;
            break-inside: avoid;
        }
    }
</style>

<?= $this->endSection() ?>