<?= $this->extend('frontend/layout/template') ?>
<?= $this->section('content') ?>
<div class="container my-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <div class="history-icon mb-4">
            <i class="fas fa-history fa-3x text-gold"></i>
        </div>
        <h1 class="playfair-display text-burgundy fw-bold mb-3">
            <?= esc($title ?? 'Riwayat Booking Anda') ?>
        </h1>
        <p class="lead text-muted">Berikut adalah daftar semua janji temu yang pernah Anda buat di Nattaya Salon.</p>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Berhasil!</strong> <?= esc(session()->getFlashdata('success')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Error!</strong> <?= esc(session()->getFlashdata('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Booking History Card -->
    <div class="card shadow-burgundy">
        <div class="card-header bg-burgundy py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title text-white mb-0 fw-semibold">
                    <i class="fas fa-calendar-alt me-2"></i>Riwayat Booking
                </h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-light btn-sm" id="refreshBtn">
                        <i class="fas fa-sync-alt me-1"></i>Refresh
                    </button>
                    <a href="<?= base_url('booking') ?>" class="btn btn-gold btn-sm">
                        <i class="fas fa-plus me-1"></i>Booking Baru
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <?php if (!empty($riwayat) && is_array($riwayat)): ?>
                <!-- Statistics Cards -->
                <div class="stats-section p-4 bg-light border-bottom">
                    <?php
                    $stats = [
                        'total' => count($riwayat),
                        'completed' => 0,
                        'pending' => 0,
                        'waiting' => 0
                    ];

                    foreach ($riwayat as $item) {
                        switch ($item['status'] ?? '') {
                            case 'completed':
                                $stats['completed']++;
                                break;
                            case 'waiting_payment':
                            case 'waiting_verification':
                                $stats['waiting']++;
                                break;
                            case 'confirmed':
                            case 'pending':
                                $stats['pending']++;
                                break;
                        }
                    }
                    ?>
                    <div class="row text-center">
                        <div class="col-3">
                            <div class="stat-card">
                                <i class="fas fa-calendar-check fa-2x text-burgundy mb-2"></i>
                                <h4 class="fw-bold text-burgundy mb-0"><?= $stats['total'] ?></h4>
                                <small class="text-muted">Total Booking</small>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="stat-card">
                                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                <h4 class="fw-bold text-success mb-0"><?= $stats['completed'] ?></h4>
                                <small class="text-muted">Selesai</small>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="stat-card">
                                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                <h4 class="fw-bold text-warning mb-0"><?= $stats['pending'] ?></h4>
                                <small class="text-muted">Dalam Proses</small>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="stat-card">
                                <i class="fas fa-hourglass-half fa-2x text-info mb-2"></i>
                                <h4 class="fw-bold text-info mb-0"><?= $stats['waiting'] ?></h4>
                                <small class="text-muted">Menunggu</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="filter-section p-4 border-bottom">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-burgundy text-white">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control" id="searchInput" placeholder="Cari berdasarkan layanan, cabang, atau status...">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mt-md-0">
                            <div class="d-flex gap-2 justify-content-md-end">
                                <select class="form-select" id="statusFilter" style="width: auto;">
                                    <option value="">Semua Status</option>
                                    <option value="waiting_payment">Menunggu Pembayaran</option>
                                    <option value="waiting_verification">Verifikasi Bayar</option>
                                    <option value="confirmed">Dikonfirmasi</option>
                                    <option value="completed">Selesai</option>
                                    <option value="canceled">Dibatalkan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="bookingTable">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3 fw-semibold text-burgundy">
                                    <i class="fas fa-hashtag me-1"></i>No
                                </th>
                                <th class="px-4 py-3 fw-semibold text-burgundy">
                                    <i class="fas fa-calendar me-1"></i>Tanggal & Waktu
                                </th>
                                <th class="px-4 py-3 fw-semibold text-burgundy">
                                    <i class="fas fa-spa me-1"></i>Layanan & Paket
                                </th>
                                <th class="px-4 py-3 fw-semibold text-burgundy">
                                    <i class="fas fa-map-marker-alt me-1"></i>Cabang
                                </th>
                                <th class="px-4 py-3 fw-semibold text-burgundy">
                                    <i class="fas fa-info-circle me-1"></i>Status
                                </th>
                                <th class="px-4 py-3 fw-semibold text-burgundy text-center">
                                    <i class="fas fa-cogs me-1"></i>Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($riwayat as $item): ?>
                                <tr class="booking-row" data-status="<?= esc($item['status'] ?? '') ?>">
                                    <td class="px-4 py-3 fw-medium text-burgundy">
                                        <?= $no++ ?>
                                    </td>
                                    <td class="px-4 py-3">
                                        <?php if (!empty($item['tanggal_booking'])): ?>
                                            <div class="fw-medium text-dark">
                                                <?= date('d M Y', strtotime($item['tanggal_booking'])) ?>
                                            </div>
                                            <?php if (!empty($item['jam_booking'])): ?>
                                                <small class="text-muted d-block">
                                                    <i class="fas fa-clock me-1"></i>
                                                    <?= date('H:i', strtotime($item['jam_booking'])) ?> WITA
                                                </small>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="text-muted">Belum dijadwalkan</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="service-info">
                                            <strong class="text-dark d-block">
                                                <?= esc($item['nama_layanan'] ?? 'Layanan tidak tersedia') ?>
                                            </strong>
                                            <small class="text-muted d-block mt-1">
                                                <i class="fas fa-tag me-1"></i>
                                                <?= esc($item['nama_paket'] ?? 'Paket tidak tersedia') ?>
                                            </small>
                                            <?php if (!empty($item['harga']) && is_numeric($item['harga'])): ?>
                                                <small class="text-gold fw-medium d-block mt-1">
                                                    <i class="fas fa-money-bill-wave me-1"></i>
                                                    Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-light text-dark border">
                                            <i class="fas fa-building me-1"></i>
                                            <?= esc($item['nama_cabang'] ?? 'Cabang tidak tersedia') ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <?php
                                        $statusConfig = [
                                            'waiting_payment'      => ['class' => 'warning', 'text' => 'Menunggu Pembayaran', 'icon' => 'hourglass-half'],
                                            'waiting_verification' => ['class' => 'info', 'text' => 'Verifikasi Bayar', 'icon' => 'search'],
                                            'confirmed'            => ['class' => 'primary', 'text' => 'Dikonfirmasi', 'icon' => 'check-circle'],
                                            'completed'            => ['class' => 'success', 'text' => 'Selesai', 'icon' => 'check-double'],
                                            'canceled'             => ['class' => 'danger', 'text' => 'Dibatalkan', 'icon' => 'times-circle'],
                                            'cancelled'            => ['class' => 'danger', 'text' => 'Dibatalkan', 'icon' => 'times-circle'],
                                            'pending'              => ['class' => 'secondary', 'text' => 'Pending', 'icon' => 'clock']
                                        ];
                                        $currentStatus = $item['status'] ?? 'pending';
                                        $status = $statusConfig[$currentStatus] ?? ['class' => 'dark', 'text' => ucfirst($currentStatus), 'icon' => 'question'];
                                        ?>
                                        <span class="badge bg-<?= $status['class'] ?> px-3 py-2 fw-medium">
                                            <i class="fas fa-<?= $status['icon'] ?> me-1"></i>
                                            <?= $status['text'] ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="btn-group" role="group">
                                            <?php if (($item['status'] ?? '') === 'waiting_payment'): ?>
                                                <?php if (!empty($item['id']) && is_numeric($item['id'])): ?>
                                                    <a href="<?= base_url('konfirmasi-pembayaran/' . $item['id']) ?>"
                                                        class="btn btn-gold btn-sm fw-medium">
                                                        <i class="fas fa-credit-card me-1"></i>Bayar Sekarang
                                                    </a>
                                                <?php endif; ?>
                                            <?php elseif (($item['status'] ?? '') === 'waiting_verification'): ?>
                                                <?php if (!empty($item['id']) && is_numeric($item['id'])): ?>
                                                    <a href="<?= base_url('konfirmasi-pembayaran/' . $item['id']) ?>"
                                                        class="btn btn-outline-burgundy btn-sm">
                                                        <i class="fas fa-upload me-1"></i>Upload Bukti
                                                    </a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <button class="btn btn-outline-secondary btn-sm" disabled>
                                                    <i class="fas fa-check me-1"></i>Tidak ada aksi
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php else: ?>
                <!-- Empty State -->
                <div class="empty-state text-center py-5">
                    <div class="empty-icon mb-4">
                        <i class="fas fa-calendar-times fa-4x text-muted opacity-50"></i>
                    </div>
                    <h4 class="text-muted mb-3">Belum Ada Riwayat Booking</h4>
                    <p class="text-muted mb-4">
                        Anda belum memiliki riwayat booking. Mulai reservasi layanan favorit Anda sekarang!
                    </p>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="<?= base_url('booking') ?>" class="btn btn-gold btn-lg">
                            <i class="fas fa-plus me-2"></i>Buat Booking Pertama
                        </a>
                        <a href="<?= base_url('layanan') ?>" class="btn btn-outline-burgundy btn-lg">
                            <i class="fas fa-spa me-2"></i>Lihat Layanan
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quick Actions -->
    <?php if (!empty($riwayat)): ?>
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <div class="card border-burgundy h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-headset fa-2x text-burgundy mb-3"></i>
                        <h6 class="fw-bold text-burgundy">Butuh Bantuan?</h6>
                        <p class="small text-muted mb-3">Tim customer service kami siap membantu Anda 24/7</p>
                        <a href="https://wa.me/628123456789" class="btn btn-outline-burgundy btn-sm">
                            <i class="fab fa-whatsapp me-1"></i>WhatsApp Support
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card border-gold h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-star fa-2x text-gold mb-3"></i>
                        <h6 class="fw-bold text-burgundy">Berikan Review</h6>
                        <p class="small text-muted mb-3">Bagikan pengalaman Anda untuk membantu customer lain</p>
                        <a href="<?= base_url('review') ?>" class="btn btn-gold btn-sm">
                            <i class="fas fa-star me-1"></i>Tulis Review
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
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

    .shadow-burgundy {
        box-shadow: 0 15px 35px rgba(128, 0, 32, 0.15) !important;
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .playfair-display {
        font-family: 'Playfair Display', serif;
    }

    .history-icon {
        animation: rotate 4s linear infinite;
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .card-header {
        border-bottom: 3px solid var(--gold);
    }

    .btn-gold {
        background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
        border: none;
        color: var(--burgundy);
        font-weight: 600;
        border-radius: 25px;
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
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
    }

    .btn-outline-burgundy {
        border: 2px solid var(--burgundy);
        color: var(--burgundy);
        background: transparent;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-burgundy:hover {
        background: var(--burgundy);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(128, 0, 32, 0.3);
    }

    .stats-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
        border-bottom: 2px solid var(--gold) !important;
    }

    .stat-card {
        padding: 15px;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .filter-section {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .input-group-text.bg-burgundy {
        background: var(--burgundy) !important;
        border-color: var(--burgundy);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--burgundy);
        box-shadow: 0 0 0 0.2rem rgba(128, 0, 32, 0.15);
    }

    .table th {
        border-top: none;
        border-bottom: 2px solid var(--burgundy-light);
        font-size: 0.875rem;
        letter-spacing: 0.3px;
        background-color: #f8f9fa !important;
    }

    .table td {
        border-top: 1px solid #f1f3f4;
        border-bottom: none;
        vertical-align: middle;
        padding: 1rem;
    }

    .table-hover tbody tr:hover {
        background-color: #faf8f8;
        transform: scale(1.01);
        transition: all 0.2s ease;
    }

    .service-info {
        min-width: 200px;
    }

    .badge {
        font-size: 0.75rem;
        letter-spacing: 0.3px;
        border-radius: 20px;
        padding: 8px 12px;
    }

    .empty-state {
        padding: 4rem 2rem;
    }

    .empty-icon {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 0.5;
        }

        50% {
            opacity: 0.8;
        }
    }

    .alert {
        border-radius: 15px;
        border: none;
        padding: 15px 20px;
    }

    .alert-success {
        background: linear-gradient(135deg, #d1e7dd 0%, #badbcc 100%);
        color: #0f5132;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c2c7 100%);
        color: #842029;
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
        .stats-section .col-3 {
            flex: 0 0 50%;
            max-width: 50%;
            margin-bottom: 1rem;
        }

        .table-responsive {
            font-size: 0.875rem;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .service-info {
            min-width: auto;
        }
    }

    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }

    /* Loading animation for refresh button */
    .btn-refresh-loading {
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const bookingRows = document.querySelectorAll('.booking-row');
        const refreshBtn = document.getElementById('refreshBtn');

        // Search functionality
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                filterTable();
            });
        }

        // Status filter functionality
        if (statusFilter) {
            statusFilter.addEventListener('change', function() {
                filterTable();
            });
        }

        // Filter table function
        function filterTable() {
            const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
            const selectedStatus = statusFilter ? statusFilter.value : '';

            bookingRows.forEach(row => {
                const serviceText = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                const branchText = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                const statusText = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
                const rowStatus = row.getAttribute('data-status');

                const matchesSearch = !searchTerm ||
                    serviceText.includes(searchTerm) ||
                    branchText.includes(searchTerm) ||
                    statusText.includes(searchTerm);

                const matchesStatus = !selectedStatus || rowStatus === selectedStatus;

                if (matchesSearch && matchesStatus) {
                    row.style.display = '';
                    row.style.animation = 'fadeIn 0.3s ease-in';
                } else {
                    row.style.display = 'none';
                }
            });

            // Show/hide empty message
            const visibleRows = Array.from(bookingRows).filter(row => row.style.display !== 'none');
            const tableBody = document.querySelector('#bookingTable tbody');
            let emptyRow = document.querySelector('.no-results-row');

            if (visibleRows.length === 0 && (searchTerm || selectedStatus)) {
                if (!emptyRow) {
                    emptyRow = document.createElement('tr');
                    emptyRow.className = 'no-results-row';
                    emptyRow.innerHTML = `
                    <td colspan="6" class="text-center py-4">
                        <i class="fas fa-search fa-2x text-muted mb-2"></i>
                        <div>Tidak ada booking yang sesuai dengan kriteria pencarian.</div>
                    </td>
                `;
                    tableBody.appendChild(emptyRow);
                }
                emptyRow.style.display = '';
            } else if (emptyRow) {
                emptyRow.style.display = 'none';
            }
        }

        // Refresh button functionality
        if (refreshBtn) {
            refreshBtn.addEventListener('click', function() {
                const icon = this.querySelector('i');
                icon.classList.add('btn-refresh-loading');

                // Simulate refresh (in real app, this would reload data)
                setTimeout(() => {
                    icon.classList.remove('btn-refresh-loading');

                    // Reset filters
                    if (searchInput) searchInput.value = '';
                    if (statusFilter) statusFilter.value = '';
                    filterTable();

                    // Show success message
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil diperbarui',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }, 1000);
            });
        }

        // Auto dismiss alerts
        const alerts = document.querySelectorAll('.alert:not(.alert-dismissible)');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }, 5000);
        });

        // Add fade in animation
        const style = document.createElement('style');
        style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
        document.head.appendChild(style);
    });
</script>
<?= $this->endSection() ?>