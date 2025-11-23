<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Anda Telah Diverifikasi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .logo {
            background-color: #ffffff;
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid #e5e5e5;
        }
        .logo img {
            max-width: 120px;
            height: auto;
        }
        .header {
            background-color: #02743D;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .content h2 {
            color: #02743D;
            margin-top: 0;
        }
        .success-box {
            background-color: #f0f9f4;
            border-left: 4px solid #02743D;
            padding: 15px;
            margin: 20px 0;
        }
        .cta-button {
            display: inline-block;
            background-color: #02743D;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 30px;
            margin: 20px 0;
            font-weight: bold;
            text-align: center;
        }
        .cta-button:hover {
            background-color: #025a31;
        }
        .footer {
            background-color: #f8f8f8;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/drm.jpg') }}" alt="DRM Logo">
        </div>
        <div class="header">
            <h1>Akun Anda Telah Diverifikasi</h1>
        </div>
        <div class="content">
            <h2>Selamat, {{ $name }}!</h2>
            <p>Akun Anda telah berhasil diverifikasi oleh tim kami.</p>

            <div class="success-box">
                <p><strong>Status Akun:</strong> Aktif dan Terverifikasi ✓</p>
                <p>Anda sekarang dapat mengakses seluruh fitur portal alumni dan mulai terhubung dengan sesama alumni DRM Binus University.</p>
            </div>

            <p>Silakan login ke akun Anda untuk:</p>
            <ul>
                <li>Melengkapi profil alumni Anda</li>
                <li>Mengakses direktori alumni</li>
                <li>Mendaftar ke kegiatan dan acara</li>
            </ul>

            <center>
                <a href="{{ url('/login') }}" class="cta-button">Login ke Portal Alumni</a>
            </center>

            <p>Salam hangat,<br>
            <strong>Tim Asosiasi Alumni DRM Binus University</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ now()->year }} Asosiasi Alumni Doktor Riset Manajemen Binus University. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
