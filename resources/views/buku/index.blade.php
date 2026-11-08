<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas Mahasiswa</title>
</head>

<body>
    <h1>Daftar Tugas Mahasiswa</h1>

    <h2>Tambah Tugas</h2>

    <form action="{{ route('tugas.store') }}" method="POST">
        @csrf

        <label>Nama Tugas:</label><br>
        <input type="text" name="nama_tugas" required>
        <br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi"></textarea>
        <br><br>

        <label>Deadline:</label><br>
        <input type="date" name="deadline">
        <br><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="belum">Belum</option>
            <option value="selesai">Selesai</option>
        </select>
        <br><br>

        <button type="submit">Simpan Tugas</button>
    </form>

    <hr>

    <h2>Daftar Tugas</h2>

    @if ($tugas->isEmpty())
        <p>Belum ada tugas.</p>
    @else
        <ul>
            @foreach ($tugas as $item)
                <li>
                    <strong>{{ $item->nama_tugas }}</strong><br>
                    Deskripsi: {{ $item->deskripsi ?? '-' }}<br>
                    Deadline: {{ $item->deadline ?? '-' }}<br>
                    Status: {{ $item->status }}

                    <form action="{{ route('tugas.updateStatus', $item->id) }}"
                          method="POST">
                        @csrf
                        @method('PATCH')

                        <button type="submit">
                            {{ $item->status === 'belum'
                                ? 'Tandai Selesai'
                                : 'Tandai Belum' }}
                        </button>
                    </form>

                    <form action="{{ route('tugas.destroy', $item->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit">Hapus</button>
                    </form>
                </li>
                <br>
            @endforeach
        </ul>
    @endif
</body>
</html>
