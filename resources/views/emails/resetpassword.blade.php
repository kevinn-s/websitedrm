<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi</title>
    <style>
        :root {
            color-scheme: light;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 100%;
            min-height: 100vh;
            background-color: #f4f6f8;
            font-family: 'Sora', 'Noto Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: #1f2933;
            padding: 1.5rem;
        }
        .title {
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
        }

        .email-wrapper {
            max-width: 32rem;
            margin: 0 auto;
            background-color: #ffffff;
            border: 0.3px solid #e5e7eb;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .email-header {
            border-bottom: 0.3px solid #e5e7eb;
            padding: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
        }

        .email-header img {
            width: 5rem;
            height: auto;
        }

        .email-body {
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #4b5563;
        }

        .highlight {
            color: #014122;
            font-weight: 600;
        }

        .cta {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .cta-label {
            font-size: 0.85rem;
            color: #6b7280;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.75rem 1.25rem;
            background-color: rgb(2, 116, 61);
            border: none;
            border-bottom: 4px solid rgb(1, 65, 34);
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary span {
            display: inline-block;
        }

        .info-banner {
            background-color: rgba(2, 116, 61, 0.08);
            color: rgb(2, 116, 61);
            border: 0.3px solid rgba(1, 65, 34, 0.4);
            padding: 1rem 1.25rem;
            font-size: 0.88rem;
            line-height: 1.5;
        }

        .fallback-link {
            font-size: 0.85rem;
            color: #4b5563;
            word-break: break-all;
        }

        .footer {
            border-top: 0.3px solid #e5e7eb;
            padding: 1.25rem 1.75rem;
            font-size: 0.8rem;
            color: #94a3b8;
            line-height: 1.5;
            text-align: center;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: #0f172a;
                color: #f8fafc;
            }
            .section-title {
                color: white;
            }


            .email-wrapper {
                background-color: #111827;
                border-color: rgba(148, 163, 184, 0.2);
            }

            .email-header,
            .footer {
                border-color: rgba(148, 163, 184, 0.2);
                background-color: #111827;
            }

            .section-subtitle,
            .fallback-link {
                color: #cbd5f5;
            }

            .info-banner {
                background-color: rgba(2, 116, 61, 0.15);
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <img src="{{ asset('images/drm.webp') }}" alt="DRM Logo">
        </div>
        <div class="email-body">
            <div>
                <h1 class="section-title">Reset Kata Sandi</h1>
                <p class="section-subtitle">
                    Halo <span class="highlight">{{ $name }}</span>,<br>
                    Kami menerima permintaan untuk mengatur ulang kata sandi akun Anda. Jika Anda memang mengajukan permintaan ini, silakan lanjutkan melalui tautan di bawah.
                </p>
            </div>

            <div class="cta">
                <a href="{{ $reset_link }}" class="btn-primary" target="_blank" rel="noopener">
                    <span>Reset Kata Sandi</span>
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z" fill="#ffffff" />
                    </svg>
                </a>
                <p class="fallback-link">Jika tombol tidak berfungsi, salin dan tempel tautan ini di peramban Anda:<br{{$reset_link}}</p>
            </div>

            <div class="info-banner">
                Tautan reset hanya berlaku selama 1 jam. Harap gunakan sebelum waktu tersebut agar tidak perlu meminta tautan baru.
            </div>

            <p class="section-subtitle">
                Jika Anda tidak merasa meminta reset kata sandi, abaikan email ini. Akun Anda tetap aman dan tidak ada perubahan apa pun yang dilakukan.
            </p>

            <p class="section-subtitle">
                Terima kasih,<br>
                <strong>Asosiasi Alumni Doktor Riset dan Manajemen Binus University</strong><br>
                <a href="https://www.asosiasidrm.id" style="color: rgb(2, 116, 61); text-decoration: none;">efwefwfwef</a>
            </p>
        </div>
        <div class="footer">
            &copy; {{ now()->year }} Seluruh hak cipta dilindungi.
        </div>
    </div>
</body>
</html>
