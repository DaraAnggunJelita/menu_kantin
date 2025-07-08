<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            margin: 0;
            display: flex;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff8f0;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, #ff9800, #ef6c00);
            color: white;
            padding: 30px 20px;
            position: fixed;
            box-shadow: 2px 0 8px rgba(0,0,0,0.1);
        }

        .sidebar h4 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            color: #ffffff;
            transition: all 0.3s ease;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-link-custom:hover {
            background-color: rgba(255, 255, 255, 0.15);
            text-decoration: none;
        }

        .content {
            margin-left: 260px;
            padding: 40px;
            flex: 1;
        }

        .logout-btn {
            margin-top: 50px;
        }

        .btn-light {
            background-color: #ffffff;
            border: none;
            color: #ef6c00;
            font-weight: 500;
        }

        .btn-light:hover {
            background-color: #ffe0b2;
            color: #e65100;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>🍽️ Admin Kantin</h4>

        <a href="{{ route('admin.dashboard.page', 'kategori') }}" class="nav-link-custom">
            <i data-lucide="folder"></i> Kategori
        </a>
        <a href="{{ route('admin.dashboard.page', 'makanan') }}" class="nav-link-custom">
            <i data-lucide="pizza"></i> Makanan
        </a>
        <a href="{{ route('admin.dashboard.page', 'minuman') }}" class="nav-link-custom">
            <i data-lucide="coffee"></i> Minuman
        </a>
        <a href="{{ route('admin.dashboard.page', 'snack') }}" class="nav-link-custom">
            <i data-lucide="cookie"></i> Snack
        </a>

        <form action="{{ route('logout') }}" method="POST" class="logout-btn">
            @csrf
            <button type="submit" class="btn btn-light w-100">Logout</button>
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            lucide.createIcons();
        });
    </script>
</body>
</html>
