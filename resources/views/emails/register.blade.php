<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih Telah Mendaftar</title>
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
        .info-box {
            background-color: #f0f9f4;
            border-left: 4px solid #02743D;
            padding: 15px;
            margin: 20px 0;
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
        <div class="content">
            <h2>Terima Kasih Telah Mendaftar!</h2>
            <p>Halo <strong>{{ $name }}</strong>,</p>
            <p>Terima kasih telah mendaftar sebagai anggota Asosiasi Alumni Doktor Riset Manajemen Binus University.</p>

            <div class="info-box">
                <p><strong>Status Akun:</strong> Sedang Dalam Proses Validasi</p>
                <p>Akun Anda akan divalidasi oleh tim kami terlebih dahulu sebelum dapat digunakan. Proses ini biasanya memakan waktu 1-3 hari kerja.</p>
            </div>

            <p>Anda akan menerima email konfirmasi setelah akun Anda disetujui dan siap digunakan.</p>

            <p>Salam hangat,<br>
            <strong>Tim Asosiasi Alumni DRM Binus University</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ now()->year }} Asosiasi Alumni Doktor Riset Manajemen Binus University. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
