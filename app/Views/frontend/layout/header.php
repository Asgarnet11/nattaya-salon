<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Beranda') ?> | Nattaya Salon Kendari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- descriptions -->
    <meta name="description" content="<?= esc($meta_description ?? 'Nattaya Salon Kendari menawarkan layanan kecantikan dan relaksasi profesional, dengan fasilitas yang modern dan theraphis yang berpengalaman di bidangnya, Ayo booking sekarang juga') ?>">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 0;
            /* Reset padding karena navbar sticky */
        }

        .playfair-display {
            font-family: 'Playfair Display', serif;
        }

        /* --- Skema Warna Elegan --- */
        :root {
            --burgundy: #800020;
            --gold: #FFD700;
            --gold-hover: #e6c200;
        }

        /* Navbar Utama */
        .navbar {
            background-color: var(--burgundy) !important;
            padding: 1rem 0;
            min-height: 70px;
            border-bottom: 2px solid var(--gold);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .navbar-brand img {
            height: 45px;
            width: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
        }

        .navbar-toggler {
            border-color: rgba(255, 215, 0, 0.3);
            padding: 0.375rem 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
            outline: none;
        }

        .navbar-toggler:hover {
            border-color: var(--gold);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 215, 0, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            width: 1.5em;
            height: 1.5em;
        }

        /* Link Navigasi */
        .navbar .nav-link {
            color: #ffffff !important;
            transition: all 0.3s ease;
            font-weight: 500;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            position: relative;
        }

        .navbar .nav-link:hover {
            color: var(--gold) !important;
            background-color: rgba(255, 215, 0, 0.1);
        }

        .navbar .nav-link.active {
            color: var(--gold) !important;
            background-color: rgba(255, 215, 0, 0.2);
        }

        /* Tombol */
        .btn-primary {
            background-color: var(--gold) !important;
            border-color: var(--gold) !important;
            color: var(--burgundy) !important;
            font-weight: 600;
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            padding: 0.5rem 1.2rem;
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active {
            background-color: var(--gold-hover) !important;
            border-color: var(--gold-hover) !important;
            color: var(--burgundy) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
        }

        .btn-outline-primary {
            border-color: var(--gold) !important;
            color: var(--gold) !important;
            font-weight: 600;
            background-color: transparent !important;
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            padding: 0.5rem 1.2rem;
        }

        .btn-outline-primary:hover,
        .btn-outline-primary:focus,
        .btn-outline-primary:active {
            background-color: var(--gold) !important;
            border-color: var(--gold) !important;
            color: var(--burgundy) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
        }

        /* Dropdown Button Fix */
        .dropdown-toggle.btn-link {
            text-decoration: none !important;
            border: none !important;
            background: transparent !important;
            transition: all 0.3s ease;
            border-radius: 0.375rem;
        }

        .dropdown-toggle.btn-link:hover {
            color: var(--gold) !important;
            background-color: rgba(255, 215, 0, 0.1) !important;
        }

        .dropdown-toggle.btn-link:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
            outline: none;
        }

        .dropdown-menu {
            border-radius: 0.5rem;
            border: 1px solid rgba(255, 215, 0, 0.2);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            background-color: #ffffff;
            min-width: 180px;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            color: var(--burgundy) !important;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            font-weight: 500;
        }

        .dropdown-item:hover,
        .dropdown-item:focus,
        .dropdown-item:active {
            background-color: var(--burgundy) !important;
            color: var(--gold) !important;
        }

        .dropdown-divider {
            border-color: rgba(128, 0, 32, 0.2);
            margin: 0.5rem 0;
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .navbar {
                padding: 0.75rem 0;
            }

            .navbar-nav {
                padding-top: 1rem;
                width: 100%;
            }

            .navbar-nav .nav-item {
                margin-bottom: 0.5rem;
                width: 100%;
            }

            .navbar-nav .nav-link {
                text-align: left;
                padding: 0.75rem 1rem;
            }

            .navbar-nav .btn {
                width: 100%;
                margin-top: 0.5rem !important;
                margin-left: 0 !important;
                text-align: center;
            }

            /* Dropdown di mobile */
            .dropdown-menu {
                border: none;
                background-color: rgba(128, 0, 32, 0.95);
                box-shadow: none;
                border-radius: 0.375rem;
                margin-top: 0.25rem;
            }

            .dropdown-item {
                color: #ffffff !important;
                padding: 0.75rem 1.5rem;
            }

            .dropdown-item:hover,
            .dropdown-item:focus,
            .dropdown-item:active {
                background-color: rgba(255, 215, 0, 0.2) !important;
                color: var(--gold) !important;
            }

            .dropdown-divider {
                border-color: rgba(255, 255, 255, 0.3);
            }
        }

        /* Small screens */
        @media (max-width: 575.98px) {
            .navbar-brand img {
                height: 35px;
            }

            .navbar {
                padding: 0.5rem 0;
            }
        }

        /* Fix untuk overlap content */
        .sticky-top {
            z-index: 1030;
        }

        /* Loading state untuk gambar */
        .navbar-brand img {
            background: rgba(255, 215, 0, 0.1);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>" aria-label="Nattaya Salon Beranda">
                <img src="<?= base_url('asset/images/logo.png') ?>"
                    alt="Nattaya Salon Logo"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                <span style="display: none; color: var(--gold); font-weight: 700;">Nattaya Salon</span>
            </a>

            <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('/')) ? 'active' : '' ?>"
                            href="<?= base_url('/') ?>"
                            aria-current="<?= (current_url() == base_url('/')) ? 'page' : 'false' ?>">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos(current_url(), 'layanan') !== false) ? 'active' : '' ?>"
                            href="<?= base_url('/layanan') ?>">
                            Layanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos(current_url(), 'galeri') !== false) ? 'active' : '' ?>"
                            href="<?= base_url('/galeri') ?>">
                            Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos(current_url(), 'artikel') !== false) ? 'active' : '' ?>"
                            href="<?= base_url('/artikel') ?>">
                            Artikel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos(current_url(), 'lokasi') !== false) ? 'active' : '' ?>"
                            href="<?= base_url('/lokasi') ?>">
                            Lokasi
                        </a>
                    </li>

                    <?php if (session()->get('pelanggan_logged_in')): ?>
                        <!-- Menu Jika Sudah Login -->
                        <li class="nav-item dropdown ms-lg-3">
                            <button class="nav-link dropdown-toggle btn btn-link"
                                type="button"
                                data-bs-toggle="dropdown"
                                data-bs-auto-close="true"
                                aria-expanded="false"
                                id="navbarDropdown"
                                style="border: none; background: none; color: #ffffff !important; font-weight: 500; padding: 0.5rem 1rem;">
                                Akun Saya
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('/riwayat-booking') ?>">
                                        <i class="bi bi-clock-history me-2"></i>Riwayat Booking
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="<?= base_url('/logout') ?>"
                                        onclick="return confirm('Apakah Anda yakin ingin logout?')">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-lg-2"
                                href="<?= base_url('/booking') ?>"
                                role="button">
                                Booking Sekarang
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- Menu Jika Belum Login -->
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-outline-primary"
                                href="<?= base_url('/login') ?>"
                                role="button">
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-lg-2"
                                href="<?= base_url('/register') ?>"
                                role="button">
                                Register
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS Bundle -->
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
</body>

</html>