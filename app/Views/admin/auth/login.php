<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Nattaya Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --gold-color: #DAA520;
            --light-gold: #F4E4BC;
            --burgundy-color: #800020;
            --dark-burgundy: #5D001E;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--burgundy-color) 0%, var(--dark-burgundy) 100%);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--light-gold) 0%, var(--gold-color) 100%);
            border-bottom: none;
            padding: 30px;
            text-align: center;
        }

        .admin-icon {
            background: var(--burgundy-color);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 24px;
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.3);
        }

        .card-title {
            color: var(--burgundy-color);
            font-weight: 600;
            font-size: 24px;
            margin: 0;
        }

        .card-subtitle {
            color: var(--dark-burgundy);
            font-size: 14px;
            margin-top: 5px;
            opacity: 0.8;
        }

        .card-body {
            padding: 35px;
            background: white;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--gold-color);
            box-shadow: 0 0 0 3px rgba(218, 165, 32, 0.1);
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 3;
        }

        .form-control.with-icon {
            padding-left: 45px;
        }

        .btn-admin {
            background: linear-gradient(135deg, var(--burgundy-color) 0%, var(--dark-burgundy) 100%);
            border: none;
            color: white;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-admin:hover {
            background: linear-gradient(135deg, var(--dark-burgundy) 0%, var(--burgundy-color) 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.3);
        }

        .btn-admin:active {
            transform: translateY(0);
        }

        .alert-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            color: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
        }

        .alert-danger .fas {
            margin-right: 8px;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        .security-note {
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }

        .security-note .fas {
            margin-right: 5px;
            color: var(--gold-color);
        }

        /* Responsive */
        @media (max-width: 480px) {
            .card-header {
                padding: 25px 20px;
            }

            .card-body {
                padding: 25px 20px;
            }

            .card-title {
                font-size: 20px;
            }

            .admin-icon {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="card login-card">
        <div class="card-header">
            <div class="admin-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <h3 class="card-title">Admin Panel</h3>
            <p class="card-subtitle">Secure Access</p>
        </div>

        <div class="card-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="/admin/login" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="form-control with-icon" id="username" name="username" required autocomplete="username">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control with-icon" id="password" name="password" required autocomplete="current-password">
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-admin">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Login
                    </button>
                </div>
            </form>

            <div class="security-note">
                <i class="fas fa-shield-alt"></i>
                Authorized personnel only
            </div>
        </div>
    </div>
</body>

</html>