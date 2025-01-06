<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h1 class="text-center text-3xl font-bold mt-8 mb-4 text-dark">
        Selamat Datang
    </h1>
    <p class="text-base text-center">
        Daftarkan akun anda untuk akses website.
    </p>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mt-10">
            <!-- Name -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name"
                    class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white dark:bg-white bg-clip-padding px-3 py-3 font-normal text-gray-900 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow dark:text-gray-900"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                    placeholder="Masukkan Name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email"
                    class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white dark:bg-white bg-clip-padding px-3 py-3 font-normal text-gray-900 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow dark:text-gray-900"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="Masukkan Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password"
                    class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white dark:bg-white bg-clip-padding px-3 py-3 font-normal text-gray-900 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow dark:text-gray-900"
                    type="password" name="password" placeholder="Masukkan Password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

                <x-text-input id="password_confirmation"
                    class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white dark:bg-white bg-clip-padding px-3 py-3 font-normal text-gray-900 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow dark:text-gray-900"
                    type="password" name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mb-4">
                <a class="underline text-sm text-gray-900 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    Sudah punya akun?
                </a>
            </div>

            <div class="block text-center mt-4">
                <button type="submit"
                    class="inline-block w-full px-6 py-3 mt-6 mb-0 font-bold text-center text-white align-middle transition-all border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro ease-soft-in tracking-tight-soft bg-green-digitree hover:scale-102 hover:shadow-soft-xs active:opacity-85 text-lg">Daftar</button>
            </div>
        </div>
    </form>
</x-guest-layout>
