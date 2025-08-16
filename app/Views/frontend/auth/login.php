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

    .login-container {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--burgundy-color) 0%, var(--dark-burgundy) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-card {
        background: var(--white);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 450px;
        width: 100%;
        position: relative;
    }

    .login-header {
        background: linear-gradient(135deg, var(--light-gold) 0%, var(--gold-color) 100%);
        padding: 40px 30px 30px;
        text-align: center;
        position: relative;
    }

    .logo-container {
        margin-bottom: 20px;
    }

    .logo-container img {
        max-width: 80px;
        height: auto;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
    }

    .login-title {
        color: var(--burgundy-color);
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 600;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .login-subtitle {
        color: var(--dark-burgundy);
        font-size: 14px;
        margin-top: 8px;
        opacity: 0.8;
    }

    .login-body {
        padding: 40px 30px;
    }

    .form-floating {
        position: relative;
        margin-bottom: 20px;
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

    .btn-login {
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
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(218, 165, 32, 0.4);
        background: linear-gradient(135deg, #B8860B 0%, var(--gold-color) 100%);
    }

    .btn-login:active {
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

    .register-link {
        text-align: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }

    .register-link p {
        margin: 0;
        color: #6c757d;
    }

    .register-link a {
        color: var(--burgundy-color);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .register-link a:hover {
        color: var(--gold-color);
        text-decoration: underline;
    }

    .decorative-element {
        position: absolute;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
    }

    .decorative-element:nth-child(1) {
        top: -50px;
        right: -50px;
    }

    .decorative-element:nth-child(2) {
        bottom: -30px;
        left: -30px;
        width: 60px;
        height: 60px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .login-container {
            padding: 10px;
        }

        .login-card {
            max-width: 100%;
            margin: 10px;
        }

        .login-header {
            padding: 30px 20px 20px;
        }

        .login-body {
            padding: 30px 20px;
        }

        .login-title {
            font-size: 24px;
        }

        .logo-container img {
            max-width: 60px;
        }
    }

    @media (max-width: 480px) {
        .login-header {
            padding: 25px 15px 15px;
        }

        .login-body {
            padding: 25px 15px;
        }

        .form-floating input {
            padding: 12px 15px;
            font-size: 14px;
        }

        .form-floating label {
            left: 15px;
            font-size: 14px;
        }

        .btn-login {
            padding: 12px;
            font-size: 14px;
        }
    }
</style>

<div class="login-container">
    <div class="decorative-element"></div>
    <div class="decorative-element"></div>

    <div class="login-card">
        <div class="login-header">
            <div class="logo-container">
                <img src="<?= base_url('/asset/images/logo.png') ?>" alt="Logo" class="logo">
            </div>
            <h3 class="login-title">Selamat Datang</h3>
            <p class="login-subtitle">Silakan masuk ke akun Anda</p>
        </div>

        <div class="login-body">
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

            <form action="/login-pelanggan" method="post">
                <?= csrf_field() ?>

                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                    <label for="email">
                        <i class="fas fa-envelope me-2"></i>Email
                    </label>
                </div>

                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Masuk
                </button>
            </form>

            <div class="register-link">
                <p>Belum punya akun? <a href="/register">Daftar sekarang</a></p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>