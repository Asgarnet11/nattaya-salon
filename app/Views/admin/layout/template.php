<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) . ' | ' : '' ?>Nattaya Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --burgundy: #800020;
            --gold: #FFD700;
            --dark-bg: #1a1a1a;
            --sidebar-bg: #2d2d2d;
            --hover-bg: #3a3a3a;
            --active-bg: #800020;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            display: flex;
            min-height: 100vh;
        }

        .playfair-display {
            font-family: 'Playfair Display', serif;
        }

        /* Enhanced Sidebar */
        .admin-sidebar {
            background: linear-gradient(180deg, var(--dark-bg) 0%, var(--sidebar-bg) 100%);
            color: white;
            height: 100vh;
            width: 280px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Header Section */
        .sidebar-header {
            padding: 2rem 1.5rem;
            text-align: center;
            background: linear-gradient(135deg, var(--burgundy) 0%, var(--gold) 100%);
            position: relative;
            overflow: hidden;
        }

        .sidebar-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(45deg,
                    transparent,
                    transparent 10px,
                    rgba(255, 255, 255, 0.05) 10px,
                    rgba(255, 255, 255, 0.05) 20px);
            animation: float 20s linear infinite;
        }

        @keyframes float {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .sidebar-logo {
            position: relative;
            z-index: 2;
        }

        .sidebar-logo img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 0.5rem;
            filter: brightness(1.1) contrast(1.1);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px;
            backdrop-filter: blur(10px);
        }

        .sidebar-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin: 0;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .sidebar-subtitle {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
            font-weight: 400;
            position: relative;
            z-index: 2;
        }

        /* User Info */
        .user-info {
            background: rgba(255, 255, 255, 0.05);
            padding: 1rem;
            margin: 1rem 1.5rem;
            border-radius: 10px;
            text-align: center;
            border: 1px solid rgba(255, 215, 0, 0.2);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--burgundy) 0%, var(--gold) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .user-name {
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
            margin: 0;
        }

        .user-role {
            color: var(--gold);
            font-size: 0.8rem;
            margin: 0;
        }

        /* Navigation Section */
        .sidebar-nav {
            padding: 1.5rem 0;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-section-title {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0 1.5rem;
            margin-bottom: 0.8rem;
            position: relative;
        }

        .nav-section-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 1.5rem;
            width: 30px;
            height: 2px;
            background: linear-gradient(90deg, var(--gold), transparent);
        }

        /* Enhanced Nav Items */
        .sidebar-nav .nav-item {
            margin-bottom: 0.3rem;
        }

        .sidebar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.8rem 1.5rem;
            border-radius: 0;
            font-weight: 500;
            font-size: 0.95rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .sidebar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--gold);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .sidebar-nav .nav-link:hover::before,
        .sidebar-nav .nav-link.active::before {
            transform: scaleY(1);
        }

        .sidebar-nav .nav-link:hover {
            background: linear-gradient(90deg, var(--hover-bg) 0%, transparent 100%);
            color: white;
            padding-left: 2rem;
        }

        .sidebar-nav .nav-link.active {
            background: linear-gradient(90deg, var(--active-bg) 0%, rgba(128, 0, 32, 0.3) 100%);
            color: var(--gold);
            font-weight: 600;
        }

        .sidebar-nav .nav-link i {
            font-size: 1.1rem;
            margin-right: 0.8rem;
            width: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .sidebar-nav .nav-link:hover i {
            color: var(--gold);
            transform: scale(1.1);
        }

        /* Stats Section */
        .sidebar-stats {
            padding: 1rem 1.5rem;
            background: rgba(255, 215, 0, 0.1);
            margin: 1rem 1.5rem;
            border-radius: 15px;
            border: 1px solid rgba(255, 215, 0, 0.2);
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            font-size: 0.85rem;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.7);
        }

        .stat-value {
            color: var(--gold);
            font-weight: 600;
        }

        /* Footer Section */
        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            color: white;
            padding: 0.8rem;
            font-weight: 600;
            border-radius: 10px;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .logout-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #c82333 0%, #dc3545 100%);
            transition: left 0.3s ease;
            z-index: 1;
        }

        .logout-btn:hover::before {
            left: 0;
        }

        .logout-btn span {
            position: relative;
            z-index: 2;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.3);
        }

        /* Main Content Area */
        .main-content {
            margin-left: 280px;
            flex-grow: 1;
            min-height: 100vh;
            background-color: #f8f9fa;
            transition: margin-left 0.3s ease;
        }

        .content-header {
            background: white;
            padding: 2rem 2rem 1rem;
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        .content-header h1 {
            color: var(--burgundy);
            font-size: 2rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .content-header .breadcrumb {
            background: none;
            padding: 0;
            margin: 0.5rem 0 0;
        }

        .content-header .breadcrumb-item {
            color: #6c757d;
        }

        .content-header .breadcrumb-item.active {
            color: var(--gold);
        }

        .content-body {
            padding: 2rem;
        }

        /* Mobile Toggle Button */
        .mobile-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: var(--burgundy);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(128, 0, 32, 0.3);
            transition: all 0.3s ease;
        }

        .mobile-toggle:hover {
            background: #a00028;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
            }

            .content-header {
                padding-left: 4rem;
            }
        }

        /* Scrollbar Styling */
        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 215, 0, 0.3);
            border-radius: 10px;
        }

        .admin-sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 215, 0, 0.5);
        }

        /* Loading State */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255, 215, 0, 0.3);
            border-top: 4px solid var(--gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Mobile Toggle Button -->
    <button class="mobile-toggle" onclick="toggleSidebar()" aria-label="Toggle Sidebar">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar -->
    <nav class="admin-sidebar" id="adminSidebar">
        <!-- Header with Logo -->
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <img src="/asset/images/logo.png" alt="Nattaya Salon Logo">
                <h4 class="sidebar-title playfair-display">Nattaya Admin</h4>
                <p class="sidebar-subtitle">Salon Management System</p>
            </div>
        </div>

        <!-- User Info -->
        <div class="user-info">
            <div class="user-avatar">
                <i class="bi bi-person-fill"></i>
            </div>
            <p class="user-name"><?= session()->get('admin_name') ?? 'Admin User' ?></p>
            <p class="user-role"><?= session()->get('admin_role') ?? 'Administrator' ?></p>
        </div>

        <!-- Navigation -->
        <div class="sidebar-nav">
            <!-- Dashboard Section -->
            <div class="nav-section">
                <div class="nav-section-title">Dashboard</div>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="/admin/dashboard" class="nav-link">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Management Section -->
            <div class="nav-section">
                <div class="nav-section-title">Manajemen</div>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="/admin/booking" class="nav-link">
                            <i class="bi bi-calendar-check"></i>
                            <span>Booking</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/layanan" class="nav-link">
                            <i class="bi bi-scissors"></i>
                            <span>Layanan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/karyawan" class="nav-link">
                            <i class="bi bi-people"></i>
                            <span>Karyawan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/galeri" class="nav-link">
                            <i class="bi bi-images"></i>
                            <span>Galeri</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/artikel" class="nav-link">
                            <i class="bi bi-journal-text"></i>
                            <span>Artikel</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- System Section -->
            <div class="nav-section">
                <div class="nav-section-title">Sistem</div>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="/admin/cabang" class="nav-link">
                            <i class="bi bi-building"></i>
                            <span>Cabang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/users" class="nav-link">
                            <i class="bi bi-person-gear"></i>
                            <span>User Management</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <div class="sidebar-footer">
            <button class="logout-btn" onclick="confirmLogout()">
                <span>
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </span>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Content Header -->
        <div class="content-header">
            <h1>
                <i class="bi bi-<?= isset($icon) ? $icon : 'house' ?> me-3"></i>
                <?= isset($title) ? esc($title) : 'Dashboard' ?>
            </h1>
            <?php if (isset($breadcrumb) && is_array($breadcrumb)): ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php foreach ($breadcrumb as $item): ?>
                            <?php if (isset($item['url'])): ?>
                                <li class="breadcrumb-item">
                                    <a href="<?= $item['url'] ?>"><?= esc($item['title']) ?></a>
                                </li>
                            <?php else: ?>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?= esc($item['title']) ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ol>
                </nav>
            <?php endif; ?>
        </div>

        <!-- Content Body -->
        <div class="content-body">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Global variables
        let sidebarToggled = false;

        // Logout confirmation
        function confirmLogout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                showLoading();
                window.location.href = '/logout';
            }
        }

        // Mobile sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            sidebar.classList.toggle('show');
            sidebarToggled = !sidebarToggled;
        }

        // Show/hide loading overlay
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }

        // Set active navigation
        function setActiveNavigation() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.sidebar-nav .nav-link');

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        }

        // Load sidebar stats
        async function loadSidebarStats() {
            try {
                // You can implement API calls here to fetch real data
                // For now, using placeholder values
                document.getElementById('todayBookings').textContent = '12';
                document.getElementById('monthlyRevenue').textContent = '45.2M';
                document.getElementById('totalCustomers').textContent = '2,847';
            } catch (error) {
                console.error('Error loading stats:', error);
            }
        }

        // Close sidebar when clicking outside (mobile)
        function handleClickOutside(event) {
            const sidebar = document.getElementById('adminSidebar');
            const toggleBtn = document.querySelector('.mobile-toggle');

            if (window.innerWidth <= 768 && sidebarToggled) {
                if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    toggleSidebar();
                }
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            setActiveNavigation();
            loadSidebarStats();

            // Add click outside handler
            document.addEventListener('click', handleClickOutside);

            // Hide loading overlay
            hideLoading();
        });

        // Handle page navigation with loading
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a[href^="/admin"]');
            if (link && !e.ctrlKey && !e.metaKey) {
                showLoading();
            }
        });

        // Handle form submissions with loading
        document.addEventListener('submit', function(e) {
            showLoading();
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>