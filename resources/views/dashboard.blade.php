<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - To-Do List Mahasiswa</title>

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

        .content-box {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 10px;
        }

        .content-header h3 {
            font-size: 18px;
        }

        .content-header a {
            background: #5268b2;
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 15px 12px;
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

        .empty {
            text-align: center;
            color: #8790a5;
            padding: 30px;
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

            .content-box {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">To-Do <span>Mahasiswa</span></div>

        <nav class="menu">
            <a href="{{ route('dashboard') }}" class="active">
                ▣ Dashboard
            </a>

            <a href="{{ route('tugas.index') }}">
                ☷ Daftar Tugas
            </a>

            <a href="{{ route('mata_kuliah.index') }}">
                ▤ Mata Kuliah
            </a>
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
                <h1>Dashboard</h1>
                <p>
                    Selamat datang kembali,
                    {{ Auth::user()->nama_pengguna }}!
                </p>
            </div>

            <div class="user">
                {{ Auth::user()->nama_pengguna }}
            </div>
        </div>

        <div class="cards">

            <div class="card total">
                <p>Total Tugas</p>
                <h2>{{ $totalTugas }}</h2>
            </div>

            <div class="card pending">
                <p>Tugas Belum Selesai</p>
                <h2>{{ $tugasBelum }}</h2>
            </div>

            <div class="card completed">
                <p>Tugas Selesai</p>
                <h2>{{ $tugasSelesai }}</h2>
            </div>

        </div>

        <div class="content-box">

            <div class="content-header">
                <h3>Tugas Terbaru</h3>

                <a href="{{ route('tugas.index') }}">
                    Lihat Semua
                </a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>Deskripsi</th>
                        <th>Deadline</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($tugasTerbaru as $tugas)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $tugas->mataKuliah->nama_matkul ?? '-' }}
                            </td>

                            <td>{{ $tugas->deskripsi }}</td>

                            <td>
                                {{ $tugas->deadline
                                    ? \Carbon\Carbon::parse($tugas->deadline)->format('d/m/Y')
                                    : '-' }}
                            </td>

                            <td>
                                <span class="status {{ $tugas->status }}">
                                    {{ ucfirst($tugas->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty">
                                Belum ada tugas.
                                Silakan tambahkan tugas pertamamu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </main>

</body>
</html>
