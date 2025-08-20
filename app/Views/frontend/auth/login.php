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
        border-radius: 16px;
        box-shadow: var(--shadow-medium);
        overflow: hidden;
        max-width: 400px;
        width: 100%;
    }

    .login-header {
        background: linear-gradient(135deg, var(--light-gold) 0%, var(--gold-color) 100%);
        padding: 40px 30px 30px;
        text-align: center;
        border-bottom: 2px solid var(--burgundy-color);
    }

    .logo-container {
        margin-bottom: 20px;
    }

    .logo-container img {
        max-width: 80px;
        height: auto;
        border-radius: 8px;
        box-shadow: var(--shadow-light);
    }

    .login-title {
        color: var(--burgundy-color);
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        margin-bottom: 8px;
    }

    .login-subtitle {
        color: var(--dark-burgundy);
        font-size: 14px;
        margin: 0;
        opacity: 0.8;
    }

    .login-body {
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

    .btn-login {
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
    }

    .btn-login:hover {
        background: linear-gradient(135deg, #B8860B 0%, var(--gold-color) 100%);
        box-shadow: var(--shadow-medium);
        transform: translateY(-2px);
    }

    .btn-login:active {
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

    .register-link {
        text-align: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid var(--border-color);
    }

    .register-link p {
        margin: 0;
        color: var(--text-gray);
        font-size: 14px;
    }

    .register-link a {
        color: var(--burgundy-color);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .register-link a:hover {
        color: var(--gold-color);
        text-decoration: underline;
    }

    .input-with-icon {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: var(--text-gray);
        pointer-events: none;
    }

    .input-with-icon .form-control {
        padding-left: 44px;
    }

    .input-with-icon .form-control:focus+.input-icon {
        color: var(--gold-color);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .login-container {
            padding: 15px;
        }

        .login-card {
            margin: 0;
        }

        .login-header {
            padding: 30px 25px 25px;
        }

        .login-body {
            padding: 25px;
        }

        .login-title {
            font-size: 24px;
        }

        .logo-container img {
            max-width: 70px;
        }
    }

    @media (max-width: 480px) {
        .login-container {
            padding: 10px;
        }

        .login-header {
            padding: 25px 20px 20px;
        }

        .login-body {
            padding: 20px;
        }

        .login-title {
            font-size: 22px;
        }

        .logo-container img {
            max-width: 60px;
        }

        .form-control {
            font-size: 15px;
        }

        .btn-login {
            font-size: 15px;
        }
    }
</style>

<div class="login-container">
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

            <form action="/login-pelanggan" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-with-icon">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email Anda" required>
                        <svg class="input-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-with-icon">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password Anda" required>
                        <svg class="input-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <button type="submit" class="btn-login">
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