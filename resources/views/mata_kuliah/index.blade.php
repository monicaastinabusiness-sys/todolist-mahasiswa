<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mata Kuliah</title>
</head>
<body>
    <h1>Data Mata Kuliah</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('mata_kuliah.create') }}">
        Tambah Mata Kuliah
    </a>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mata Kuliah</th>
                <th>Dosen</th>
                <th>Semester</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($mataKuliah as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_matkul }}</td>
                    <td>{{ $item->dosen }}</td>
                    <td>{{ $item->semester }}</td>
                    <td>
                        <a href="{{ route('mata_kuliah.edit', $item->id) }}">
                            Edit
                        </a>

                        <form
                            action="{{ route('mata_kuliah.destroy', $item->id) }}"
                            method="POST"
                            style="display:inline"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus mata kuliah ini?')"
                            >
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada mata kuliah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>