@extends('layouts.main')

@push('styles')
@endpush

@section('content')
    <div class="w-full px-6 py-6 mx-auto h-screen max-h-full bg-white">
        <!-- cards row 4 -->
        <div class="flex flex-wrap my-6 -mx-3">
            <!-- card 1 -->
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
                        <li><a href="{{ route('dashboard.lokasi.index') }}" class="text-primary">Home</a></li>
                        <li>/</li>
                        <li><a>Edit Data Index Lokasi</a></li>
                    </ul>
                </div>
                <div
                    class="border-black/12.5 h-full flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-10 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                        <div
                            class="flex flex-wrap items-center w-full bg-primary p-3 text-xl text-white font-Manrope-mediums rounded">
                            Edit Data Index Lokasi
                        </div>
                    </div>
                    <div class="overflow-x-auto p-6 px-5 pb-2">
                        <form action="{{ route('dashboard.lokasi.update', ['id' => $lokasi->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="grid md:grid-cols-2 grid-cols-1 md:gap-10 mb-5">
                                <div class="w-full space-y-4">
                                    <label class="text-base font-semibold mb-4">Nama Desa</label>
                                    <input id="name" type="text" name="name"
                                        value="{{ old('name', $lokasi->name) }}"
                                        class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" class="name"
                                        placeholder="Masukkan nama desa" required>
                                </div>
                                <div class="w-full space-y-4">
                                    <label class="text-base font-semibold mb-4">Nama Kecamatan</label>
                                    <input id="kecamatan" type="text" name="kecamatan"
                                        value="{{ old('kecamatan', $lokasi->kecamatan) }}"
                                        class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" class="kecamatan"
                                        placeholder="Masukkan nama kecamatan" required>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 grid-cols-1 md:gap-10 mb-5">
                                <div class="w-full space-y-4">
                                    <label class="text-base font-semibold mb-4">Nama Kabupaten/Kota</label>
                                    <input id="kab_kota" type="text" name="kab_kota"
                                        value="{{ old('kab_kota', $lokasi->kab_kota) }}"
                                        class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" class="kab_kota"
                                        placeholder="Masukkan nama Kabupaten/kota" required>
                                </div>
                                <div class="w-full space-y-4">
                                    <label class="text-base font-semibold mb-4">Nama Provinsi</label>
                                    <input id="province" type="text" name="province"
                                        value="{{ old('province', $lokasi->province) }}"
                                        class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" class="province"
                                        placeholder="Masukkan nama Provinsi" required>
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
