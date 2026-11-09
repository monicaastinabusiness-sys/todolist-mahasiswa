<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - To-Do List Mahasiswa</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #182746, #536da8);
        }

        .container {
            width: 390px;
            max-width: 90%;
            background: white;
            padding: 38px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .logo {
            width: 55px;
            height: 55px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #e9efff;
            color: #263e70;
            font-size: 28px;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            color: #253352;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #7b8498;
            font-size: 13px;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #34415d;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #dce1ec;
            border-radius: 7px;
            outline: none;
        }

        input:focus {
            border-color: #536da8;
        }

        button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 7px;
            background: #263e70;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #1b2e56;
        }

        .login {
            text-align: center;
            margin-top: 22px;
            font-size: 13px;
            color: #7b8498;
        }

        .login a {
            color: #263e70;
            font-weight: bold;
            text-decoration: none;
        }

        .error {
            color: #d93636;
            background: #fff0f0;
            padding: 10px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="logo">✓</div>

        <h2>Buat Akun</h2>
        <p class="subtitle">Daftar To-Do List Mahasiswa</p>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <label>Nama Pengguna</label>
            <input
                type="text"
                name="nama_pengguna"
                placeholder="Masukkan nama"
                value="{{ old('nama_pengguna') }}"
                required
            >

            <label>Email</label>
            <input
                type="email"
                name="email"
                placeholder="Masukkan email"
                value="{{ old('email') }}"
                required
            >

            <label>Password</label>
            <input
                type="password"
                name="password"
                placeholder="Minimal 8 karakter"
                required
            >

            <label>Konfirmasi Password</label>
            <input
                type="password"
                name="password_confirmation"
                placeholder="Ulangi password"
                required
            >

            <button type="submit">Daftar</button>
        </form>

        <div class="login">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </div>

    </div>
</body>
</html>
```