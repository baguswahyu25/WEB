<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Berhasil Diverifikasi</title>

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0066FF, #00C2FF);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .card {
            background: white;
            color: #333;
            width: 90%;
            max-width: 420px;
            padding: 30px 25px;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.6s ease-out;
        }

        .icon-success {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #4CAF50;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px auto;
            box-shadow: 0 5px 20px rgba(76, 175, 80, 0.4);
        }

        .icon-success svg {
            width: 50px;
            height: 50px;
            fill: white;
        }

        .title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .msg {
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            background: #0066FF;
            padding: 12px 25px;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn:hover {
            background: #004cd1;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="card">

        <div class="icon-success">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M9 16.17l-3.88-3.88L4 13.41 9 18.41 20 7.41 18.59 6l-9.59 9.59z" />
            </svg>
        </div>

        <div class="title">Email Terverifikasi!</div>
        <div class="msg">
            Selamat! Email kamu sudah berhasil diaktifkan.
            Akun kamu sekarang dapat digunakan sepenuhnya.
        </div>

        <p>Silakan Login ulang</p>
    </div>

</body>

</html>
