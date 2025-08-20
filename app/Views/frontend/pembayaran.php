<?= $this->extend('frontend/layout/template') ?>
<?= $this->section('content') ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <div class="payment-icon mb-4">
                    <i class="fas fa-credit-card fa-3x text-gold"></i>
                </div>
                <h1 class="playfair-display text-burgundy mb-3 fw-bold">Selesaikan Pembayaran Anda</h1>
                <div class="alert alert-warning border-gold" role="alert">
                    <i class="fas fa-clock me-2"></i>
                    <strong>Perhatian:</strong> Permintaan booking Anda telah kami terima. Silakan selesaikan pembayaran dalam <strong class="text-danger">1 jam</strong> untuk mengonfirmasi jadwal Anda.
                </div>
            </div>

            <!-- Payment Details Card -->
            <?php if (!empty($booking) && is_array($booking)): ?>
                <div class="card shadow-burgundy mb-4">
                    <div class="card-header bg-burgundy text-center py-4">
                        <h5 class="card-title text-white mb-0 fw-semibold">
                            <i class="fas fa-receipt me-2"></i>Detail Pembayaran
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <!-- Booking Summary -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-burgundy fw-bold mb-3">
                                    <i class="fas fa-user me-2"></i>Informasi Pemesan
                                </h6>
                                <p class="mb-2">
                                    <span class="fw-medium">Nama:</span>
                                    <?= esc($booking['nama_pelanggan'] ?? 'Tidak tersedia') ?>
                                </p>
                                <p class="mb-2">
                                    <span class="fw-medium">No. Telepon:</span>
                                    <?= esc($booking['no_telepon'] ?? 'Tidak tersedia') ?>
                                </p>
                                <?php if (!empty($booking['tanggal_booking'])): ?>
                                    <p class="mb-0">
                                        <span class="fw-medium">Tanggal:</span>
                                        <?= date('d F Y', strtotime($booking['tanggal_booking'])) ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-burgundy fw-bold mb-3">
                                    <i class="fas fa-spa me-2"></i>Detail Layanan
                                </h6>
                                <p class="mb-2">
                                    <span class="fw-medium">Layanan:</span>
                                    <?= esc($booking['nama_layanan'] ?? 'Tidak tersedia') ?>
                                </p>
                                <p class="mb-2">
                                    <span class="fw-medium">Paket:</span>
                                    <?= esc($booking['nama_paket'] ?? 'Tidak tersedia') ?>
                                </p>
                                <?php if (!empty($booking['jam_booking'])): ?>
                                    <p class="mb-0">
                                        <span class="fw-medium">Waktu:</span>
                                        <?= date('H:i', strtotime($booking['jam_booking'])) ?> WITA
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <hr class="border-gold">

                        <!-- Total Payment -->
                        <div class="text-center py-4">
                            <h5 class="text-burgundy fw-bold mb-2">Total Pembayaran</h5>
                            <?php if (!empty($booking['harga']) && is_numeric($booking['harga'])): ?>
                                <h1 class="display-3 fw-bold text-gold mb-0">
                                    Rp <?= number_format($booking['harga'], 0, ',', '.') ?>
                                </h1>
                            <?php else: ?>
                                <h1 class="display-3 fw-bold text-danger mb-0">
                                    Harga tidak tersedia
                                </h1>
                            <?php endif; ?>
                        </div>

                        <hr class="border-gold">

                        <!-- Bank Details -->
                        <div class="bank-details p-4 bg-light rounded-3 mt-4">
                            <h6 class="text-burgundy fw-bold mb-3 text-center">
                                <i class="fas fa-university me-2"></i>Informasi Transfer Bank
                            </h6>
                            <div class="row text-center">
                                <div class="col-md-4 mb-3">
                                    <div class="bank-info p-3 border rounded h-100">
                                        <i class="fas fa-building-columns fa-2x text-burgundy mb-2"></i>
                                        <h6 class="fw-bold text-burgundy">Bank BCA</h6>
                                        <p class="mb-0 small text-muted">Bank Transfer</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bank-info p-3 border rounded h-100">
                                        <i class="fas fa-hashtag fa-2x text-gold mb-2"></i>
                                        <h6 class="fw-bold text-dark">1234-567-890</h6>
                                        <p class="mb-0 small text-muted">Nomor Rekening</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="bank-info p-3 border rounded h-100">
                                        <i class="fas fa-user-tie fa-2x text-burgundy mb-2"></i>
                                        <h6 class="fw-bold text-dark">Nattaya Salon Kendari</h6>
                                        <p class="mb-0 small text-muted">Atas Nama</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Instructions -->
                        <div class="alert alert-info border-0 mt-4" role="alert">
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-info-circle me-2"></i>Petunjuk Pembayaran
                            </h6>
                            <ol class="mb-0 ps-3">
                                <li class="mb-2">Transfer sesuai dengan nominal yang tertera <strong>tanpa membulatkan</strong></li>
                                <li class="mb-2">Simpan bukti transfer dari bank/e-wallet Anda</li>
                                <li class="mb-2">Klik tombol "Konfirmasi Pembayaran" di bawah ini</li>
                                <li class="mb-0">Upload foto bukti transfer yang jelas dan lengkap</li>
                            </ol>
                        </div>

                        <!-- Action Button -->
                        <div class="text-center mt-4">
                            <?php if (!empty($booking['id']) && is_numeric($booking['id'])): ?>
                                <a href="<?= base_url('konfirmasi-pembayaran/' . $booking['id']) ?>"
                                    class="btn btn-gold btn-lg px-5 py-3 fw-bold">
                                    <i class="fas fa-upload me-2"></i>Konfirmasi Pembayaran Sekarang
                                </a>
                                <div class="mt-3">
                                    <a href="<?= base_url('booking/history') ?>"
                                        class="btn btn-outline-burgundy btn-sm">
                                        <i class="fas fa-history me-2"></i>Lihat Riwayat Booking
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-danger" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Error:</strong> ID Booking tidak valid. Silakan hubungi customer service.
                                </div>
                                <a href="<?= base_url() ?>" class="btn btn-outline-burgundy">
                                    <i class="fas fa-home me-2"></i>Kembali ke Beranda
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card border-burgundy h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-headset fa-2x text-burgundy mb-3"></i>
                                <h6 class="fw-bold text-burgundy">Butuh Bantuan?</h6>
                                <p class="small text-muted mb-3">Tim customer service kami siap membantu Anda</p>
                                <a href="https://wa.me/628123456789" class="btn btn-outline-burgundy btn-sm">
                                    <i class="fab fa-whatsapp me-1"></i>WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card border-gold h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-shield-alt fa-2x text-gold mb-3"></i>
                                <h6 class="fw-bold text-burgundy">Pembayaran Aman</h6>
                                <p class="small text-muted mb-3">Transaksi Anda dilindungi dengan sistem keamanan terbaik</p>
                                <span class="badge bg-success">
                                    <i class="fas fa-lock me-1"></i>SSL Secured
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <!-- Error State -->
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-4"></i>
                        <h4 class="text-danger mb-3">Data Booking Tidak Ditemukan</h4>
                        <p class="text-muted mb-4">Maaf, kami tidak dapat menemukan data booking Anda. Silakan coba lagi atau hubungi customer service.</p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="<?= base_url() ?>" class="btn btn-burgundy">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                            <a href="<?= base_url('booking') ?>" class="btn btn-outline-burgundy">
                                <i class="fas fa-calendar-plus me-2"></i>Booking Baru
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    :root {
        --burgundy: #800020;
        --burgundy-dark: #660019;
        --burgundy-light: #a6002b;
        --gold: #FFD700;
        --gold-dark: #B8860B;
        --gold-light: #FFDF00;
    }

    .bg-burgundy {
        background: linear-gradient(135deg, var(--burgundy) 0%, var(--burgundy-dark) 100%) !important;
    }

    .text-burgundy {
        color: var(--burgundy) !important;
    }

    .text-gold {
        color: var(--gold) !important;
    }

    .border-burgundy {
        border-color: var(--burgundy) !important;
    }

    .border-gold {
        border-color: var(--gold) !important;
    }

    .btn-burgundy {
        background: linear-gradient(135deg, var(--burgundy) 0%, var(--burgundy-dark) 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px 25px;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .btn-burgundy:hover {
        background: linear-gradient(135deg, var(--burgundy-dark) 0%, var(--burgundy) 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(128, 0, 32, 0.4);
    }

    .shadow-burgundy {
        box-shadow: 0 15px 35px rgba(128, 0, 32, 0.15) !important;
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .playfair-display {
        font-family: 'Playfair Display', serif;
    }

    .payment-icon {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    .card-header {
        border-bottom: 3px solid var(--gold);
    }

    .btn-gold {
        background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
        border: none;
        color: var(--burgundy);
        font-weight: 700;
        border-radius: 50px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-gold::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .btn-gold:hover::before {
        left: 100%;
    }

    .btn-gold:hover {
        background: linear-gradient(135deg, var(--gold-dark) 0%, var(--gold) 100%);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(255, 215, 0, 0.5);
    }

    .btn-outline-burgundy {
        border: 2px solid var(--burgundy);
        color: var(--burgundy);
        background: transparent;
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-burgundy:hover {
        background: var(--burgundy);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(128, 0, 32, 0.3);
    }

    .bank-details {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
        border: 2px solid var(--gold);
    }

    .bank-info {
        transition: all 0.3s ease;
        background: white;
    }

    .bank-info:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-color: var(--burgundy) !important;
    }

    .alert {
        border-radius: 15px;
        border: none;
        padding: 20px 25px;
    }

    .alert-warning {
        background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
        border: 2px solid var(--gold);
        color: #856404;
    }

    .alert-info {
        background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
        color: #0c5460;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c2c7 100%);
        color: #842029;
    }

    .display-3 {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .fas,
    .fab {
        transition: all 0.3s ease;
    }

    .card:hover .fas,
    .card:hover .fab {
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        .display-3 {
            font-size: 2.5rem;
        }

        .btn-lg {
            padding: 15px 30px;
            font-size: 1.1rem;
        }

        .card-body {
            padding: 2rem;
        }

        .bank-info {
            margin-bottom: 1rem;
        }
    }

    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }

    /* Copy to clipboard animation */
    .copy-success {
        animation: copyFlash 0.5s ease-in-out;
    }

    @keyframes copyFlash {

        0%,
        100% {
            background-color: transparent;
        }

        50% {
            background-color: var(--gold);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Copy bank account number to clipboard
        const accountNumber = document.querySelector('.bank-info h6:contains("1234-567-890")');
        if (accountNumber) {
            accountNumber.style.cursor = 'pointer';
            accountNumber.title = 'Klik untuk copy nomor rekening';

            accountNumber.addEventListener('click', function() {
                navigator.clipboard.writeText('1234567890').then(function() {
                    accountNumber.classList.add('copy-success');
                    setTimeout(() => {
                        accountNumber.classList.remove('copy-success');
                    }, 500);

                    // Show toast notification (if you have toast library)
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Copied!',
                            text: 'Nomor rekening berhasil disalin',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        alert('Nomor rekening berhasil disalin!');
                    }
                }).catch(function(err) {
                    console.error('Gagal copy: ', err);
                });
            });
        }

        // Countdown timer (optional enhancement)
        const startCountdown = (duration) => {
            const alertElement = document.querySelector('.alert-warning strong');
            if (!alertElement) return;

            let timer = duration;
            const countdownInterval = setInterval(() => {
                const hours = Math.floor(timer / 3600);
                const minutes = Math.floor((timer % 3600) / 60);
                const seconds = timer % 60;

                alertElement.textContent = `${hours}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                if (--timer < 0) {
                    clearInterval(countdownInterval);
                    alertElement.textContent = 'Waktu habis';
                    alertElement.parentElement.classList.replace('alert-warning', 'alert-danger');
                }
            }, 1000);
        };

        // Start 1 hour countdown (3600 seconds)
        // startCountdown(3600);
    });
</script>
<?= $this->endSection() ?>