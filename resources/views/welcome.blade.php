<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Absen Sebelas Login</title>
    <style>
        /* CSS untuk styling halaman */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5; /* Warna latar belakang halaman */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #ffffff;
            width: 360px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden; /* Penting untuk menjaga gambar tetap di dalam batas rounded */
            display: flex;
            flex-direction: column;
        }

        .header-image {
            width: 100%;
            height: auto;
            display: block;
        }

        .login-form {
            background-color: #e0e0e0; /* Warna abu-abu untuk area form */
            padding: 40px 30px;
            border-top-left-radius: 30px; /* Membuat lengkungan di atas form */
            border-top-right-radius: 30px;
            margin-top: -30px; /* Menarik form ke atas agar menimpa gambar */
            z-index: 1;
            position: relative;
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-field {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box; /* Agar padding tidak menambah lebar elemen */
            font-size: 16px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            font-size: 14px;
            color: #555;
        }

        .remember-me input {
            margin-right: 8px;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background-color: #4a90e2; /* Warna biru tombol */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-bottom: 2px solid #357ABD; /* Efek 3D sederhana */
        }

        .login-button:hover {
            background-color: #357ABD;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <img src="https://i.ibb.co/6yFBDj1/smkn11bandung.png" alt="Header SMKN 11 Bandung" class="header-image">

        <div class="login-form">
            <h1 class="form-title">e-Absen Sebelas</h1>
            <form action="#" method="post">
                <div class="input-group">
                    <input type="text" id="nis" name="nis" class="input-field" placeholder="Masukan NIS" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="input-field" placeholder="Password" required>
                </div>
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember Me</label>
                </div>
                <button type="submit" class="login-button">LOGIN</button>
            </form>
        </div>
    </div>

</body>
</html>