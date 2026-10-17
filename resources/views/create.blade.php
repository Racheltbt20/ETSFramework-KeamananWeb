<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-xl mx-auto">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Tambah Mahasiswa</h1>
            <a href="{{ route('students.index') }}" class="bg-gray-300 text-gray-800 px-5 py-3 rounded-xl text-base font-medium hover:bg-gray-400">
                Kembali
            </a>
        </div>

        {{-- NOTIF ERROR --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-xl mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM CREATE --}}
        <form action="{{ route('students.store') }}" method="POST" class="bg-white p-8 rounded-2xl shadow space-y-6">
            @csrf
            <div>
                <label class="block text-base font-medium mb-2">NPM</label>
                <input type="text" name="npm" value="{{ old('npm') }}" placeholder="24081010189" 
                class="w-full border rounded-xl px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-base font-medium mb-2">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Rachel Tabita" class="w-full border rounded-xl px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-base font-medium mb-2">Jurusan</label>
                <input type="text" name="jurusan" value="{{ old('jurusan') }}" placeholder="Informatika" class="w-full border rounded-xl px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-base font-medium mb-2">Angkatan</label>
                <input type="number" name="angkatan" value="{{ old('angkatan') }}" placeholder="2024" class="w-full border rounded-xl px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-blue-600 text-white px-5 py-3 rounded-xl text-base font-medium hover:bg-blue-700">
                    Simpan
                </button>   
            </div>
        </form>

    </div>
</body>
</html>