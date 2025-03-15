@extends('layouts.main')

@push('styles')
@endpush

@section('content')
    <div class="w-full px-6 py-6 mx-auto h-screen max-h-full bg-white">
        <!-- cards row 4 -->
        <div class="flex flex-wrap my-6 -mx-3">
            <!-- card 1 -->
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
            <div class="w-full max-w-full px-3 mt-0 mb-6 md:mb-0 md:flex-none lg:flex-none">
                <div class="flex flex-row text-end justify-end text-dark px-6">
                    <ul class="flex flex-row gap-3 text-base">
                        <li><a href="{{ route('dashboard.user-role.index') }}" class="text-primary">Home</a></li>
                        <li>/</li>
                        <li><a>Tambah User Role</a></li>
                    </ul>
                </div>
                <div
                    class="border-black/12.5 h-full flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="flex justify-between">
                        <a href="{{ route('dashboard.user-role.index') }}"
                            class="bg-[#7780A1]/10 py-3 px-6 flex justify-center items-center w-fit h-fit gap-3 rounded-md text-white font-Manrope-semibold text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" class="w-5 h-5"
                                viewBox="0 0 512 512">
                                <path fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="48" d="M244 400L100 256l144-144M120 256h292" />
                            </svg>
                            <span class="text-black font-Manrope-medium">Kembali</span>
                        </a>

                    </div>
                    <div class="overflow-x-auto py-6 pb-2">
                        <form action="{{ route('dashboard.user-role.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="grid md:grid-cols-2 grid-cols-1 md:gap-10 mb-5">
                                <div class="w-full space-y-4">
                                    <label class="text-base font-semibold mb-4">Nama</label>
                                    <input id="name" type="text" name="name"
                                        class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" class="name"
                                        placeholder="Masukkan nama" required>
                                </div>
                                <div class="w-full space-y-4">
                                    <label class="text-base font-semibold mb-4">Role</label>
                                    <select
                                        class="select select-bordered bg-[#7780A1]/10 w-full ring-[#7780A1]/5 focus:ring-2 focus:ring-inset focus:ring-[#7780A1]/15 rounded mt-2"
                                        id="role" name="role" autocomplete="role"
                                        aria-placeholder="Pilih Role User">
                                        <option disabled selected>Pilih Role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Super Admin">Super Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 grid-cols-1 md:gap-10 mb-5">
                                <div class="w-full space-y-4">
                                    <label class="text-base font-semibold mb-4 capitalize">email</label>
                                    <input id="email" type="email" name="email"
                                        class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" class="email"
                                        placeholder="Masukkan email" required>
                                </div>
                                <div class="w-full space-y-4">
                                    <label class="text-base font-semibold mb-4">Password</label>
                                    <input id="password" type="password" name="password"
                                        class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" class="password"
                                        placeholder="Masukkan password" required>
                                </div>
                            </div>
                            <div class="mb-5 mt-10 w-full">
                                <label class="text-base font-semibold mb-4 capitalize">Akses</label>
                                <div class="grid md:grid-cols-4 mt-5 gap-8">
                                    @foreach ($villages as $item)
                                        <div class="flex items-center gap-3">
                                            <input type="checkbox" name="akses" id="">
                                            <span>{{ $item->name }} - {{ $item->kab_kota }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex justify-end items-center gap-4 mt-6">
                                <button type="submit"
                                    class="btn border border-transparent rounded-md text-white flex justify-center gap-3 bg-green-digitree">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                        <path fill="white"
                                            d="M21 7v12q0 .825-.587 1.413T19 21H5q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h12zm-9 11q1.25 0 2.125-.875T15 15t-.875-2.125T12 12t-2.125.875T9 15t.875 2.125T12 18m-6-8h9V6H6z" />
                                    </svg>
                                    <span>Simpan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
@endpush
