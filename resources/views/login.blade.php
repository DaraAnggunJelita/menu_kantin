<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Kantin Kampus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #ffcc80, #ffb74d, #ff9800);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: white;
            padding: 2.5rem 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 420px;
            animation: fadeIn 0.8s ease;
        }

        .login-card h3 {
            font-weight: 600;
            color: #e65100;
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: #5d4037;
        }

        .form-control:focus {
            border-color: #fb8c00;
            box-shadow: 0 0 0 0.2rem rgba(251, 140, 0, 0.25);
        }

        .btn-primary {
            background-color: #fb8c00;
            border: none;
        }

        .btn-primary:hover {
            background-color: #ef6c00;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .logo-area {
            text-align: center;
            margin-bottom: 1rem;
        }

        .logo-area img {
            width: 70px;
            animation: zoomIn 1s ease;
        }

        @keyframes zoomIn {
            from { transform: scale(0.8); opacity: 0; }
            to   { transform: scale(1); opacity: 1; }
        }

        .footer-text {
            font-size: 0.85rem;
            color: #8d6e63;
            margin-top: 2rem;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="logo-area">
            <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" alt="kantin-logo">
        </div>

        <h3 class="text-center">Login Admin</h3>

        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Admin</label>
                <input type="email" name="email" class="form-control" placeholder="admin@example.com" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password" class="form-control" placeholder="********" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Masuk Dashboard</button>
            </div>
        </form>

        <p class="footer-text">&copy; {{ date('Y') }} Kantin Kampus — Sistem Pemesanan Makanan Mahasiswa</p>
    </div>

</body>
</html>
