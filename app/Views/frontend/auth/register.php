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
        --border-color: #e1e8ed;
        --text-gray: #6c7983;
        --shadow-light: 0 4px 12px rgba(0, 0, 0, 0.1);
        --shadow-medium: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        margin: 0;
        padding: 0;
        line-height: 1.6;
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
        border-radius: 16px;
        box-shadow: var(--shadow-medium);
        overflow: hidden;
        max-width: 450px;
        width: 100%;
    }

    .register-header {
        background: linear-gradient(135deg, var(--light-gold) 0%, var(--gold-color) 100%);
        padding: 35px 30px 25px;
        text-align: center;
        border-bottom: 2px solid var(--burgundy-color);
    }

    .logo-container {
        margin-bottom: 20px;
    }

    .logo-container img {
        max-width: 70px;
        height: auto;
        border-radius: 8px;
        box-shadow: var(--shadow-light);
    }

    .register-title {
        color: var(--burgundy-color);
        font-size: 26px;
        font-weight: 700;
        margin: 0;
        margin-bottom: 8px;
    }

    .register-subtitle {
        color: var(--dark-burgundy);
        font-size: 14px;
        margin: 0;
        opacity: 0.8;
    }

    .register-body {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        color: var(--text-gray);
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: var(--white);
        color: #333;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--gold-color);
        box-shadow: 0 0 0 3px rgba(218, 165, 32, 0.1);
    }

    .form-control:hover:not(:focus) {
        border-color: #d0d7de;
    }

    .btn-register {
        width: 100%;
        background: linear-gradient(135deg, var(--gold-color) 0%, #B8860B 100%);
        border: none;
        color: var(--white);
        padding: 14px 20px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: var(--shadow-light);
        margin-top: 10px;
    }

    .btn-register:hover {
        background: linear-gradient(135deg, #B8860B 0%, var(--gold-color) 100%);
        box-shadow: var(--shadow-medium);
        transform: translateY(-2px);
    }

    .btn-register:active {
        transform: translateY(0);
        transition: transform 0.1s ease;
    }

    .alert {
        border-radius: 8px;
        border: none;
        margin-bottom: 20px;
        padding: 12px 16px;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border-left: 4px solid #28a745;
    }

    .alert-icon {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    .login-link {
        text-align: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid var(--border-color);
    }

    .login-link p {
        margin: 0;
        color: var(--text-gray);
        font-size: 14px;
    }

    .login-link a {
        color: var(--burgundy-color);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .login-link a:hover {
        color: var(--gold-color);
        text-decoration: underline;
    }

    .password-strength {
        font-size: 12px;
        margin-top: 5px;
        padding: 5px 8px;
        border-radius: 4px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .password-strength.visible {
        opacity: 1;
    }

    .strength-weak {
        background: #f8d7da;
        color: #721c24;
    }

    .strength-medium {
        background: #fff3cd;
        color: #856404;
    }

    .strength-strong {
        background: #d4edda;
        color: #155724;
    }

    .form-row {
        display: flex;
        gap: 15px;
    }

    .form-row .form-group {
        flex: 1;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .register-container {
            padding: 15px;
        }

        .register-card {
            margin: 0;
        }

        .register-header {
            padding: 30px 25px 25px;
        }

        .register-body {
            padding: 25px;
        }

        .register-title {
            font-size: 24px;
        }

        .logo-container img {
            max-width: 65px;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }
    }

    @media (max-width: 480px) {
        .register-container {
            padding: 10px;
        }

        .register-header {
            padding: 25px 20px 20px;
        }

        .register-body {
            padding: 20px;
        }

        .register-title {
            font-size: 22px;
        }

        .logo-container img {
            max-width: 60px;
        }

        .form-control {
            font-size: 15px;
        }

        .btn-register {
            font-size: 15px;
        }
    }
</style>

<div class="register-container">
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
                    <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <svg class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="/register" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Masukkan nama lengkap Anda" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan alamat email Anda" required>
                </div>

                <div class="form-group">
                    <label for="no_telepon" class="form-label">Nomor Telepon</label>
                    <input type="tel" name="no_telepon" class="form-control" id="no_telepon" placeholder="Masukkan nomor telepon Anda" required>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Buat kata sandi yang kuat" required>
                    <div class="password-strength" id="passwordStrength"></div>
                </div>

                <button type="submit" class="btn-register">
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
            feedback = '❌ Kata sandi lemah - Gunakan minimal 8 karakter, angka, dan huruf besar';
        } else if (strength <= 2) {
            strengthEl.classList.add('strength-medium');
            feedback = '⚠️ Kata sandi sedang - Tambahkan karakter khusus untuk keamanan lebih baik';
        } else {
            strengthEl.classList.add('strength-strong');
            feedback = '✅ Kata sandi kuat - Keamanan baik!';
        }

        strengthEl.textContent = feedback;
    });

    // Phone number formatting (Indonesian format)
    document.getElementById('no_telepon').addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');

        // Limit to reasonable phone number length
        if (value.length > 15) {
            value = value.substring(0, 15);
        }

        // Format as Indonesian phone number
        if (value.startsWith('0')) {
            // Convert 08xx to +628xx
            value = '+62' + value.substring(1);
        } else if (value.startsWith('8') && value.length >= 10) {
            // Convert 8xx to +628xx
            value = '+62' + value;
        } else if (value.startsWith('62') && !value.startsWith('+62')) {
            // Add + to 62xxx
            value = '+' + value;
        }

        this.value = value;
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const phone = document.getElementById('no_telepon').value;

        // Validate password strength
        if (password.length < 6) {
            e.preventDefault();
            alert('Kata sandi harus minimal 6 karakter');
            return;
        }

        // Validate phone number
        if (!phone.match(/^\+62\d{8,13}$/)) {
            e.preventDefault();
            alert('Format nomor telepon tidak valid. Gunakan format: +628xxxxxxxxx');
            return;
        }
    });
</script>

<?= $this->endSection() ?>