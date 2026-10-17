<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b shadow-sm relative">
        <div class="max-w-4xl mx-auto px-8 py-3 flex justify-between items-center">
            <span class="font-bold text-gray-700">Sistem Data Mahasiswa</span>

            <div class="relative">
                <button onclick="document.getElementById('user-menu').classList.toggle('hidden'); document.getElementById('chevron').classList.toggle('rotate-180')"
                    class="flex items-center gap-2 text-sm text-gray-700 hover:bg-gray-100 px-3 py-1.5 rounded-lg transition">
                    <span>Halo, {{ auth()->user()->name }}</span>
                    <svg id="chevron" class="w-4 h-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div id="user-menu" class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-xl shadow-lg py-1 z-50">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto p-8">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Data Mahasiswa</h1>
            <a href="{{ route('students.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700">
                + Tambah Mahasiswa
            </a>
        </div>

        {{-- SEARCH BAR --}}
        <form method="GET" action="{{ route('students.index') }}" class="mb-4 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama atau NPM..."
                class="flex-1 border rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-gray-800 text-white px-5 py-2 rounded-xl hover:bg-gray-700">
                Cari
            </button>
            @if (request('search'))
                <a href="{{ route('students.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-300">
                    Reset
                </a>
            @endif
        </form>

        {{-- NOTIF SUKSES --}}
        @if (session('success'))
            <div id="alert-success" class="bg-green-100 text-green-700 px-4 py-2 rounded-xl mb-4 flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="document.getElementById('alert-success').remove()" class="text-green-700 hover:text-green-900 font-bold px-2">
                    &times;
                </button>
            </div>
        @endif

        {{-- Tabel DATA MAHASISWA --}}
        <table class="w-full bg-white rounded-2xl shadow overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">NPM</th>
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">Jurusan</th>
                    <th class="px-4 py-2 text-left">Angkatan</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $student->npm }}</td>
                        <td class="px-4 py-2">{{ $student->nama }}</td>
                        <td class="px-4 py-2">{{ $student->jurusan }}</td>
                        <td class="px-4 py-2">{{ $student->angkatan }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('students.edit', $student->id) }}?search={{ request('search') }}" class="text-yellow-600 hover:underline mr-2">
                                Edit
                            </a>

                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                            Belum ada data mahasiswa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</body>
</html>