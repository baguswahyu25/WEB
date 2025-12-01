<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verifikasi Email</title>
</head>

<body style="background:#f5f7fa; padding:30px; font-family:Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="480" cellpadding="0" cellspacing="0" style="background:white; border-radius:12px; overflow:hidden;">
                    
                    <tr>
                        <td style="background:#3b82f6; padding:25px; color:white; text-align:center;">
                            <h2 style="margin:0; font-size:22px;">Verifikasi Email Anda</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:25px; color:#333;">
                            <p style="font-size:15px;">
                                Halo, <strong>{{ $user->name }}</strong> 👋
                            </p>

                            <p style="font-size:15px;">
                                Terima kasih telah mendaftar! Klik tombol di bawah untuk memverifikasi alamat email Anda.
                            </p>

                            <p style="text-align:center; margin:30px 0;">
                                <a href="{{ $verificationUrl }}"
                                style="background:#3b82f6; color:white; padding:12px 24px; text-decoration:none; border-radius:6px; font-size:16px;">
                                    Verifikasi Email
                                </a>
                            </p>

                            <p style="font-size:14px; color:#666;">
                                Jika tombol tidak berfungsi, salin dan tempel link berikut ke browser:
                            </p>

                            <p style="word-break:break-all; font-size:14px; color:#6366f1;">
                                {{ $verificationUrl }}
                            </p>

                            <p style="font-size:13px; color:#999; margin-top:30px;">
                                Email ini otomatis dikirim. Mohon tidak membalas pesan ini.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background:#f0f0f0; padding:15px; text-align:center; color:#777; font-size:12px;">
                            © {{ date('Y') }} DriveNusa. Semua hak dilindungi.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
