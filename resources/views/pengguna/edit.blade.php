
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengguna</title>
</head>
<body>
    <h1>Edit Pengguna</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('pengguna.update', $pengguna->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>Nama Pengguna</label><br>
            <input type="text" name="nama_pengguna"
                   value="{{ old('nama_pengguna', $pengguna->nama_pengguna) }}"
                   required>
        </p>

        <p>
            <label>Email</label><br>
            <input type="email" name="email"
                   value="{{ old('email', $pengguna->email) }}" required>
        </p>

        <p>
            <label>Password baru (kosongkan jika tidak diubah)</label><br>
            <input type="password" name="password">
        </p>

        <button type="submit">Perbarui</button>
        <a href="{{ route('pengguna.index') }}">Kembali</a>
    </form>
</body>
</html>
