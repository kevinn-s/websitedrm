<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih Atas Kontribusi Anda</title>
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
        .header-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            background-color: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
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
        .info-box p {
            margin: 8px 0;
        }
        .info-box .label {
            color: #666;
            font-size: 13px;
            margin-bottom: 2px;
        }
        .info-box .value {
            font-weight: 600;
            color: #02743D;
            font-size: 15px;
        }
        .highlight-box {
            background: linear-gradient(135deg, #02743D 0%, #14a15b 100%);
            color: #ffffff;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
        }
        .highlight-box .amount {
            font-size: 28px;
            font-weight: bold;
            margin: 10px 0;
        }
        .highlight-box .label {
            font-size: 14px;
            opacity: 0.9;
        }
        .message-box {
            background-color: #fffbeb;
            border-left: 4px solid #f59e0b;
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
        .button {
            display: inline-block;
            background-color: #02743D;
            color: #ffffff !important;
            padding: 12px 30px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 15px;
        }
        .divider {
            height: 1px;
            background-color: #e5e5e5;
            margin: 25px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/drm.jpg') }}" alt="DRM Logo">
        </div>

        <div class="header">
            <div class="header-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <h1>Kontribusi Anda Telah Diterima!</h1>
        </div>

        <div class="content">
            <h2>Terima Kasih, {{ $name }}!</h2>

            <p>Kami sangat mengapresiasi kontribusi yang Anda berikan untuk Asosiasi Alumni Doktor Riset Manajemen Binus University.</p>

            <div class="highlight-box">
                <div class="label">Nominal Kontribusi</div>
                <div class="amount">Rp {{ number_format((float) str_replace(['.', ','], ['', '.'], $amount), 0, ',', '.') }}</div>
                <div class="label">{{ $contributionType }}</div>
            </div>

            <div class="info-box">
                <p class="label">Jenis Kontribusi</p>
                <p class="value">{{ $contributionType }}</p>

                <p class="label" style="margin-top: 15px;">Tanggal Pembayaran</p>
                <p class="value">{{ $date }}</p>

                <p class="label" style="margin-top: 15px;">Status</p>
                <p class="value">Sedang Diverifikasi</p>
            </div>

            <div class="message-box">
                <p style="margin: 0;"><strong>📋 Proses Verifikasi</strong></p>
                <p style="margin: 8px 0 0 0; font-size: 14px;">Tim kami akan memverifikasi bukti transfer Anda dalam waktu 1-3 hari kerja. Anda akan menerima notifikasi setelah proses verifikasi selesai.</p>
            </div>

            <div class="divider"></div>

            <p>Dukungan Anda sangat berarti bagi kami. Kontribusi ini akan digunakan untuk:</p>
            <ul style="color: #555; padding-left: 20px;">
                <li>Pengembangan program dan kegiatan alumni</li>
                <li>Penyelenggaraan seminar dan workshop</li>
                <li>Pembangunan jaringan profesional</li>
                <li>Kegiatan pengabdian masyarakat</li>
            </ul>

            <p style="text-align: center; margin-top: 25px;">
                <a href="{{ url('/') }}" class="button">Kunjungi Website</a>
            </p>

            <div class="divider"></div>

            <p>Salam hangat,<br>
            <strong>Tim Asosiasi Alumni DRM Binus University</strong></p>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
            <p>&copy; {{ now()->year }} Asosiasi Alumni Doktor Riset Manajemen Binus University. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
