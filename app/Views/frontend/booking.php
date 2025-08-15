<?= $this->extend('frontend/layout/template') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h1 class="playfair-display"><?= esc($title ?? 'Booking Salon') ?></h1>
                <p class="lead">Selamat datang, <strong><?= esc(session()->get('pelanggan_nama') ?? 'Pelanggan') ?>!</strong></p>
                <p>Silakan isi form di bawah ini untuk membuat janji temu.</p>
            </div>

            <!-- Alert Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>


            <div class="card shadow-sm border-0">
                <div class="card-header bg-burgundy text-white">
                    <h5 class="mb-0"><i class="bi bi-calendar-plus me-2"></i>Form Booking Salon</h5>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('/booking') ?>" method="post" id="bookingForm" novalidate>
                        <?= csrf_field() ?>

                        <div class="mb-4">
                            <label for="id_cabang" class="form-label fw-semibold">
                                <i class="bi bi-geo-alt-fill text-burgundy me-1"></i>Pilih Cabang
                                <span class="text-danger">*</span>
                            </label>
                            <select id="id_cabang" name="id_cabang" class="form-select" required>
                                <option value="">-- Pilih Lokasi Salon --</option>
                                <?php if (isset($cabang) && is_array($cabang)): ?>
                                    <?php foreach ($cabang as $c): ?>
                                        <option value="<?= esc($c['id']) ?>" <?= old('id_cabang') == $c['id'] ? 'selected' : '' ?>>
                                            <?= esc($c['nama_cabang']) ?>
                                            <?php if (isset($c['alamat'])): ?>
                                                - <?= esc($c['alamat']) ?>
                                            <?php endif; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="" disabled>Data cabang tidak tersedia</option>
                                <?php endif; ?>
                            </select>
                            <div class="invalid-feedback">Silakan pilih cabang salon.</div>
                        </div>

                        <div class="mb-4">
                            <label for="layanan" class="form-label fw-semibold">
                                <i class="bi bi-scissors text-burgundy me-1"></i>Pilih Layanan Utama
                                <span class="text-danger">*</span>
                            </label>
                            <select id="layanan" class="form-select" required>
                                <option value="">-- Pilih Jenis Perawatan --</option>
                                <?php if (isset($layanan) && is_array($layanan)): ?>
                                    <?php foreach ($layanan as $l): ?>
                                        <option value="<?= esc($l['id']) ?>" <?= old('layanan') == $l['id'] ? 'selected' : '' ?>>
                                            <?= esc($l['nama_layanan']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="" disabled>Data layanan tidak tersedia</option>
                                <?php endif; ?>
                            </select>
                            <div class="invalid-feedback">Silakan pilih layanan utama.</div>
                        </div>

                        <div class="mb-4">
                            <label for="paket" class="form-label fw-semibold">
                                <i class="bi bi-box-seam text-burgundy me-1"></i>Pilih Paket
                                <span class="text-danger">*</span>
                            </label>
                            <select id="paket" name="id_paket_layanan" class="form-select" required disabled>
                                <option value="">-- Pilih Layanan Utama Dulu --</option>
                            </select>
                            <div class="invalid-feedback">Silakan pilih paket layanan.</div>
                            <div class="form-text">
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Harga paket sudah termasuk semua fasilitas yang tercantum.
                                </small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="tanggal_booking" class="form-label fw-semibold">
                                    <i class="bi bi-calendar-date text-burgundy me-1"></i>Pilih Tanggal
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="date"
                                    class="form-control"
                                    id="tanggal_booking"
                                    name="tanggal_booking"
                                    value="<?= old('tanggal_booking') ?>"
                                    required>
                                <div class="invalid-feedback">Silakan pilih tanggal booking.</div>
                                <div class="form-text">
                                    <small class="text-muted">Minimal booking H+1 dari hari ini.</small>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="jam_booking" class="form-label fw-semibold">
                                    <i class="bi bi-clock text-burgundy me-1"></i>Pilih Jam
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="jam_booking" name="jam_booking" required>
                                    <option value="">-- Pilih Jam --</option>
                                    <option value="09:00" <?= old('jam_booking') == '09:00' ? 'selected' : '' ?>>09:00 WIB</option>
                                    <option value="10:00" <?= old('jam_booking') == '10:00' ? 'selected' : '' ?>>10:00 WIB</option>
                                    <option value="11:00" <?= old('jam_booking') == '11:00' ? 'selected' : '' ?>>11:00 WIB</option>
                                    <option value="13:00" <?= old('jam_booking') == '13:00' ? 'selected' : '' ?>>13:00 WIB</option>
                                    <option value="14:00" <?= old('jam_booking') == '14:00' ? 'selected' : '' ?>>14:00 WIB</option>
                                    <option value="15:00" <?= old('jam_booking') == '15:00' ? 'selected' : '' ?>>15:00 WIB</option>
                                    <option value="16:00" <?= old('jam_booking') == '16:00' ? 'selected' : '' ?>>16:00 WIB</option>
                                </select>
                                <div class="invalid-feedback">Silakan pilih jam booking.</div>
                                <div class="form-text">
                                    <small class="text-muted">Salon buka: 09:00 - 17:00 WIB</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="catatan" class="form-label fw-semibold">
                                <i class="bi bi-chat-left-text text-burgundy me-1"></i>Catatan Tambahan
                                <span class="text-muted">(Opsional)</span>
                            </label>
                            <textarea class="form-control"
                                id="catatan"
                                name="catatan"
                                rows="3"
                                placeholder="Tuliskan permintaan khusus atau catatan untuk stylist..."
                                maxlength="500"><?= old('catatan') ?></textarea>
                            <div class="form-text">
                                <small class="text-muted">Maksimal 500 karakter.</small>
                            </div>
                        </div>

                        <!-- Loading State -->
                        <div id="loadingState" class="text-center d-none mb-3">
                            <div class="spinner-border text-burgundy" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 text-muted">Sedang memproses booking Anda...</p>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <i class="bi bi-send-fill me-2"></i>Kirim Permintaan Booking
                            </button>
                        </div>

                        <div class="mt-3 text-center">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Booking akan dikonfirmasi melalui WhatsApp dalam 1x24 jam.
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --burgundy: #800020;
        --gold: #FFD700;
    }

    .bg-burgundy {
        background-color: var(--burgundy) !important;
    }

    .text-burgundy {
        color: var(--burgundy) !important;
    }

    .btn-primary {
        background-color: var(--gold);
        border-color: var(--gold);
        color: var(--burgundy);
        font-weight: 600;
    }

    .btn-primary:hover,
    .btn-primary:focus {
        background-color: #e6c200;
        border-color: #e6c200;
        color: var(--burgundy);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
    }

    .invalid-feedback {
        display: block;
    }

    .alert {
        border-radius: 0.5rem;
    }

    .card {
        border-radius: 1rem;
        overflow: hidden;
    }

    .playfair-display {
        font-family: 'Playfair Display', serif;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set minimum date (tomorrow)
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        const minDate = tomorrow.toISOString().split('T')[0];
        document.getElementById('tanggal_booking').setAttribute('min', minDate);

        // Initialize form validation
        const form = document.getElementById('bookingForm');
        const submitBtn = document.getElementById('submitBtn');
        const loadingState = document.getElementById('loadingState');

        // Dynamic paket loading
        const layananSelect = document.getElementById('layanan');
        const paketSelect = document.getElementById('paket');

        layananSelect.addEventListener('change', function() {
            const idLayanan = this.value;

            // Reset paket dropdown
            paketSelect.innerHTML = '<option value="">Memuat...</option>';
            paketSelect.disabled = true;
            paketSelect.classList.remove('is-invalid');

            if (idLayanan) {
                // Show loading
                paketSelect.innerHTML = '<option value="">🔄 Memuat paket...</option>';

                // Fetch paket data
                fetch(`<?= base_url('/api/paket/') ?>${idLayanan}`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        paketSelect.innerHTML = '<option value="">-- Pilih Paket --</option>';

                        if (data && data.length > 0) {
                            data.forEach(paket => {
                                const option = document.createElement('option');
                                option.value = paket.id;

                                // Format harga
                                const harga = new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0
                                }).format(paket.harga);

                                option.textContent = `${paket.nama_paket} - ${harga}`;

                                // Restore old value if exists
                                if ('<?= old("id_paket_layanan") ?>' == paket.id) {
                                    option.selected = true;
                                }

                                paketSelect.appendChild(option);
                            });
                            paketSelect.disabled = false;
                        } else {
                            paketSelect.innerHTML = '<option value="">⚠️ Belum ada paket untuk layanan ini</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching paket:', error);
                        paketSelect.innerHTML = '<option value="">❌ Gagal memuat paket. Silakan coba lagi.</option>';

                        // Show user-friendly error
                        showAlert('danger', 'Gagal memuat data paket. Silakan refresh halaman atau hubungi customer service.');
                    });
            } else {
                paketSelect.innerHTML = '<option value="">-- Pilih Layanan Utama Dulu --</option>';
            }
        });

        // Trigger change event if there's old value
        if (layananSelect.value) {
            layananSelect.dispatchEvent(new Event('change'));
        }

        // Form validation
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();

            // Remove previous validation classes
            form.classList.remove('was-validated');

            // Custom validation
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');

            requiredFields.forEach(field => {
                field.classList.remove('is-invalid', 'is-valid');

                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.add('is-valid');
                }
            });

            // Date validation
            const tanggalBooking = document.getElementById('tanggal_booking');
            const selectedDate = new Date(tanggalBooking.value);
            if (selectedDate <= today) {
                tanggalBooking.classList.add('is-invalid');
                showAlert('warning', 'Tanggal booking harus minimal H+1 dari hari ini.');
                isValid = false;
            }

            if (isValid) {
                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
                loadingState.classList.remove('d-none');

                // Submit form
                form.submit();
            } else {
                form.classList.add('was-validated');
                showAlert('warning', 'Silakan lengkapi semua field yang wajib diisi.');
            }
        });

        // Helper function to show alerts
        function showAlert(type, message) {
            const alertContainer = document.createElement('div');
            alertContainer.className = `alert alert-${type} alert-dismissible fade show`;
            alertContainer.innerHTML = `
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

            // Insert at the top of the form container
            const cardBody = document.querySelector('.card-body');
            cardBody.insertBefore(alertContainer, cardBody.firstChild);

            // Auto hide after 5 seconds
            setTimeout(() => {
                if (alertContainer) {
                    alertContainer.remove();
                }
            }, 5000);
        }

        // Auto-hide alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                if (alert && alert.parentNode) {
                    alert.remove();
                }
            }, 5000);
        });
    });
</script>

<?= $this->endSection() ?>