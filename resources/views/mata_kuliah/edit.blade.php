
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mata Kuliah</title>
</head>
<body>
    <h1>Edit Mata Kuliah</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('mata_kuliah.update', $mataKuliah->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>Nama Mata Kuliah</label><br>
            <input type="text" name="nama_matkul"
                   value="{{ old('nama_matkul', $mataKuliah->nama_matkul) }}"
                   required>
        </p>

        <p>
            <label>Nama Dosen</label><br>
            <input type="text" name="dosen"
                   value="{{ old('dosen', $mataKuliah->dosen) }}" required>
        </p>

        <p>
            <label>Semester (1–8)</label><br>
            <input type="number" name="semester"
                   min="1" max="8"
                   value="{{ old('semester', $mataKuliah->semester) }}"
                   required>
        </p>

        <button type="submit">Perbarui</button>
        <a href="{{ route('mata_kuliah.index') }}">Kembali</a>
    </form>
</body>
</html>
