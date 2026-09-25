<x-guest-layout>
    {{-- Session Status --}}
    @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ session('status') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
            @foreach ($errors->all() as $error)
                <p class="text-sm text-red-600">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Judul --}}
        <div class="text-center mb-2">
            <h2 class="text-xl font-display font-bold text-gray-800">Masuk ke Sistem</h2>
            <p class="text-sm text-gray-500 mt-1">Silakan masukkan akun Anda</p>
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="contoh@stikesmu.ac.id"
                class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-xl text-gray-800 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition"
                style="border: 2px solid #d1d5db; border-radius: 12px; padding: 10px 16px; width: 100%; font-size: 14px; outline: none;"
            >
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
                class="w-full px-4 py-2.5 border-2 border-gray-300 rounded-xl text-gray-800 text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition"
                style="border: 2px solid #d1d5db; border-radius: 12px; padding: 10px 16px; width: 100%; font-size: 14px; outline: none;"
            >
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember"
                class="w-4 h-4 text-primary border-gray-300 rounded"
                style="width: 16px; height: 16px; margin-right: 8px;">
            <label for="remember_me" class="text-sm text-gray-600">Ingat saya</label>
        </div>

        {{-- Submit & Forgot Password --}}
        <div class="flex items-center justify-between pt-2">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm text-primary hover:text-secondary underline transition"
                   style="font-size: 13px; color: #0e7040;">
                    Lupa password?
                </a>
            @endif

            <button type="submit"
                class="px-6 py-2.5 bg-secondary text-white text-sm font-bold rounded-xl hover:bg-primary transition shadow"
                style="background-color: #073c22; color: white; padding: 10px 24px; border-radius: 12px; font-weight: 700; font-size: 14px; border: none; cursor: pointer;">
                LOG IN
            </button>
        </div>
    </form>
</x-guest-layout>
