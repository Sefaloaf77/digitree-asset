@extends('layout.layout')

@push('styles')
@endpush

@section('content')
    <div class="">
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
    </div>
    <div class="w-full py-2 mx-auto h-screen max-h-full bg-white">
        <!-- cards row 4 -->
        <div class="flex flex-wrap">
            <!-- card 1 -->
            <div class="w-full max-w-full mt-0 mb-6 md:mb-0 md:flex-none lg:flex-none">
                <div class="grid grid-cols-1">
                    <div>
                        <ul class="flex flex-wrap items-center text-sm font-semibold space-x-2.5">
                            <li class="flex items-center space-x-2.5 text-gray hover:text-dark duration-300">
                                <a href="/dashboard/semua-lokasi">Dashboard</a>
                                <svg class="text-gray/50" width="8" height="10" viewBox="0 0 8 10" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.5"
                                        d="M1.33644 0H4.19579C4.60351 0 5.11318 0.264045 5.32903 0.589888L7.83532 4.3427C8.07516 4.70787 8.05119 5.2809 7.77538 5.6236L4.66949 9.5C4.44764 9.77528 3.96795 10 3.6022 10H1.33644C0.287156 10 -0.348385 8.92135 0.203241 8.08427L1.86409 5.59551C2.08594 5.26405 2.08594 4.72472 1.86409 4.39326L0.203241 1.90449C-0.348385 1.07865 0.293152 0 1.33644 0Z"
                                        fill="currentColor" />
                                </svg>
                            </li>
                            <li>Edit Data Asset</li>
                        </ul>
                    </div>
                </div>
                <div
                    class="border-black/12.5 h-full flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border mt-5">
                    <div class="flex justify-between">
                        <a href="/dashboard/semua-lokasi"
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
                        <form action="{{ route('dashboard.asset.update', ['id' => $assetData['code_asset']]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="flex flex-row gap-5">
                                <div class="lg:w-6/12 w-full border-2 border-[#5A6383]/10 p-5 rounded-lg">
                                    <h2 class="text-black text-lg font-semibold mb-8">Informasi Dasar</h2>
                                    <div class="form-control w-full">
                                        <div class="label">
                                            <label for="jenis"
                                                class="label-text font-Manrope-semibold text-lg text-dark block leading-6">Jenis
                                                Asset</label>
                                        </div>
                                        <select
                                            class="select select-bordered bg-[#7780A1]/10 w-full ring-[#7780A1]/5 focus:ring-2 focus:ring-inset focus:ring-[#7780A1]/15 rounded mt-2"
                                            id="jenis" name="id_index_asset" autocomplete="jenis-asset"
                                            aria-placeholder="Pilih Jenis Asset">
                                            <option disabled selected>Pilih Jenis Asset</option>
                                            @foreach ($jenisAsset as $asset)
                                                <option value="{{ $asset->id }}"
                                                    {{ old('id_index_asset', $assetData->id_index_asset ?? '') == $asset->id ? 'selected' : '' }}>
                                                    {{ $asset->nama }} - {{ $asset->nama_lokal }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex flex-col my-5">
                                        <label for="kode" class="capitalize">kode Asset</label>
                                        <div class="flex items-center">
                                            <input type="text" name="code_asset" value="{{ $assetData->code_asset }}"
                                                class="mt-2 grow !bg-[#7780A1]/10 !border-2 !border-[#7780A1]/15 !rounded"
                                                placeholder="Masukkan kode">
                                        </div>
                                    </div>
                                    <div class="flex flex-col my-5">
                                        <label for="age" class="capitalize">Jarak dari Pusat Desa</label>
                                        <div class="flex items-center">
                                            <input type="text" name="age" value="{{ $assetData->age }}"
                                                class="mt-2 grow !bg-[#7780A1]/10 !border-s-2 !border-e-0 !border-y-2 !border-[#7780A1]/15 !rounded-s"
                                                placeholder="Masukkan Jarak KM">
                                            <span
                                                class="p-2 !bg-[#7780A1]/10 mt-2 border-e-2 border-y-2 border-[#7780A1]/15 rounded-e">KM</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col my-5">
                                        <label for="large" class="capitalize">Moda Tranportasi ke Lokasi</label>
                                        <div class="flex items-center">
                                            <input type="text" name="large" value="{{ $assetData->large }}"
                                                class="mt-2 grow !bg-[#7780A1]/10 !border-s-2 !border-e-0 !border-y-2 !border-[#7780A1]/15 !rounded-s"
                                                placeholder="Masukkan Transportasi">
                                            {{-- <span
                                                class="p-2 !bg-[#7780A1]/10 mt-2 border-e-2 border-y-2 border-[#7780A1]/15 rounded-e">Meter2</span> --}}
                                        </div>
                                    </div>
                                    <div class="flex flex-col my-5">
                                        <label for="value" class="capitalize">nilai asset</label>
                                        <div class="flex items-center">
                                            <input type="text" name="value" value="{{ $assetData->value }}"
                                                class="mt-2 grow !bg-[#7780A1]/10 !border-2 !border-[#7780A1]/15 !rounded-s"
                                                placeholder="Masukkan Nilai">
                                        </div>
                                    </div>
                                    <div class="flex flex-col my-5">
                                        <label for="tanggal" class="capitalize">Tanggal Dibuka</label>
                                        <div class="flex items-center">
                                            <input type="date" name="date_open" value="{{ $assetData->date_open }}"
                                                class="mt-2 grow !bg-[#7780A1]/10 !border-2 !border-[#7780A1]/15 !rounded"
                                                placeholder="Masukkan tanggal">
                                        </div>
                                    </div>
                                    <div class="flex flex-col my-5">
                                        <label for="pengelola" class="capitalize">Pengelola</label>
                                        <div class="flex items-center">
                                            <input type="text" name="organizer" value="{{ $assetData->organizer }}"
                                                class="mt-2 grow !bg-[#7780A1]/10 !border-2 !border-[#7780A1]/15 !rounded"
                                                placeholder="Masukkan pengelola">
                                        </div>
                                    </div>
                                </div>
                                <div class="lg:w-6/12 w-full border-2 border-[#5A6383]/10 p-5 rounded-lg">
                                    <h2 class="text-black text-lg font-semibold mb-8">Lokasi Asset</h2>
                                    <div class="flex flex-col my-5">
                                        <label for="desa" class="capitalize">nama desa</label>
                                        <select
                                            class="select select-bordered bg-[#7780A1]/10 w-full ring-[#7780A1]/5 focus:ring-2 focus:ring-inset focus:ring-[#7780A1]/15 rounded mt-2"
                                            id="desa" name="id_village" autocomplete="desa-asset"
                                            aria-placeholder="Pilih desa Asset">
                                            <option disabled selected>Pilih Desa</option>
                                            @foreach ($desa as $item)
                                                <option class="capitalize" value="{{ $item->id }}"
                                                    {{ old('id_village', $assetData->id_village ?? '') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                    -
                                                    {{ $item->kecamatan }},
                                                    {{ $item->kab_kota }},{{ $item->province }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex flex-col my-5">
                                        <label for="alamat" class="capitalize">Alamat Lokasi Asset</label>
                                        <div class="flex items-center">
                                            <input type="text" name="address" value="{{ $assetData->address }}"
                                                class="mt-3 grow !bg-[#7780A1]/10 !border-2 !border-[#7780A1]/15 !rounded"
                                                placeholder="Masukkan alamat">
                                        </div>
                                    </div>
                                    <div class="flex flex-col my-5">
                                        <label for="titik koordinate" class="capitalize">Titik koordinat
                                            Lokasi</label>
                                        <div class="flex items-center">
                                            <input type="text" name="location" value="{{ $assetData->location }}"
                                                class="mt-3 grow !bg-[#7780A1]/10 !border-2 !border-[#7780A1]/15 !rounded"
                                                placeholder="Masukkan titik koordinate">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end my-5">
                                <button type="submit"
                                    class="bg-green-digitree py-3 px-6 flex  justify-center items-center w-fit h-fit gap-3 rounded-md text-white font-Manrope-semibold text-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                        class="w-5 h-5" viewBox="0 0 24 24">
                                        <path fill="white"
                                            d="M17.59 3.59c-.38-.38-.89-.59-1.42-.59H5a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V7.83c0-.53-.21-1.04-.59-1.41zM12 19c-1.66 0-3-1.34-3-3s1.34-3 3-3s3 1.34 3 3s-1.34 3-3 3m1-10H7c-1.1 0-2-.9-2-2s.9-2 2-2h6c1.1 0 2 .9 2 2s-.9 2-2 2" />
                                    </svg>
                                    <span class="text-white font-Manrope-medium">Ubah Data</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@push('scripts')
@endpush
