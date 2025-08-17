<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Nattaya Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --burgundy: #800020;
            --gold: #FFD700;
            --dark-bg: #1A1A1A;
            --light-gray: #f8f9fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .playfair-display {
            font-family: 'Playfair Display', serif;
        }

        /* Main content placeholder */
        .main-content {
            background: linear-gradient(135deg, var(--light-gray) 0%, #e9ecef 100%);
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Enhanced Footer Styling */
        .nattaya-footer {
            background: linear-gradient(135deg, var(--dark-bg) 0%, #2d2d2d 100%);
            color: #FFFFFF;
            position: relative;
            overflow: hidden;
        }

        .nattaya-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--gold) 0%, var(--burgundy) 50%, var(--gold) 100%);
        }

        .footer-main {
            padding: 3rem 0 2rem;
        }

        .footer-bottom {
            background-color: rgba(0, 0, 0, 0.3);
            padding: 1.5rem 0;
            border-top: 1px solid rgba(255, 215, 0, 0.2);
        }

        /* Logo dan Brand */
        .footer-brand {
            margin-bottom: 1.5rem;
        }

        .footer-logo {
            font-size: 2rem;
            font-weight: 700;
            color: var(--gold);
            text-decoration: none;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .footer-tagline {
            color: #cccccc;
            font-size: 0.9rem;
            margin: 0;
            font-style: italic;
        }

        /* Section Headers */
        .footer-section h5 {
            color: var(--gold);
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.1rem;
            position: relative;
        }

        .footer-section h5::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 30px;
            height: 2px;
            background-color: var(--burgundy);
        }

        /* Links Styling */
        .footer-link {
            color: #cccccc;
            text-decoration: none;
            display: block;
            padding: 0.3rem 0;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .footer-link:hover {
            color: var(--gold);
            padding-left: 5px;
        }

        /* Contact Info */
        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.8rem;
            color: #cccccc;
            font-size: 0.9rem;
        }

        .contact-item i {
            color: var(--gold);
            font-size: 1.1rem;
            margin-right: 0.8rem;
            width: 20px;
            text-align: center;
        }

        /* Social Media Links */
        .social-section {
            text-align: center;
            margin: 2rem 0;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--burgundy) 0%, var(--gold) 100%);
            color: white;
            text-decoration: none;
            border-radius: 50%;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .social-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--gold) 0%, var(--burgundy) 100%);
            transition: left 0.3s ease;
            z-index: 1;
        }

        .social-link:hover::before {
            left: 0;
        }

        .social-link i {
            position: relative;
            z-index: 2;
        }

        .social-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 215, 0, 0.3);
        }

        /* Operating Hours */
        .hours-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.3rem 0;
            color: #cccccc;
            font-size: 0.9rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .hours-item:last-child {
            border-bottom: none;
        }

        .hours-day {
            font-weight: 500;
        }

        .hours-time {
            color: var(--gold);
            font-weight: 500;
        }

        /* Newsletter */
        .newsletter-form {
            margin-top: 1rem;
        }

        .newsletter-input {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 215, 0, 0.3);
            color: white;
            padding: 0.7rem;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .newsletter-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .newsletter-input:focus {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: var(--gold);
            box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
            color: white;
        }

        .btn-newsletter {
            background: linear-gradient(135deg, var(--burgundy) 0%, var(--gold) 100%);
            border: none;
            color: white;
            font-weight: 500;
            padding: 0.7rem 1.5rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-newsletter:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(128, 0, 32, 0.4);
            color: white;
        }

        /* Copyright */
        .copyright-text {
            margin: 0;
            color: #cccccc;
            font-size: 0.9rem;
        }

        .developer-credit {
            color: var(--gold);
            text-decoration: none;
        }

        .developer-credit:hover {
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-main {
                padding: 2rem 0 1.5rem;
            }

            .social-links {
                gap: 0.8rem;
            }

            .social-link {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
            }

            .footer-section h5 {
                margin-top: 2rem;
            }

            .footer-section:first-child h5 {
                margin-top: 0;
            }
        }

        /* Decorative Elements */
        .decorative-line {
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, var(--gold) 50%, transparent 100%);
            margin: 2rem 0;
        }
    </style>
