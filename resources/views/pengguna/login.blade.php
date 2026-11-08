<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masukkan Password</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: #1f2937;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
        }

        h1 {
            color: #1e3a8a;
            margin-top: 0;
            font-size: 27px;
        }

        p {
            line-height: 1.5;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 16px;
            margin-bottom: 18px;
        }

        button, .back-button {
            display: inline-block;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 7px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .back-button {
            margin-top: 10px;
            background: #e5e7eb;
            color: #1f2937;
        }

        .error {
            color: #b91c1c;
            background: #fee2e2;
            padding: 10px;
            border-radius: 7px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h1>Masukkan Password</h1>

        <p>
            Halo, <strong>{{ $pengguna->nama_pengguna }}</strong>!
            Masukkan password untuk melihat daftar tugasmu.
        </p>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('pengguna.authenticate', $pengguna->id) }}"
              method="POST">
            @csrf

            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                minlength="4"
                required
                autofocus
                autocomplete="current-password"
                placeholder="Masukkan password"
            >

            <button type="submit">Buka Daftar Tugas</button>
        </form>

        <a href="{{ route('tugas.index') }}" class="back-button">
            Kembali ke Daftar Pengguna
        </a>
    </div>
</body>
</html>
