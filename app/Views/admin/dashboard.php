<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Booking Pending</h5>
                <p class="card-text fs-2 fw-bold"><?= $jumlahBookingPending ?></p>
                <a href="/admin/booking" class="card-link">Lihat Detail</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Booking Hari Ini</h5>
                <p class="card-text fs-2 fw-bold"><?= $jumlahBookingHariIni ?></p>
                <a href="/admin/booking" class="card-link">Lihat Detail</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Total Pelanggan</h5>
                <p class="card-text fs-2 fw-bold"><?= $jumlahPelanggan ?></p>
                <small class="text-muted">Terdaftar di sistem</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Total Layanan</h5>
                <p class="card-text fs-2 fw-bold"><?= $jumlahLayanan ?></p>
                <a href="/admin/layanan" class="card-link">Lihat Layanan</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-7 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header">
                Booking Terbaru (Pending)
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <tbody>
                        <?php foreach ($bookingTerbaru as $booking): ?>
                            <tr>
                                <td><?= esc($booking['nama_lengkap']) ?></td>
                                <td><?= date('d M Y, H:i', strtotime($booking['tanggal_booking'] . ' ' . $booking['jam_booking'])) ?></td>
                                <td><a href="/admin/booking/<?= $booking['id'] ?>/edit" class="btn btn-sm btn-outline-primary">Kelola</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header">Grafik Booking 7 Hari Terakhir</div>
            <div class="card-body">
                <canvas id="bookingChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('bookingChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= $chartLabels ?>,
            datasets: [{
                label: '# Jumlah Booking',
                data: <?= $chartData ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>