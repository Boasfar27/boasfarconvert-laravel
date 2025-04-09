<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Boasfar Convert</title>
    <style>
        /* Reset CSS */
        body,
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        table,
        td,
        div {
            margin: 0;
            padding: 0;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.5;
        }

        body {
            background-color: #f5f5f5;
            color: #333333;
            -webkit-font-smoothing: antialiased;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #121212;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #2a2a2a;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #6d28d9;
            padding: 25px;
            text-align: center;
        }

        .email-logo {
            width: 180px;
            margin: 0 auto;
        }

        .email-body {
            padding: 40px 30px;
            color: #e0e0e0;
            background-color: #1a1a1a;
        }

        .greeting {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .email-text {
            margin-bottom: 25px;
            font-size: 16px;
        }

        .verify-button {
            display: inline-block;
            background-color: #6d28d9;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 25px;
            font-weight: 600;
            font-size: 16px;
            border-radius: 6px;
            margin: 10px 0 25px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .verify-button:hover {
            background-color: #5b21b6;
        }

        .alternate-link {
            margin-top: 25px;
            font-size: 14px;
            color: #a0a0a0;
        }

        .alternate-link a {
            color: #8b5cf6;
            text-decoration: none;
        }

        .alternate-link a:hover {
            text-decoration: underline;
        }

        .features-section {
            margin-top: 35px;
            padding-top: 25px;
            border-top: 1px solid #2a2a2a;
        }

        .features-title {
            font-size: 18px;
            color: #ffffff;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .feature-item {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }

        .feature-icon {
            width: 24px;
            height: 24px;
            background-color: rgba(109, 40, 217, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #8b5cf6;
            font-weight: bold;
        }

        .feature-text {
            font-size: 14px;
            color: #d1d1d1;
        }

        .email-footer {
            background-color: #121212;
            padding: 25px;
            text-align: center;
            color: #888888;
            font-size: 13px;
            border-top: 1px solid #2a2a2a;
        }

        .social-icons {
            margin: 15px 0;
        }

        .social-icons a {
            display: inline-block;
            margin: 0 8px;
            color: #8b5cf6;
            text-decoration: none;
        }

        .copyright {
            margin-top: 10px;
        }

        @media only screen and (max-width: 600px) {
            .email-wrapper {
                width: 100%;
                border-radius: 0;
            }

            .email-body {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-header">
            <div style="text-align: center; padding: 10px 0;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="32" height="32"
                    style="display: inline-block; vertical-align: middle; margin-right: 8px;">
                    <path
                        d="M19.89 10.105a8.696 8.696 0 00-.789-1.456l-1.658 1.119a6.606 6.606 0 00-12.223 2.858 6.65 6.65 0 006.631 6.631A6.606 6.606 0 0018.103 12.5h-2.094a4.54 4.54 0 01-4.54 4.54 4.588 4.588 0 01-4.54-4.54 4.54 4.54 0 014.54-4.54 4.505 4.505 0 012.616.833l-1.532 1.03L19.89 10.106z" />
                </svg>
                <span
                    style="font-size: 28px; font-weight: 700; color: white; letter-spacing: 0.5px; display: inline-block; vertical-align: middle;">
                    Boasfar Convert
                </span>
            </div>
        </div>

        <div class="email-body">
            <h1 class="greeting">Halo!</h1>

            <p class="email-text">Terima kasih telah mendaftar di Boasfar Convert. Silakan klik tombol di bawah untuk
                memverifikasi alamat email Anda.</p>

            <a href="{{ $url }}" class="verify-button">Verifikasi Email</a>

            <p class="email-text">Dengan mendaftar, Anda dapat mengakses berbagai fitur konversi yang handal dan
                profesional untuk kebutuhan Anda.</p>

            <div class="features-section">
                <h2 class="features-title">Fitur Premium Menunggu Anda</h2>

                <div class="feature-item">
                    <div class="feature-icon">✓</div>
                    <div class="feature-text">Konversi gambar JPG/PNG ke WebP dengan kualitas terbaik</div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">✓</div>
                    <div class="feature-text">Konversi PDF ke Word dengan hasil yang sempurna</div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">✓</div>
                    <div class="feature-text">Konversi Word ke PDF dengan format yang terjaga</div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">✓</div>
                    <div class="feature-text">Konversi cepat tanpa batas dengan akun premium</div>
                </div>
            </div>

            <p class="alternate-link">
                Jika Anda mengalami masalah dengan tombol di atas, salin dan tempel URL ini ke browser Anda:
                <br>
                <a href="{{ $url }}">{{ $url }}</a>
            </p>

            <p class="email-text">Jika Anda tidak membuat akun ini, abaikan email ini.</p>
        </div>

        <div class="email-footer">
            <div class="social-icons">
                <a href="#">Twitter</a>
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
            </div>

            <p>Salam,<br>Tim Boasfar Convert</p>

            <p class="copyright">© {{ date('Y') }} Boasfar Convert. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