</head>

<body>
    <footer class="nattaya-footer">
        <div class="footer-main">
            <div class="container">
                <div class="row g-4">
                    <!-- Brand Section -->
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-brand">
                            <a href="/" class="footer-logo playfair-display">Nattaya Salon</a>
                            <p class="footer-tagline">"Kecantikan Alami, Perawatan Profesional"</p>
                        </div>

                        <p style="color: #cccccc; font-size: 0.9rem; line-height: 1.6;">
                            Nattaya Salon Kendari hadir untuk memberikan pengalaman perawatan kecantikan terbaik dengan layanan profesional dan produk berkualitas tinggi.
                        </p>

                        <!-- Social Media -->
                        <div class="social-section">
                            <h6 style="color: var(--gold); margin-bottom: 1rem;">Ikuti Kami</h6>
                            <div class="social-links">
                                <a href="https://facebook.com/nattayasalon" target="_blank" class="social-link" aria-label="Facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="https://instagram.com/nattayasalon" target="_blank" class="social-link" aria-label="Instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="https://tiktok.com/@nattayasalon" target="_blank" class="social-link" aria-label="TikTok">
                                    <i class="bi bi-tiktok"></i>
                                </a>
                                <a href="https://wa.me/628123456789" target="_blank" class="social-link" aria-label="WhatsApp">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-section">
                            <h5>Navigasi</h5>
                            <a href="/" class="footer-link">Beranda</a>
                            <a href="/layanan" class="footer-link">Layanan</a>
                            <a href="/galeri" class="footer-link">Galeri</a>
                            <a href="/artikel" class="footer-link">Artikel</a>
                            <a href="/kontak" class="footer-link">Kontak</a>
                            <a href="/booking" class="footer-link">Booking</a>
                        </div>
                    </div>

                    <!-- Services -->
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-section">
                            <h5>Layanan</h5>
                            <a href="/layanan" class="footer-link">Facial Treatment</a>
                            <a href="/layanan" class="footer-link">Hair Styling</a>
                            <a href="/layanan" class="footer-link">Nail Art</a>
                            <a href="/layanan" class="footer-link">Makeup</a>
                            <a href="/layanan" class="footer-link">Body Spa</a>
                            <a href="/layanan" class="footer-link">Paket Hemat</a>
                        </div>
                    </div>

                    <!-- Contact & Hours -->
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-section">
                            <h5>Kontak Kami</h5>
                            <div class="contact-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>Jl. Ahmad Yani No. 123<br>Kendari, Sulawesi Tenggara</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-telephone-fill"></i>
                                <span>(0401) 123-4567</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-whatsapp"></i>
                                <span>+62 812-3456-789</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-envelope-fill"></i>
                                <span>info@nattayasalon.com</span>
                            </div>
                        </div>

                        <div class="footer-section mt-4">
                            <h5>Jam Operasional</h5>
                            <div class="hours-item">
                                <span class="hours-day">Senin - Jumat</span>
                                <span class="hours-time">09:00 - 20:00</span>
                            </div>
                            <div class="hours-item">
                                <span class="hours-day">Sabtu</span>
                                <span class="hours-time">08:00 - 21:00</span>
                            </div>
                            <div class="hours-item">
                                <span class="hours-day">Minggu</span>
                                <span class="hours-time">10:00 - 18:00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Newsletter Section -->
                <div class="decorative-line"></div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h5 style="color: var(--gold); margin-bottom: 1rem;">Newsletter</h5>
                        <p style="color: #cccccc; font-size: 0.9rem; margin-bottom: 1rem;">
                            Dapatkan tips kecantikan dan promo menarik langsung di email Anda
                        </p>
                        <div class="newsletter-form">
                            <div class="input-group">
                                <input type="email" class="form-control newsletter-input" placeholder="Masukkan email Anda" aria-label="Email">
                                <button class="btn btn-newsletter" type="button">
                                    <i class="bi bi-envelope-heart-fill me-2"></i>Berlangganan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="copyright-text">
                            &copy; 2025 <strong>Nattaya Salon Kendari</strong>. All Rights Reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>