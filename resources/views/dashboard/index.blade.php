@extends('layout.layout')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.css">
@endpush

@section('content')
    {{-- Lihat Detail QR Data Modal --}}
    <div x-data="modals">
        <div class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-[99999] hidden overflow-y-auto"
            id="modalQR">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div
                    class="bg-white dark:bg-dark dark:border-gray/20 border-2 border-lightgray/10 rounded-lg overflow-hidden my-8 w-full max-w-5xl">
                    <div
                        class="flex bg-white dark:bg-dark items-center border-b border-lightgray/10 dark:border-gray/20 justify-between px-5 py-3">
                        <h5 class="font-semibold text-lg text-center" id="titleModalQR"></h5>
                        <button type="button" class="text-lightgray hover:text-primary" onclick="toggleQR()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                                <path
                                    d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"
                                    fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                    {{-- <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf --}}
                    {{-- @method('POST') --}}
                    <div class="p-5 space-y-4">
                        <div class="flex justify-center">
                            <div
                                class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                <div class="text-center">
                                    <canvas id="qrCanvas" class="mb-4"></canvas>
                                    <p class="text-xs leading-5 text-gray-600"><span id="nama_lokal"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white border-2 border-lightgray/10 p-3 rounded-md">

                            <div class="flex justify-center gap-2">
                                <button id="copyLinkButton"
                                    class="btn grow border border-transparent rounded-md bg-blue-500 text-white py-1 px-1">Copy
                                    Link</button>
                                <button id="copyImageButton"
                                    class="btn grow border border-transparent rounded-md bg-green-500 text-white py-1 px-1">Copy
                                    as
                                    Image</button>
                                <button id="downloadImageButton"
                                    class="btn grow border border-transparent rounded-md bg-slate-600 text-white py-1 px-1">Download
                                    as Image</button>
                            </div>
                            <div class="flex justify-center items-center gap-2">
                                <button type="button"
                                    class="btn grow border border-transparent rounded-md text-dark bg-[#F2F3F6]"
                                    onclick="toggleQR()">Tutup
                                </button>
                            </div>
                        </div>
                        {{-- </form> --}}
                    </div>
                </div> 
            </div>
        </div>
    </div>
    {{-- Lihat Detail QR Data Modal --}}

    {{-- Lihat Detail Note Data Modal --}}
    <div x-data="modals">
        <div class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-[99999] hidden overflow-y-auto"
            id="modalNote">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div
                    class="bg-white dark:bg-dark dark:border-gray/20 border-2 border-lightgray/10 rounded-lg overflow-hidden my-8 w-full max-w-5xl">
                    <div
                        class="flex bg-white dark:bg-dark items-center border-b border-lightgray/10 dark:border-gray/20 justify-between px-5 py-3">
                        <h5 class="font-semibold text-lg text-center" id="titleModalNote"></h5>
                        <button type="button" class="text-lightgray hover:text-primary" onclick="toggleNote()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                                <path
                                    d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"
                                    fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                    {{-- <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf --}}
                    {{-- @method('POST') --}}
                    <div class="p-5 space-y-4">
                        <div class="bg-white border-2 border-lightgray/10 p-3 rounded-md">
                            <div class="mt-4 space-y-4 max-h-96 overflow-y-auto">
                                <!-- Review Item -->
                                <div class="mt-4 space-y-4 max-h-96 overflow-y-auto" id="noteContent">
                                </div>

                                <div class="flex justify-center items-center gap-2">
                                    <button type="button"
                                        class="btn grow border border-transparent rounded-md text-dark bg-[#F2F3F6]"
                                        onclick="toggleNote()">Tutup
                                    </button>
                                </div>
                            </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Lihat Detail Note Data Modal --}}

    {{-- Modal Delete --}}
    <div x-data="modals">
        <div class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-[99999] hidden overflow-y-auto"
            id="modalDelete">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div
                    class="bg-white dark:bg-dark dark:border-gray/20 border-2 border-lightgray/10 rounded-lg overflow-hidden my-8 w-full max-w-xl">
                    <div
                        class="flex bg-white dark:bg-dark items-center border-b border-lightgray/10 dark:border-gray/20 justify-end px-5 py-3">
                        {{-- <h5 class="font-semibold text-lg text-center" id="titleModal"></h5> --}}
                        <button type="button" class="text-lightgray hover:text-primary" onclick="toggleDelete()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                                <path
                                    d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"
                                    fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-5 space-y-4">
                        <form action="{{ route('deleteAllDataPlant') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="w-full space-y-4">
                                <h5 class="font-bold text-lg text-center">Apakah Anda Yakin?</h5>
                                <p class="text-center">Apakah Anda yakin ingin menghapus data Pohon "<strong><span
                                            id="name_del_pohon"></span></strong>"
                                    ?
                                </p>
                                <input type="hidden" name="id_plant_delete" id="id_del">
                                {{-- <input type="hidden" name="" id=""> --}}
                            </div>
                            <div class="flex justify-center items-center gap-4 mt-6">
                                <button type="submit"
                                    class="btn grow border border-transparent rounded-md text-white flex justify-center items-center gap-3 bg-[#DD2A56]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                        <path fill="white"
                                            d="M9.808 17h1V8h-1zm3.384 0h1V8h-1zM6 20V6H5V5h4v-.77h6V5h4v1h-1v14z" />
                                    </svg>
                                    <span>Ya, Hapus</span>
                                </button>
                                <button type="button"
                                    class="btn grow border border-transparent rounded-md text-dark bg-[#F2F3F6]"
                                    onclick="toggleDelete()">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Delete --}}

    <div class="flex flex-col gap-5 min-h-[calc(100vh-188px)] sm:min-h-[calc(100vh-204px)]">
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
            <div class="bg-green-100 border-2 border-lightgray/10 p-5 rounded-lg">
                <div class="flex items-center gap-2.5 flex-wrap">
                    <div
                        class="shrink-0 h-[50px] w-[50px] flex items-center justify-center bg-primary/10 rounded-full text-primary">
                        <img src="{{ asset('assets/img/icon/home-asset-dashboard.svg') }}" alt="icon jumlah aset">
                    </div>
                    <div class="flex items-end gap-3">
                        <div class="flex-1">
                            <h4 class="text-lightgray text-sm">Jumlah Aset</h4>
                            <p class="font-bold text-lg mt-1.5">{{ $summary['totalPlant'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-red-100 border-2 border-lightgray/10 p-5 rounded-lg">
                <div class="flex items-center gap-2.5 flex-wrap">
                    <div
                        class="shrink-0 h-[50px] w-[50px] flex items-center justify-center bg-pink/10 rounded-full text-pink">
                        <img src="{{ asset('assets/img/icon/temple-asset-dashboard.svg') }}" alt="icon jenis aset">
                    </div>
                    <div class="flex items-end gap-3">
                        <div class="flex-1">
                            <h4 class="text-lightgray text-sm">Jenis Aset</h4>
                            <p class="font-bold text-lg mt-1.5">{{ $summary['totalIndexPlant'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-violet-100 border-2 border-lightgray/10 p-5 rounded-lg">
                <div class="flex items-center gap-2.5 flex-wrap">
                    <div
                        class="shrink-0 h-[50px] w-[50px] flex items-center justify-center bg-orange/10 rounded-full text-orange">
                        <img src="{{ asset('assets/img/icon/qr-asset-dashboard.svg') }}" alt="icon scan qr code">
                    </div>
                    <div class="flex items-end gap-3">
                        <div class="flex-1">
                            <h4 class="text-lightgray text-sm">Pengunjung Scan QR</h4>
                            <p class="font-bold text-lg mt-1.5">{{ $summary['scannedQR'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-yellow-100 border-2 border-lightgray/10 p-5 rounded-lg">
                <div class="flex items-center gap-2.5 flex-wrap">
                    <div
                        class="shrink-0 h-[50px] w-[50px] flex items-center justify-center bg-purple/10 rounded-full text-purple">
                        <img src="{{ asset('assets/img/icon/star-asset-dashboard.svg') }}" alt="icon rating aset">
                    </div>
                    <div class="flex items-end gap-3">
                        <div class="flex-1">
                            <h4 class="text-lightgray text-sm">Rating Aset</h4>
                            <p class="font-bold text-lg mt-1.5">{{ $summary['avgRating'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

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

        @if (session('success'))
            <div class="my-4 rounded p-3 bg-green-digitree/10 text-green-digitree border border-green-digitree/60">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 gap-5">
            <div class="bg-white border-2 border-lightgray/10 p-5 rounded-lg">
                <div class="overflow-auto space-y-4" x-data="dataTable()" x-init="initData()
                $watch('searchInput', value => {
                    search(value)
                })">
                    <div class="flex justify-between items-center gap-3">
                        <div class="flex space-x-2 items-center">
                            <p>Tampilkan</p>
                            <select id="filter" class="form-select !w-20" x-model="view" @change="changeView()">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        {{-- <div>
                            <input id="search" x-model="searchInput" type="text" class="form-input"
                                placeholder="Search...">
                        </div> --}}
                    </div>
                    <div class="overflow-auto">
                        <table class="min-w-[640px] w-full">
                            <thead>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p>No</p>
                                        <div class="flex flex-col">
                                            <svg @click="sort('no', 'asc')" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'no' && sorted
                                                        .rule === 'asc'
                                                }">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg @click="sort('no', 'desc')" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'name' && sorted
                                                        .rule === 'desc'
                                                }">
                                                <path d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p>Kode Asset</p>
                                        <div class="flex flex-col">
                                            <svg @click="sort('code_asset', 'asc')" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'code_asset' && sorted
                                                        .rule === 'asc'
                                                }">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg @click="sort('code_asset', 'desc')" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'code_asset' && sorted
                                                        .rule === 'desc'
                                                }">
                                                <path d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">Nama Lokal</p>
                                        <div class="flex flex-col">
                                            <svg @click="sort('index_plant_data.name', 'asc')" fill="none" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                viewBox="0 0 24 24" stroke="currentColor"
                                                class="text-muted h-3 w-3 cursor-pointer fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'index_plant_data.name' && sorted
                                                        .rule === 'asc'
                                                }">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg @click="sort('index_plant_data.name', 'desc')" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                class="text-muted h-3 w-3 cursor-pointer fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'index_plant_data.name' && sorted
                                                        .rule === 'desc'
                                                }">
                                                <path d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <span>
                                            Alamat
                                        </span>
                                        <div class="flex flex-col">
                                            <svg @click="sort('address', 'asc')" fill="none" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                viewBox="0 0 24 24" stroke="currentColor"
                                                class="text-muted h-3 w-3 cursor-pointer fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'address' && sorted
                                                        .rule === 'asc'
                                                }">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg @click="sort('address', 'desc')" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                class="text-muted h-3 w-3 cursor-pointer fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'address' && sorted
                                                        .rule === 'desc'
                                                }">
                                                <path d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <span>
                                            Usia Asset
                                        </span>
                                        <div class="flex flex-col">
                                            <svg @click="sort('age', 'asc')" fill="none" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                viewBox="0 0 24 24" stroke="currentColor"
                                                class="text-muted h-3 w-3 cursor-pointer fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'age' && sorted
                                                        .rule === 'asc'
                                                }">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg @click="sort('age', 'desc')" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                class="text-muted h-3 w-3 cursor-pointer fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'age' && sorted
                                                        .rule === 'desc'
                                                }">
                                                <path d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="15%">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="">
                                            Rating
                                        </span>
                                        <div class="flex flex-col">
                                            <svg @click="sort('avg_rating', 'asc')" fill="none" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                viewBox="0 0 24 24" stroke="currentColor"
                                                class="text-muted h-3 w-3 cursor-pointer fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'avg_rating' && sorted
                                                        .rule === 'asc'
                                                }">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg @click="sort('avg_rating', 'desc')" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                class="text-muted h-3 w-3 cursor-pointer fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'avg_rating' && sorted
                                                        .rule === 'desc'
                                                }">
                                                <path d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="15%">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="">
                                            Aksi
                                        </span>
                                    </div>
                                </th>
                                <th width="5%">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="">
                                            Catatan
                                        </span>
                                    </div>
                                </th>
                            </thead>
                            <tbody>
                                <template x-for="(item, index) in items" :key="index">
                                    <tr x-show="checkView(index + 1)" class="">
                                        <td>
                                            <span x-text="item.no"></span>
                                        </td>
                                        <td>
                                            <span x-text="item.code_asset"></span>
                                        </td>
                                        <td>
                                            <span x-text="item.index_plant_data.nama_lokal"></span>
                                        </td>
                                        <td>
                                            <span x-bind:title="item.address" class="block truncate w-36">
                                                <span x-text="item.address"></span>
                                            </span>
                                        </td>

                                        <td>
                                            <span
                                                :class="{
                                                    'text-red-600 bg-red-200 rounded px-2 py-1': item.age <= 1,
                                                    'text-yellow-600 bg-yellow-200 rounded px-2 py-1': item.age >
                                                        1 && item.age < 3,
                                                    'text-green-600 bg-green-200 rounded px-2 py-1': item.age >= 3,
                                                    'text-blue-600 bg-blue-200 rounded px-2 py-1': item.age >= 10
                                                }"
                                                x-text="item.age < 1 ? '< 1 Tahun' : (item.age == 1 ? '1 Tahun' : item.age + ' Tahun')">
                                            </span>
                                        </td>

                                        <td>
                                            <div class="flex">
                                                <!-- Bintang Penuh -->
                                                <template x-for="i in Math.floor(Number(item.avg_rating))">
                                                    <img src="{{ asset('assets/img/icon/star-fill.svg') }}"
                                                        alt="Star" class="w-4 h-4">
                                                </template>
                                                <!-- Bintang Kosong -->
                                                <template x-for="i in 5 - Math.floor(Number(item.avg_rating))">
                                                    <img src="{{ asset('assets/img/icon/star-border.svg') }}"
                                                        alt="Star" class="w-4 h-4">
                                                </template>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex gap-2">
                                                <a x-on:click="toggleQR('Lihat QR', {{ 'item.code_asset' }})"
                                                    class="py-2 px-3 text-white bg-green-digitree rounded-lg cursor-pointer">Lihat
                                                    QR
                                                </a>
                                                <a x-on:click="toggleEdit({{ 'item.code_asset' }})"
                                                    class="py-2 px-3 text-white bg-blue-btn rounded-lg cursor-pointer">Edit
                                                </a>
                                                <a x-on:click="toggleDelete({{ 'item.index_plant_data.nama_lokal' }}, {{ 'item.code_asset' }})"
                                                    class="py-2 px-3 text-white bg-red-btn rounded-lg cursor-pointer">Hapus
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <a x-on:click="toggleNote('Lihat Detail', {{ 'item.code_asset' }})"
                                                class="py-2 px-3 text-white bg-green-digitree rounded-lg cursor-pointer">
                                                Note
                                            </a>
                                        </td>
                                    </tr>
                                </template>
                                <tr x-show="isEmpty()">
                                    <td colspan="5" class="text-center py-3 text-black">No matching records found.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <ul class="inline-flex items-center gap-1">
                        <li><button type="button" @click.prevent="changePage(1)"
                                class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">First</button>
                        </li>
                        <li><button type="button" @click="changePage(currentPage - 1)"
                                class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Prev</button>
                        </li>
                        <template x-for="item in pages">
                            <li><button @click="changePage(item)" type="button"
                                    class="flex justify-center h-9 w-9 items-center rounded transition border border-gray/20 hover:border-gray/60"
                                    x-bind:class="{ 'border-primary text-primary': currentPage === item }"><span
                                        x-text="item"></span></button></li>
                        </template>
                        <li><button @click="changePage(currentPage + 1)" type="button"
                                class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Next</button>
                        </li>
                        <li><button @click.prevent="changePage(pagination.lastPage)" type="button"
                                class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Last</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <!-- ApexCharts js -->
    <script src="{{ asset('assets/js/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/apex-analytics.js') }}"></script> --}}

    <!-- Datatables Js -->
    <script src="{{ asset('assets/js/datatable-plant.js') }}"></script>
    <script src="{{ asset('assets/js/data-search.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>

    <script>
        var toggleModalDelete = false
        var toggleModalQR = false
        var toggleModalNote = false

        const modalDelete = document.getElementById("modalDelete")
        const modalQR = document.getElementById("modalQR")
        const modalNote = document.getElementById("modalNote")

        const titleModalDelete = document.getElementById("titleModalDelete")
        const titleModalQR = document.getElementById("titleModalQR")
        const titleModalNote = document.getElementById("titleModalNote")

        function toggleQR(params, id) {
            toggleModalQR = !toggleModalQR
            if (params) {
                titleModalQR.textContent = params + " Pohon"
            }

            let previewImg = document.getElementById('previewImgQR');
            const qrCanvas = document.getElementById('qrCanvas');
            const nama_lokal = document.getElementById('nama_lokal');
            const code_asset = document.getElementById('code_asset');
            const copyLinkButton = document.getElementById('copyLinkButton');
            const copyImageButton = document.getElementById('copyImageButton');
            const downloadImageButton = document.getElementById('downloadImageButton');

            fetch("/generate-qrcode/" + id) // Replace with your actual data URL
                .then((response) => response.json())
                .then((data) => {
                    // console.log(data);
                    nama_lokal.textContent = data.nama_lokal || '-';
                    // code_asset.textContent = data.code_asset || '-';
                    const baseURL_path = document.querySelector('meta[name="base-url"]').getAttribute('content');
                    const dynamicLink = `${baseURL_path}/aset/${data.code_asset}`;
                    copyLinkButton.setAttribute('data-link', dynamicLink);

                    // Generate QR Code
                    QRCode.toCanvas(qrCanvas, dynamicLink, function(error) {
                        if (error) console.error(error);
                        console.log('QR code generated!');
                    });

                    // Add event listeners for new buttons
                    copyLinkButton.onclick = function() {
                        navigator.clipboard.writeText(dynamicLink)
                            .then(() => alert('Link copied to clipboard: ' + dynamicLink))
                            .catch(err => console.error('Error copying link: ', err));
                    };

                    copyImageButton.onclick = function() {
                        qrCanvas.toBlob(function(blob) {
                            navigator.clipboard.write([new ClipboardItem({
                                    'image/png': blob
                                })])
                                .then(() => alert('Image copied to clipboard'))
                                .catch(err => console.error('Error copying image: ', err));
                        });
                    };

                    downloadImageButton.onclick = function() {
                        const link = document.createElement('a');
                        link.href = qrCanvas.toDataURL('image/png');
                        link.download = 'qrcode.png';
                        link.click();
                    };
                })
                .catch((error) => {

                    console.error("Error fetching data:", error); // Handle error appropriately
                    // alert('Error Data');
                });

            modalQR.classList.toggle("hidden");
        }

        function toggleNote(params, id) {
            toggleModalNote = !toggleModalNote
            if (params) {
                titleModalNote.textContent = params + " Note"
            }

            let previewImg = document.getElementById('previewImgNote');
            let nameSpan = document.getElementById('name_comment');
            let commentSpan = document.getElementById('comment');
            let ratingSpan = document.getElementById('rating');

            const baseURL = window.location.origin;
            const starFillPath = `${baseURL}/assets/img/icon/star-fill.svg`;
            const starBorderPath = `${baseURL}/assets/img/icon/star-border.svg`;

            fetch("statistik/get-review-plant/" + id) // Replace with your actual data URL
                .then((response) => response.json())
                .then((data) => {
                    // Menghapus konten lama
                    noteContent.innerHTML = '';

                    // Mengatur data untuk setiap item
                    data.forEach(item => {
                        let itemDiv = document.createElement('div');
                        itemDiv.classList.add('flex', 'items-center', 'space-x-2', 'border-b', 'pb-2', 'mb-2');

                        let detailsDiv = document.createElement('div');
                        detailsDiv.classList.add('flex-1');

                        let nameP = document.createElement('p');
                        nameP.classList.add('font-bold', 'text-gray-800');
                        nameP.textContent = item.name || '-';

                        let commentP = document.createElement('p');
                        commentP.classList.add('text-gray-700');
                        commentP.textContent = item.comment || '-';

                        detailsDiv.appendChild(nameP);
                        detailsDiv.appendChild(commentP);

                        let ratingDiv = document.createElement('div');
                        ratingDiv.classList.add('flex', 'items-center', 'space-x-1');
                        let rating = Math.floor(parseFloat(item.rating)); // Membulatkan ke bawah

                        for (let i = 0; i < rating; i++) {
                            let star = document.createElement('img');
                            star.src = starFillPath; // Path to the star-fill image
                            star.classList.add('inline-block', 'w-4', 'h-4');
                            ratingDiv.appendChild(star);
                        }
                        for (let i = rating; i < 5; i++) {
                            let starBorder = document.createElement('img');
                            starBorder.src = starBorderPath; // Path to the star-border image
                            starBorder.classList.add('inline-block', 'w-4', 'h-4');
                            ratingDiv.appendChild(starBorder);
                        }

                        itemDiv.appendChild(detailsDiv);
                        itemDiv.appendChild(ratingDiv);
                        noteContent.appendChild(itemDiv);
                    });
                })
                .catch((error) => {

                    console.error("Error fetching data:", error); // Handle error appropriately
                    // alert('Error Data');
                });

            modalNote.classList.toggle("hidden");
        }

        function toggleDelete(name, id) {
            toggleModalDelete = !toggleModalDelete
            let nama_pohon = document.getElementById("name_del_pohon");
            let id_del = document.getElementById("id_del");

            id_del.value = id;
            nama_pohon.textContent = name;
            modalDelete.classList.toggle("hidden");
        }

        function toggleEdit(id) {
            // Redirect to the URL for editing
            window.location.href = 'update-plant/' + id;
        }

        document.addEventListener('click', function(event) {
            const modalQR = document.getElementById('modalQR');
            if (event.target === modalQR) {
                modalQR.classList.add('hidden');
            }
        });
    </script>
@endsection
