<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-burgundy-light text-white me-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-1 fw-medium">Booking Pending</h6>
                            <h3 class="mb-0 fw-bold text-burgundy"><?= $jumlahBookingPending ?></h3>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="/admin/booking" class="btn btn-outline-burgundy btn-sm fw-medium w-100">
                            <i class="fas fa-eye me-1"></i>
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-gold text-dark me-3">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-1 fw-medium">Booking Hari Ini</h6>
                            <h3 class="mb-0 fw-bold text-dark"><?= $jumlahBookingHariIni ?></h3>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="/admin/booking" class="btn btn-outline-gold btn-sm fw-medium w-100">
                            <i class="fas fa-eye me-1"></i>
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-burgundy text-white me-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-1 fw-medium">Total Pelanggan</h6>
                            <h3 class="mb-0 fw-bold text-burgundy"><?= $jumlahPelanggan ?></h3>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-user-check me-1"></i>
                            Terdaftar di sistem
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-gold-dark text-white me-3">
                            <i class="fas fa-concierge-bell"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-title text-muted mb-1 fw-medium">Total Layanan</h6>
                            <h3 class="mb-0 fw-bold text-dark"><?= $jumlahLayanan ?></h3>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="/admin/layanan" class="btn btn-outline-gold-dark btn-sm fw-medium w-100">
                            <i class="fas fa-list me-1"></i>
                            Lihat Layanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Recent Bookings -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-burgundy text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-list-ul me-2"></i>
                        Booking Terbaru (Pending)
                    </h5>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($bookingTerbaru)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <tbody>
                                    <?php foreach ($bookingTerbaru as $booking): ?>
                                        <tr class="border-bottom">
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle bg-burgundy-light text-white me-3">
                                                        <?= strtoupper(substr($booking['nama_lengkap'], 0, 1)) ?>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold text-dark"><?= esc($booking['nama_lengkap']) ?></div>
                                                        <small class="text-muted">
                                                            <i class="fas fa-calendar me-1"></i>
                                                            <?= date('d M Y, H:i', strtotime($booking['tanggal_booking'] . ' ' . $booking['jam_booking'])) ?>
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-end">
                                                <a href="/admin/booking/<?= $booking['id'] ?>/edit"
                                                    class="btn btn-outline-burgundy btn-sm fw-medium">
                                                    <i class="fas fa-cog me-1"></i>
                                                    Kelola
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-check fa-2x text-muted mb-3"></i>
                            <p class="text-muted mb-0">Tidak ada booking pending</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-gold text-dark py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-chart-bar me-2"></i>
                        Grafik Booking 7 Hari Terakhir
                    </h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="bookingChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('bookingChart');
    const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(128, 0, 32, 0.8)');
    gradient.addColorStop(1, 'rgba(128, 0, 32, 0.1)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= $chartLabels ?>,
            datasets: [{
                label: 'Jumlah Booking',
                data: <?= $chartData ?>,
                backgroundColor: gradient,
                borderColor: '#800020',
                borderWidth: 2,
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        color: '#6c757d',
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6c757d',
                        font: {
                            size: 12
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#800020',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#ffd700',
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: false
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
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

    .bg-burgundy {
        background-color: var(--burgundy) !important;
    }

    .bg-burgundy-light {
        background-color: var(--burgundy-light) !important;
    }

    .bg-gold {
        background-color: var(--gold) !important;
    }

    .bg-gold-dark {
        background-color: var(--gold-dark) !important;
    }

    .text-burgundy {
        color: var(--burgundy) !important;
    }

    .text-gold {
        color: var(--gold-dark) !important;
    }

    .btn-outline-burgundy {
        border-color: var(--burgundy);
        color: var(--burgundy);
        transition: all 0.3s ease;
    }

    .btn-outline-burgundy:hover {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(128, 0, 32, 0.2);
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
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(255, 215, 0, 0.3);
    }

    .btn-outline-gold-dark {
        border-color: var(--gold-dark);
        color: var(--gold-dark);
        transition: all 0.3s ease;
    }

    .btn-outline-gold-dark:hover {
        background-color: var(--gold-dark);
        border-color: var(--gold-dark);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(218, 165, 32, 0.3);
    }

    .stat-card {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
        border-left-color: var(--gold);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        font-weight: 600;
        flex-shrink: 0;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(255, 215, 0, 0.05);
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
    }

    /* Animation for stats */
    .stat-card .card-body {
        animation: slideInUp 0.6s ease-out;
    }

    .stat-card:nth-child(1) .card-body {
        animation-delay: 0.1s;
    }

    .stat-card:nth-child(2) .card-body {
        animation-delay: 0.2s;
    }

    .stat-card:nth-child(3) .card-body {
        animation-delay: 0.3s;
    }

    .stat-card:nth-child(4) .card-body {
        animation-delay: 0.4s;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .stat-card .btn {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .avatar-circle {
            width: 35px;
            height: 35px;
            font-size: 0.75rem;
        }
    }
</style>

<?= $this->endSection() ?>