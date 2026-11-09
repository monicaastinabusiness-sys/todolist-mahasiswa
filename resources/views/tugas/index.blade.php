<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas - To-Do List Mahasiswa</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: #f4f6fc;
            color: #253352;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #182746;
            position: fixed;
            left: 0;
            top: 0;
            padding: 30px 20px;
            color: white;
        }

        .brand {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 45px;
        }

        .brand span {
            color: #9c9aff;
        }

        .menu a {
            display: block;
            color: #c5cee1;
            text-decoration: none;
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 10px;
            font-size: 14px;
            transition: 0.3s;
        }

        .menu a:hover,
        .menu a.active {
            background: #344976;
            color: white;
        }

        .logout {
            position: absolute;
            bottom: 30px;
            left: 20px;
            right: 20px;
        }

        .logout button {
            width: 100%;
            padding: 13px;
            background: #a83e53;
            border: none;
            border-radius: 9px;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        .main {
            margin-left: 250px;
            padding: 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            gap: 15px;
        }

        .topbar h1 {
            font-size: 26px;
            color: #1d2b4f;
        }

        .topbar p {
            color: #8a94a8;
            margin-top: 6px;
            font-size: 14px;
        }

        .user {
            background: white;
            padding: 12px 18px;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.04);
            font-size: 14px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }

        .card p {
            color: #8790a5;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .card h2 {
            font-size: 32px;
            color: #273b69;
        }

        .card.total {
            border-left: 5px solid #586fc1;
        }

        .card.pending {
            border-left: 5px solid #e7a83e;
        }

        .card.completed {
            border-left: 5px solid #36a77a;
        }

        .content {
            display: grid;
            grid-template-columns: minmax(260px, 0.8fr) minmax(0, 1.7fr);
            gap: 20px;
            align-items: start;
        }

        .content-box {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            min-width: 0;
        }

        .content-box h3 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin: 14px 0 7px;
        }

        input, textarea, select {
            width: 100%;
            padding: 11px;
            border: 1px solid #dce2ec;
            border-radius: 8px;
            font-size: 14px;
            background: white;
        }

        textarea {
            resize: vertical;
            min-height: 90px;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: #5268b2;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary:hover {
            background: #40569c;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 550px;
        }

        th, td {
            text-align: left;
            padding: 14px 10px;
            border-bottom: 1px solid #edf0f6;
            font-size: 13px;
        }

        th {
            color: #8790a5;
            font-weight: 600;
        }

        .status {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 12px;
        }

        .status.belum {
            background: #fff3dc;
            color: #b57b19;
        }

        .status.selesai {
            background: #e0f5eb;
            color: #26865c;
        }

        .btn-status {
            background: #e0ecff;
            color: #1d4ed8;
            border: none;
            padding: 7px 10px;
            border-radius: 7px;
            cursor: pointer;
            margin-bottom: 5px;
        }

        .btn-delete {
            background: #fee2e2;
            color: #b91c1c;
            border: none;
            padding: 7px 10px;
            border-radius: 7px;
            cursor: pointer;
        }

        .alert {
            background: #e0f5eb;
            color: #26865c;
            padding: 13px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .empty {
            text-align: center;
            color: #8790a5;
            padding: 30px;
        }

        @media(max-width: 1100px) {
            .content {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 900px) {
            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 200px;
                padding: 25px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 600px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .brand {
                margin-bottom: 20px;
            }

            .logout {
                position: static;
                margin-top: 15px;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">To-Do <span>Mahasiswa</span></div>

        <nav class="menu">
            <a href="{{ route('dashboard') }}">▣ Dashboard</a>
            <a href="{{ route('tugas.index') }}" class="active">☷ Daftar Tugas</a>
            <a href="{{ route('mata_kuliah.index') }}">▤ Mata Kuliah</a>
        </nav>

        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">↪ Logout</button>
            </form>
        </div>
    </aside>

    <main class="main">

        <div class="topbar">
            <div>
                <h1>Daftar Tugas</h1>
                <p>Kelola dan pantau semua tugas kuliahmu di sini.</p>
            </div>

            <div class="user">
                {{ Auth::user()->nama_pengguna }}
            </div>
        </div>

        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert" style="background:#fee2e2;color:#991b1b;">
                Periksa kembali data yang kamu masukkan.
                <ul style="margin:8px 0 0 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            $total = $tugas->count();
            $jumlahBelum = $tugas->where('status', 'belum')->count();
            $jumlahSelesai = $tugas->where('status', 'selesai')->count();
        @endphp

        <div class="cards">
            <div class="card total">
                <p>Total Tugas</p>
                <h2>{{ $total }}</h2>
            </div>

            <div class="card pending">
                <p>Tugas Belum Selesai</p>
                <h2>{{ $jumlahBelum }}</h2>
            </div>

            <div class="card completed">
                <p>Tugas Selesai</p>
                <h2>{{ $jumlahSelesai }}</h2>
            </div>
        </div>

        <div class="content">

            <div class="content-box">
                <h3>Tambah Tugas</h3>

                <form action="{{ route('tugas.store') }}" method="POST">
                    @csrf

                    <label>Mata Kuliah</label>
                    <select name="mata_kuliah_id" required>
                        <option value="">Pilih mata kuliah</option>
                        @foreach($mataKuliah as $matkul)
                            <option value="{{ $matkul->id }}"
                                {{ old('mata_kuliah_id') == $matkul->id ? 'selected' : '' }}>
                                {{ $matkul->nama_matkul }}
                            </option>
                        @endforeach
                    </select>

                    <label>Deskripsi Tugas</label>
                    <textarea name="deskripsi" required
                        placeholder="Masukkan deskripsi tugas">{{ old('deskripsi') }}</textarea>

                    <label>Deadline</label>
                    <input type="date" name="deadline"
                        value="{{ old('deadline') }}" required>

                    <label>Status</label>
                    <select name="status" required>
                        <option value="belum">Belum Selesai</option>
                        <option value="selesai">Selesai</option>
                    </select>

                    <button type="submit" class="btn-primary">
                        Simpan Tugas
                    </button>
                </form>
            </div>

            <div class="content-box">
                <h3>Daftar Tugas</h3>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Deskripsi</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($tugas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $item->mataKuliah->nama_matkul ?? '-' }}
                                    </td>

                                    <td>{{ $item->deskripsi }}</td>

                                    <td>
                                        {{ $item->deadline
                                            ? \Carbon\Carbon::parse($item->deadline)->format('d/m/Y')
                                            : '-' }}
                                    </td>

                                    <td>
                                        <span class="status {{ $item->status }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        <form action="{{ route('tugas.updateStatus', $item->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="btn-status">
                                                {{ $item->status === 'belum'
                                                    ? 'Selesaikan'
                                                    : 'Batalkan' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('tugas.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-delete">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="empty">
                                        Belum ada tugas. Silakan tambahkan tugas baru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </main>

</body>
</html>