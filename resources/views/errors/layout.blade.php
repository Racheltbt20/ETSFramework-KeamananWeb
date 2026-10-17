<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-10 rounded-2xl shadow text-center max-w-md">
        <p class="text-5xl font-bold text-gray-800 mb-2">@yield('code')</p>
        <h1 class="text-xl font-semibold mb-2">@yield('title')</h1>
        <p class="text-gray-500 mb-6">@yield('message')</p>
        <a href="{{ url('/') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>