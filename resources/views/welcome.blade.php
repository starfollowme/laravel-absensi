<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Absen Sebelas</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* CSS Reset dan Body Styling */
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            font-family: 'Poppins', sans-serif;
            background-color: #EFEFEF; /* Warna abu-abu muda seperti di foto */
        }

        /* Container utama */
        .container {
            max-width: 450px;
            margin: 0 auto;
            padding: 0;
        }

        /* Styling untuk gambar header */
        .header-image {
            width: 100%;
            height: 30vh; /* Tinggi gambar sekitar 30% dari layar */
            object-fit: cover;
        }

        /* Area konten login */
        .login-content {
            background-color: #EFEFEF;
            padding: 40px 25px 25px 25px;
            /* Trik untuk membuat sudut melengkung di atas gambar */
            margin-top: -60px;
            border-top-left-radius: 45px;
            border-top-right-radius: 45px;
            position: relative;
            z-index: 2;
        }

        /* Judul utama */
        .main-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
        }

        /* Sub-judul "Login Sebagai" */
        .subtitle {
            font-size: 1rem;
            font-weight: 600;
            color: #555;
            margin-bottom: 15px;
        }

        /* Styling untuk tombol */
        .btn-login {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 15px 25px;
            margin-bottom: 15px;
            border-radius: 12px;
            background-color: #5897FB; /* Warna biru yang cocok dengan foto */
            color: white;
            text-decoration: none; /* Menghapus garis bawah pada link */
            font-size: 1.25rem;
            font-weight: 600;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Efek bayangan */
            transition: all 0.2s ease-in-out;
        }

        .btn-login:hover {
            transform: translateY(-2px); /* Efek sedikit terangkat saat disentuh */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
            background-color: #4a88e9;
        }

        /* Styling untuk ikon di dalam tombol */
        .btn-login .icon {
            font-size: 2.2rem; /* Ukuran ikon lebih besar */
            margin-right: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <img src="{{ asset('assets/images/Form Login.png') }}" alt="Header SMKN 11 Bandung" class="header-image">

        <div class="login-content">
            <h1 class="main-title">e-Absen Sebelas</h1>
            <p class="subtitle">Login Sebagai</p>

            <a href="#" class="btn-login">
                <i class="bi bi-mortarboard-fill icon"></i>
                <span>MURID</span>
            </a>

            <a href="#" class="btn-login">
                <i class="bi bi-person-fill icon"></i>
                <span>GURU</span>
            </a>
        </div>
    </div>

</body>
</html>