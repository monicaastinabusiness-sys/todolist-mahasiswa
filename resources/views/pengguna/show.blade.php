<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas Pengguna</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 30px 20px;
            color: #1f2937;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .header, .card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        h1, h2 {
            margin-top: 0;
            color: #1e3a8a;
        }

        .email {
            color: #6b7280;
        }

        .task {
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 0;
        }

        .task:last-child {
            border-bottom: none;
        }

        .info {
            margin: 8px 0;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #fef3c7;
            color: #92400e;
            font-size: 13px;
        }

        .status.selesai {
            background: #d1fae5;
            color: #065f46;
        }

        .warning {
            color: #b91c1c;
            background: #fee2e2;
            padding: 10px 12px;
            border-radius: 7px;
            font-weight: bold;
        }

        .today {
            color: #9a3412;
            background: #ffedd5;
            padding: 10px 12px;
            border-radius: 7px;
            font-weight: bold;
        }

        .button {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 16px;
            text-decoration: none;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-size: 14px;
        }

        .button:hover {
            background: #1d4ed8;
        }

        .button.selesai {
            background: #059669;
        }

        .button.selesai:hover {
            background: #047857;
        }

        .success {
            color: #166534;
            background: #dcfce7;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 18px;
        }

        .error {
            color: #991b1b;
            background: #fee2e2;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 18px;
        }

        .empty {
            color: #6b7280;
        }

        @media (max-width: 600px) {
            body {
                padding: 15px;
            }

            .header, .card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">
            <h1>{{ $pengguna->nama_pengguna }}</h1>
            <p class="email">{{ $pengguna->email }}</p>

            <a href="{{ route('tugas.index') }}" class="button">
                Kembali ke Daftar Utama
            </a>
        </div>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <div class="card">
            <h2>Daftar Tugas</h2>

            @forelse ($pengguna->tugas as $item)
                <div class="task">
                    <h3>{{ $item->nama_tugas }}</h3>

                    <p class="info">
                        <strong>Deskripsi:</strong>
                        {{ $item->deskripsi ?: 'Tidak ada deskripsi' }}
                    </p>

                    <p class="info">
                        <strong>Mata Kuliah:</strong>
                        {{ $item->mataKuliah?->nama_matkul ?? 'Belum ditentukan' }}
                    </p>

                    <p class="info">
                        <strong>Dosen:</strong>
                        {{ $item->mataKuliah?->dosen ?? 'Belum ditentukan' }}
                    </p>

                    <p class="info">
                        <strong>Deadline:</strong>
                        {{ $item->deadline ?: 'Belum ditentukan' }}
                    </p>

                    <p class="info">
                        <strong>Status:</strong>
                        <span class="status {{ $item->status === 'selesai' ? 'selesai' : '' }}">
                            {{ $item->status === 'selesai' ? 'Selesai' : 'Belum Selesai' }}
                        </span>
                    </p>

                    @if (
                        $item->status === 'belum' &&
                        $item->deadline !== null &&
                        \Carbon\Carbon::parse($item->deadline)->lt(today())
                    )
                        <p class="warning">⚠ Deadline Terlewat!</p>
                    @elseif (
                        $item->status === 'belum' &&
                        $item->deadline !== null &&
                        \Carbon\Carbon::parse($item->deadline)->isToday()
                    )
                        <p class="today">⚠ Deadline Hari Ini!</p>
                    @endif

                    <form
                        action="{{ route('tugas.updateStatus', $item->id) }}"
                        method="POST"
                        style="margin-top: 15px;"
                    >
                        @csrf
                        @method('PATCH')

                        @if ($item->status === 'selesai')
                            <button type="submit" class="button">
                                Tandai Belum Selesai
                            </button>
                        @else
                            <button type="submit" class="button selesai">
                                Tandai Selesai
                            </button>
                        @endif
                    </form>
                </div>
            @empty
                <p class="empty">Pengguna ini belum memiliki tugas.</p>
            @endforelse
        </div>

    </div>
</body>
</html>
