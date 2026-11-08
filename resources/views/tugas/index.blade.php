<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Semua Tugas</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 20px;
            background: #f3f6fb;
            font-family: Arial, sans-serif;
            color: #1f2937;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        h1 {
            color: #1e3a8a;
            margin-bottom: 25px;
        }

        h2 {
            font-size: 21px;
            margin-bottom: 15px;
        }

        .section {
            background: white;
            padding: 24px;
            margin-bottom: 24px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }

        .task-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 15px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .task-item:last-child {
            border-bottom: none;
        }

        .task-item input[type="checkbox"] {
            width: 19px;
            height: 19px;
            margin-top: 2px;
            accent-color: #2563eb;
            flex-shrink: 0;
        }

        .task-info {
            flex: 1;
            min-width: 0;
        }

        .matkul {
            font-size: 17px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .pemilik {
            font-size: 14px;
            color: #6b7280;
        }

        .nama-pengguna {
            color: #2563eb;
            font-weight: bold;
            text-decoration: none;
        }

        .nama-pengguna:hover {
            text-decoration: underline;
        }

        .empty {
            color: #6b7280;
            padding: 10px 0;
        }

        .user-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 16px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .user-item:last-child {
            border-bottom: none;
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            display: inline-block;
            font-size: 18px;
            margin-bottom: 6px;
        }

        .user-email {
            color: #6b7280;
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        .button {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 14px;
            border-radius: 7px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .button:hover {
            background: #1d4ed8;
        }

        .button-delete {
            background: #dc2626;
            flex-shrink: 0;
        }

        .button-delete:hover {
            background: #b91c1c;
        }

        .form-group {
            margin-bottom: 14px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 18px;
        }

        .error {
            color: #b91c1c;
            margin-top: 5px;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            body {
                padding: 18px 12px;
            }

            .section {
                padding: 17px;
            }

            .user-item {
                align-items: flex-start;
                gap: 10px;
            }

            .user-name {
                font-size: 17px;
            }

            .button-delete {
                padding: 9px 12px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Daftar Semua Tugas</h1>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    {{-- DAFTAR SEMUA TUGAS --}}
    <div class="section">
        <h2>Daftar Tugas</h2>

        @forelse ($tugas as $item)
            <div class="task-item">
                <input type="checkbox" disabled aria-label="Tugas">

                <div class="task-info">
                    <div class="matkul">
                        {{ $item->mataKuliah?->nama_matkul ?? 'Mata kuliah belum dipilih' }}
                    </div>

                    <div class="pemilik">
                        Pengguna:
                        @if ($item->pengguna)
                            <a
                                class="nama-pengguna"
                                href="{{ route('pengguna.login', $item->pengguna->id) }}"
                            >
                                {{ $item->pengguna->nama_pengguna }}
                            </a>
                        @else
                            Belum ditentukan
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="empty">Belum ada tugas yang terdaftar.</p>
        @endforelse
    </div>

    {{-- DAFTAR PENGGUNA --}}
    <div class="section">
        <h2>Daftar Pengguna</h2>

        @forelse ($pengguna as $user)
            <div class="user-item">

                <div class="user-info">
                    <a
                        class="nama-pengguna user-name"
                        href="{{ route('pengguna.login', $user->id) }}"
                    >
                        {{ $user->nama_pengguna }}
                    </a>

                    <div class="user-email">
                        {{ $user->email }}
                    </div>
                </div>

                <form
                    action="{{ route('pengguna.destroy', $user->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus pengguna {{ $user->nama_pengguna }}? Tugasnya akan tetap tersimpan, tetapi tidak lagi terhubung dengan pengguna ini.');"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="button button-delete">
                        Hapus
                    </button>
                </form>

            </div>
        @empty
            <p class="empty">Belum ada pengguna.</p>
        @endforelse
    </div>

    {{-- FORM TAMBAH PENGGUNA --}}
    <div class="section">
        <h2>Tambah Pengguna</h2>

        <form action="{{ route('pengguna.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_pengguna">Nama Pengguna</label>
                <input
                    type="text"
                    id="nama_pengguna"
                    name="nama_pengguna"
                    value="{{ old('nama_pengguna') }}"
                    required
                >
                @error('nama_pengguna')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                >
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password (minimal 4 karakter)</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    minlength="4"
                    required
                >
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button class="button" type="submit">Tambah Pengguna</button>
        </form>
    </div>

    {{-- FORM TAMBAH MATA KULIAH --}}
    <div class="section">
        <h2>Tambah Mata Kuliah</h2>

        <form action="{{ route('mataKuliah.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_matkul">Nama Mata Kuliah</label>
                <input
                    type="text"
                    id="nama_matkul"
                    name="nama_matkul"
                    required
                >
            </div>

            <div class="form-group">
                <label for="dosen">Nama Dosen</label>
                <input
                    type="text"
                    id="dosen"
                    name="dosen"
                    required
                >
            </div>

            <div class="form-group">
                <label for="semester">Semester</label>
                <input
                    type="text"
                    id="semester"
                    name="semester"
                    required
                >
            </div>

            <button class="button" type="submit">Tambah Mata Kuliah</button>
        </form>
    </div>

    {{-- FORM TAMBAH TUGAS --}}
    <div class="section">
        <h2>Tambah Tugas</h2>

        <form action="{{ route('tugas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_tugas">Nama Tugas</label>
                <input
                    type="text"
                    id="nama_tugas"
                    name="nama_tugas"
                    value="{{ old('nama_tugas') }}"
                    required
                >
                @error('nama_tugas')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="3"
                >{{ old('deskripsi') }}</textarea>
            </div>

            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input
                    type="date"
                    id="deadline"
                    name="deadline"
                    value="{{ old('deadline') }}"
                >
            </div>

            <div class="form-group">
                <label for="pengguna_id">Pemilik Tugas</label>
                <select id="pengguna_id" name="pengguna_id">
                    <option value="">Pilih Pengguna</option>
                    @foreach ($pengguna as $user)
                        <option
                            value="{{ $user->id }}"
                            @selected(old('pengguna_id') == $user->id)
                        >
                            {{ $user->nama_pengguna }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="mata_kuliah_id">Mata Kuliah</label>
                <select id="mata_kuliah_id" name="mata_kuliah_id">
                    <option value="">Pilih Mata Kuliah</option>
                    @foreach ($mataKuliah as $matkul)
                        <option
                            value="{{ $matkul->id }}"
                            @selected(old('mata_kuliah_id') == $matkul->id)
                        >
                            {{ $matkul->nama_matkul }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="button" type="submit">Tambah Tugas</button>
        </form>
    </div>

</div>
</body>
</html>
