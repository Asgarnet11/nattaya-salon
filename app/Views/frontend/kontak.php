<?= $this->extend('frontend/layout/template') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="playfair-display fw-light mb-3"><?= esc($title) ?></h1>
        <p class="lead text-muted">Kami siap melayani Anda dengan sepenuh hati. Kunjungi salon kami atau hubungi untuk informasi lebih lanjut.</p>
    </div>

    <div class="row g-5">
        <!-- Contact Information -->
        <div class="col-lg-6">
            <div class="contact-info h-100">
                <h3 class="playfair-display mb-4 text-primary">Informasi Kontak</h3>

                <div class="contact-item mb-4">
                    <h5 class="fw-semibold text-dark">Nattaya Salon Kendari</h5>
                    <div class="mt-3">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-3 mt-1"></i>
                            <div>
                                <p class="mb-0">Jl. Jenderal Ahmad Yani No. 123</p>
                                <p class="mb-0">Wua-Wua, Kendari</p>
                                <p class="mb-0">Sulawesi Tenggara</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-phone text-primary me-3"></i>
                            <span>(0401) 123-456</span>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-envelope text-primary me-3"></i>
                            <a href="mailto:info@nattayasalon.com" class="text-decoration-none">info@nattayasalon.com</a>
                        </div>

                        <div class="d-flex align-items-start">
                            <i class="fas fa-clock text-primary me-3 mt-1"></i>
                            <div>
                                <p class="mb-1 fw-semibold">Jam Operasional:</p>
                                <p class="mb-0">Setiap Hari</p>
                                <p class="mb-0">09:00 - 21:00 WITA</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Contact Options -->
                <div class="border-top pt-4">
                    <h6 class="fw-semibold mb-3">Cara Lain Menghubungi Kami:</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-outline-primary btn-sm">WhatsApp</a>
                        <a href="#" class="btn btn-outline-primary btn-sm">Instagram</a>
                        <a href="#" class="btn btn-outline-primary btn-sm">Facebook</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="col-lg-6">
            <div class="map-container h-100">
                <h3 class="playfair-display mb-4 text-primary">Lokasi Kami</h3>
                <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15919.10692518131!2d122.51330085!3d-3.99849905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2da1111111111111%3A0x1111111111111111!2sKendari%2C%20Kota%20Kendari%2C%20Sulawesi%20Tenggara!5e0!3m2!1sid!2sid!4v1628181818181!5m2!1sid!2sid"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <p class="text-muted mt-3 small">
                    <i class="fas fa-info-circle me-2"></i>
                    Lokasi strategis di pusat kota Kendari dengan akses mudah dan parkir yang luas.
                </p>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="bg-light rounded-3 p-4 text-center">
                <h4 class="playfair-display mb-3">Siap untuk Tampil Lebih Cantik?</h4>
                <p class="mb-3">Reservasi sekarang untuk mendapatkan layanan terbaik dari tim profesional kami.</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="tel:(0401)123-456" class="btn btn-primary">Hubungi Sekarang</a>
                    <a href="<?= base_url('booking') ?>" class="btn btn-outline-primary">Buat Reservasi</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>