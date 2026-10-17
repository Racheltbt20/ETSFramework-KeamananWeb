<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow w-full max-w-sm">
        <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded-xl mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('lockout_seconds'))
            <div id="lockout-box" class="bg-red-100 text-red-700 px-4 py-2 rounded-xl mb-4 text-sm">
                Terlalu banyak percobaan login. Coba lagi dalam
                <span id="countdown" class="font-bold"></span>.
            </div>
        @endif

        <form action="{{ route('login.attempt') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border rounded-xl px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full border rounded-xl px-4 py-2 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button id="login-btn" type="submit" class="w-full bg-blue-600 text-white py-2 rounded-xl font-medium hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>

    @if (session('lockout_seconds'))
        <script>
            let remaining = {{ (int) session('lockout_seconds') }};
            const countdown = document.getElementById('countdown');
            const box = document.getElementById('lockout-box');
            const btn = document.getElementById('login-btn');

            btn.disabled = true;
            btn.classList.add('opacity-50', 'cursor-not-allowed');

            function tick() {
                if (remaining <= 0) {
                    box.remove();
                    btn.disabled = false;
                    btn.classList.remove('opacity-50', 'cursor-not-allowed');
                    return;
                }
                const m = String(Math.floor(remaining / 60)).padStart(2, '0');
                const s = String(remaining % 60).padStart(2, '0');
                countdown.textContent = `${m}:${s}`;
                remaining--;
                setTimeout(tick, 1000);
            }
            tick();
        </script>
    @endif
</body>
</html>