<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengguna</title>
</head>
<body>
    <h1>Tambah Pengguna</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('pengguna.store') }}" method="POST">
        @csrf

        <label>Nama Pengguna</label>
        <input
            type="text"
            name="nama_pengguna"
            value="{{ old('nama_pengguna') }}"
            required
        >
        <br><br>

        <label>Email</label>
        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
        >
        <br><br>

        <label>Password</label>
        <input type="password" name="password" required>
        <br><br>

        <button type="submit">Simpan</button>
        <a href="{{ route('pengguna.index') }}">Kembali</a>
    </form>
</body>
</html>