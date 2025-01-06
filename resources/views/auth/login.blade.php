<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h1 class="text-center text-3xl font-bold mt-8 mb-4 text-dark">
        Selamat Datang
    </h1>
    <p class="text-base text-center mb-6">
        Masukkan informasi login untuk akses website.
    </p>
    @if (session('success'))
        <div class="my-4 rounded p-3 bg-green-digitree/10 text-green-digitree border border-green-digitree/60">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="my-4 rounded p-3 bg-red-500/10 text-red-500 border border-red-500/60">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class=" rounded p-3 bg-red-500/10 text-red-500 border border-red-500/60 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}" class="max-w-md mx-auto px-4">
        @csrf
        <div class="mt-10 space-y-4">
            <!-- Email Address -->
            <div>
                <x-text-input id="email"
                    class="w-full appearance-none rounded-lg border border-gray-300 bg-white px-3 py-2 focus:border-fuchsia-300 focus:outline-none"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="Masukkan Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-text-input id="password"
                    class="w-full appearance-none rounded-lg border border-gray-300 bg-white px-3 py-2 focus:border-fuchsia-300 focus:outline-none"
                    type="password" name="password" placeholder="Masukkan Password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex justify-between items-center mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="block text-center mt-4">
                <button type="submit"
                    class="inline-block w-full px-6 py-3 mt-6 font-bold text-white bg-green-500 hover:bg-green-600 transition-all rounded-lg">Masuk</button>
            </div>
        </div>
    </form>
</x-guest-layout>
