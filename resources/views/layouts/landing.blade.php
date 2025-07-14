<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Kantin Kampus')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #fff3e0, #ffe0b2);
            font-family: 'Poppins', sans-serif;
            color: #4e342e;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: url("https://img.freepik.com/free-photo/top-view-table-full-delicious-food-composition_23-2149141349.jpg") no-repeat center;
            background-size: cover;
            color: #ffffff;
            padding: 4rem 0;
            text-align: center;
            /* 🔴 Efek gelap dihapus: tidak pakai ::after */
        }

        header h1 {
            font-weight: 700;
            font-size: 3rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3); /* sedikit bayangan agar tetap terbaca */
        }

        header p {
            font-size: 1.2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }

        main.container {
            flex: 1;
            padding-top: 2rem;
            padding-bottom: 3rem;
        }

        footer {
            background-color: #4e342e;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: auto;
        }

        .btn-primary {
            background-color: #d84315;
            border-color: #d84315;
        }

        .btn-outline-primary {
            color: #d84315;
            border-color: #d84315;
        }

        .btn-outline-primary:hover {
            background-color: #d84315;
            color: white;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <header>
        <div class="container">
            <h1><i class="fas fa-utensils me-2"></i>Kantin Kampus</h1>
            <p class="lead">Aplikasi Pemesanan Makanan, Minuman & Snack Mahasiswa</p>
        </div>
    </header>

    {{-- KONTEN UTAMA --}}
    <main class="container">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer>
        <p>&copy; {{ date('Y') }} Kantin Kampus | Made with ❤️ for Mahasiswa</p>
    </footer>

</body>
</html>
