<?= $this->include('frontend/layout/header') ?>

<main>
    <?= $this->renderSection('content') ?>
</main>

<?= $this->include('frontend/layout/footer') ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Debug untuk memastikan Bootstrap loaded
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Bootstrap version:', bootstrap.Tooltip.VERSION);

        // Manual initialization untuk dropdown jika diperlukan
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
        var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl);
        });

        // Test klik dropdown
        const dropdownToggle = document.getElementById('navbarDropdown');
        if (dropdownToggle) {
            dropdownToggle.addEventListener('click', function(e) {
                console.log('Dropdown clicked');
            });
        }
    });
</script>

<script>
    document.getElementById('layanan').addEventListener('change', function() {
        let idLayanan = this.value;
        let paketDropdown = document.getElementById('paket');
        paketDropdown.innerHTML = '<option value="">Memuat...</option>';
        paketDropdown.disabled = true;

        if (idLayanan) {
            fetch('/api/paket/' + idLayanan)
                .then(response => response.json())
                .then(data => {
                    paketDropdown.innerHTML = '<option value="">-- Pilih Paket --</option>';
                    if (data.length > 0) {
                        data.forEach(paket => {
                            let option = document.createElement('option');
                            option.value = paket.id;
                            // Format harga ke Rupiah
                            let harga = parseInt(paket.harga).toLocaleString('id-ID');
                            option.textContent = `${paket.nama_paket} - Rp ${harga}`;
                            paketDropdown.appendChild(option);
                        });
                        paketDropdown.disabled = false;
                    } else {
                        paketDropdown.innerHTML = '<option value="">-- Belum ada paket untuk layanan ini --</option>';
                    }
                });
        } else {
            paketDropdown.innerHTML = '<option value="">-- Pilih Layanan Utama Dulu --</option>';
        }
    });

    // Mencegah memilih tanggal di masa lalu
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggal_booking').setAttribute('min', today);
    });
</script>