<?= $this->extend('frontend/layout/template') ?>
<?= $this->section('content') ?>

<style>
    :root {
        --gold-color: #DAA520;
        --light-gold: #F4E4BC;
        --burgundy-color: #800020;
        --dark-burgundy: #5D001E;
        --white: #ffffff;
        --light-gray: #f8f9fa;
    }

    .register-container {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--burgundy-color) 0%, var(--dark-burgundy) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .register-card {
        background: var(--white);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 500px;
        width: 100%;
        position: relative;
    }

    .register-header {
        background: linear-gradient(135deg, var(--light-gold) 0%, var(--gold-color) 100%);
        padding: 35px 30px 25px;
        text-align: center;
        position: relative;
    }

    .logo-container {
        margin-bottom: 15px;
    }

    .logo-container img {
        max-width: 70px;
        height: auto;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
    }

    .register-title {
        color: var(--burgundy-color);
        font-family: 'Playfair Display', serif;
        font-size: 26px;
        font-weight: 600;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .register-subtitle {
        color: var(--dark-burgundy);
        font-size: 14px;
        margin-top: 5px;
        opacity: 0.8;
    }

    .register-body {
        padding: 35px 30px;
    }

    .form-floating {
        position: relative;
        margin-bottom: 18px;
    }

    .form-floating input {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: var(--light-gray);
    }

    .form-floating input:focus {
        outline: none;
        border-color: var(--gold-color);
        background: var(--white);
        box-shadow: 0 0 0 3px rgba(218, 165, 32, 0.1);
    }

    .form-floating label {
        position: absolute;
        top: 50%;
        left: 20px;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 16px;
        transition: all 0.3s ease;
        pointer-events: none;
        background: transparent;
        padding: 0 5px;
    }

    .form-floating input:focus+label,
    .form-floating input:not(:placeholder-shown)+label {
        top: 0;
        font-size: 12px;
        color: var(--gold-color);
        background: var(--white);
        padding: 0 8px;
        margin-left: -3px;
    }

    .btn-register {
        width: 100%;
        background: linear-gradient(135deg, var(--gold-color) 0%, #B8860B 100%);
        border: none;
        color: var(--white);
        padding: 15px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(218, 165, 32, 0.3);
        margin-top: 10px;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(218, 165, 32, 0.4);
        background: linear-gradient(135deg, #B8860B 0%, var(--gold-color) 100%);
    }

    .btn-register:active {
        transform: translateY(0);
    }

    .alert {
        border-radius: 12px;
        border: none;
        margin-bottom: 20px;
    }

    .alert-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: var(--white);
    }

    .alert-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: var(--white);
    }

    .login-link {
        text-align: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }

    .login-link p {
        margin: 0;
        color: #6c757d;
    }

    .login-link a {
        color: var(--burgundy-color);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .login-link a:hover {
        color: var(--gold-color);
        text-decoration: underline;
    }

    .decorative-element {
        position: absolute;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
    }

    .decorative-element:nth-child(1) {
        top: -60px;
        right: -60px;
    }

    .decorative-element:nth-child(2) {
        bottom: -40px;
        left: -40px;
        width: 80px;
        height: 80px;
    }

    .decorative-element:nth-child(3) {
        top: 50%;
        left: -30px;
        width: 60px;
        height: 60px;
        background: rgba(218, 165, 32, 0.1);
    }

    .form-row {
        display: flex;
        gap: 15px;
    }

    .form-row .form-floating {
        flex: 1;
    }

    .password-strength {
        font-size: 12px;
        color: #6c757d;
        margin-top: 5px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .password-strength.visible {
        opacity: 1;
    }

    .strength-weak {
        color: #dc3545;
    }

    .strength-medium {
        color: #ffc107;
    }

    .strength-strong {
        color: #28a745;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .register-container {
            padding: 10px;
        }

        .register-card {
            max-width: 100%;
            margin: 10px;
        }

        .register-header {
            padding: 25px 20px 20px;
        }

        .register-body {
            padding: 25px 20px;
        }

        .register-title {
            font-size: 22px;
        }

        .logo-container img {
            max-width: 55px;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }
    }

    @media (max-width: 480px) {
        .register-header {
            padding: 20px 15px 15px;
        }

        .register-body {
            padding: 20px 15px;
        }

        .form-floating input {
            padding: 12px 15px;
            font-size: 14px;
        }

        .form-floating label {
            left: 15px;
            font-size: 14px;
        }

        .btn-register {
            padding: 12px;
            font-size: 14px;
        }

        .form-floating {
            margin-bottom: 15px;
        }
    }
</style>

<div class="register-container">
    <div class="decorative-element"></div>
    <div class="decorative-element"></div>
    <div class="decorative-element"></div>

    <div class="register-card">
        <div class="register-header">
            <div class="logo-container">
                <img src="<?= base_url('/asset/images/logo.png') ?>" alt="Logo" class="logo">
            </div>
            <h3 class="register-title">Bergabung Bersama Kami</h3>
            <p class="register-subtitle">Buat akun baru untuk memulai</p>
        </div>

        <div class="register-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="/register" method="post">
                <?= csrf_field() ?>

                <div class="form-floating">
                    <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" required>
                    <label for="nama_lengkap">
                        <i class="fas fa-user me-2"></i>Nama Lengkap
                    </label>
                </div>

                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                    <label for="email">
                        <i class="fas fa-envelope me-2"></i>Alamat Email
                    </label>
                </div>

                <div class="form-floating">
                    <input type="tel" name="no_telepon" class="form-control" id="no_telepon" placeholder="Nomor Telepon" required>
                    <label for="no_telepon">
                        <i class="fas fa-phone me-2"></i>Nomor Telepon
                    </label>
                </div>

                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">
                        <i class="fas fa-lock me-2"></i>Kata Sandi
                    </label>
                    <div class="password-strength" id="passwordStrength"></div>
                </div>

                <button type="submit" class="btn btn-register">
                    <i class="fas fa-user-plus me-2"></i>
                    Daftar Sekarang
                </button>
            </form>

            <div class="login-link">
                <p>Sudah punya akun? <a href="/login">Masuk di sini</a></p>
            </div>
        </div>
    </div>
</div>

<script>
    // Password strength indicator
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const strengthEl = document.getElementById('passwordStrength');

        if (password.length === 0) {
            strengthEl.classList.remove('visible');
            return;
        }

        strengthEl.classList.add('visible');

        let strength = 0;
        let feedback = '';

        // Check length
        if (password.length >= 8) strength += 1;

        // Check for numbers
        if (/\d/.test(password)) strength += 1;

        // Check for uppercase
        if (/[A-Z]/.test(password)) strength += 1;

        // Check for special characters
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength += 1;

        // Determine strength level
        strengthEl.className = 'password-strength visible';

        if (strength <= 1) {
            strengthEl.classList.add('strength-weak');
            feedback = 'Kata sandi lemah';
        } else if (strength <= 2) {
            strengthEl.classList.add('strength-medium');
            feedback = 'Kata sandi sedang';
        } else {
            strengthEl.classList.add('strength-strong');
            feedback = 'Kata sandi kuat';
        }

        strengthEl.textContent = feedback;
    });

    // Phone number formatting (Indonesian format)
    document.getElementById('no_telepon').addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');

        // Format as Indonesian phone number
        if (value.startsWith('0')) {
            value = '+62' + value.substring(1);
        } else if (!value.startsWith('+62')) {
            if (value.startsWith('62')) {
                value = '+' + value;
            }
        }

        this.value = value;
    });
</script>

<?= $this->endSection() ?>