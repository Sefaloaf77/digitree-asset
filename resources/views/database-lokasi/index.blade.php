@extends('layout.layout')

@push('styles')
@endpush

@section('content')

    <div class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-[99999] hidden overflow-y-auto" id="modal">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div
                class="bg-white dark:bg-dark dark:border-gray/20 border-2 border-lightgray/10 rounded-lg overflow-hidden my-8 w-full max-w-xl">

                <div
                    class="flex bg-white dark:bg-dark items-center border-b border-lightgray/10 dark:border-gray/20 justify-between px-5 py-3">
                    <h5 class="font-semibold text-lg text-center" id="titleModal"></h5>
                    <button type="button" class="text-lightgray hover:text-primary" onclick="toggle()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                            <path
                                d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"
                                fill="currentColor"></path>
                        </svg>
                    </button>
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

                <div class="p-5 space-y-4">
                    <form action="{{ route('dashboard.lokasi.store') }}" id="modalForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <!-- Pilihan Input -->
                        <div class="w-full space-y-4">
                            <label class="text-base font-semibold mb-4">Pilih Metode Input</label>
                            <div class="flex items-center gap-4">
                                <label for="manual" class="cursor-pointer">Manual</label>
                                <input type="radio" id="manual" name="input_method" value="manual" checked>

                                <label for="import" class="cursor-pointer">Import Excel</label>
                                <input type="radio" id="import" name="input_method" value="import">
                            </div>
                        </div>

                        <!-- Input Form Manual -->
                        <div id="manual-form" class="w-full space-y-4 mt-4">
                            <label class="text-base font-semibold mb-4">Nama Desa</label>
                            <input id="name" type="text" name="name"
                                class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]"
                                placeholder="Masukkan nama desa" required>

                            <label class="text-base font-semibold mb-4">Nama Kecamatan</label>
                            <input id="kecamatan" type="text" name="kecamatan"
                                class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]"
                                placeholder="Masukkan nama kecamatan" required>

                            <label class="text-base font-semibold mb-4">Nama Kabupaten/Kota</label>
                            <input id="kab_kota" type="text" name="kab_kota"
                                class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]"
                                placeholder="Masukkan nama Kabupaten/kota" required>

                            <label class="text-base font-semibold mb-4">Nama Provinsi</label>
                            <input id="province" type="text" name="province"
                                class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]"
                                placeholder="Masukkan nama Provinsi" required>
                        </div>

                        <!-- Import File Excel -->
                        <div id="import-form" class="w-full space-y-4 mt-4 hidden">
                            <label class="text-base font-semibold mb-4">Import Data Excel (Opsional)</label>
                            <input type="file" name="file" id="file"
                                class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" accept=".xlsx, .xls" />
                            <p class="text-sm text-gray-500 mt-1">Format file: .xlsx, .xls (Opsional)</p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-center items-center gap-4 mt-6">
                            <button type="submit"
                                class="btn grow border border-transparent rounded-md text-white flex justify-center gap-3 bg-green-digitree">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                    <path fill="white"
                                        d="M21 7v12q0 .825-.587 1.413T19 21H5q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h12zm-9 11q1.25 0 2.125-.875T15 15t-.875-2.125T12 12t-2.125.875T9 15t.875 2.125T12 18m-6-8h9V6H6z" />
                                </svg>
                                <span>Simpan</span>
                            </button>
                            <button type="button"
                                class="btn grow border border-transparent rounded-md text-dark bg-[#F2F3F6]"
                                onclick="toggle()">Tutup</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="my-4 rounded p-3 bg-green-digitree/10 text-green-digitree border border-green-digitree/60">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col gap-5 min-h-[calc(100vh-188px)] sm:min-h-[calc(100vh-204px)]">

        <div class="grid grid-cols-1">
            <div>
                <ul class="flex flex-wrap items-center text-sm font-semibold space-x-2.5">
                    <li class="flex items-center space-x-2.5 text-gray hover:text-dark duration-300">
                        <a href="javaScript:;">Dashboard</a>
                        <svg class="text-gray/50" width="8" height="10" viewBox="0 0 8 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.5"
                                d="M1.33644 0H4.19579C4.60351 0 5.11318 0.264045 5.32903 0.589888L7.83532 4.3427C8.07516 4.70787 8.05119 5.2809 7.77538 5.6236L4.66949 9.5C4.44764 9.77528 3.96795 10 3.6022 10H1.33644C0.287156 10 -0.348385 8.92135 0.203241 8.08427L1.86409 5.59551C2.08594 5.26405 2.08594 4.72472 1.86409 4.39326L0.203241 1.90449C-0.348385 1.07865 0.293152 0 1.33644 0Z"
                                fill="currentColor" />
                        </svg>
                    </li>
                    <li>Database Lokasi</li>
                </ul>
            </div>
        </div>

        <button onclick="toggle('Tambah')" class="py-3 px-5 rounded-lg bg-green-digitree text-white inline-block max-w-fit">
            <div class="flex items-center gap-2" id="openAddModalBtn">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12.6562 6.875C12.6562 7.40234 12.2168 7.8418 11.7188 7.8418H7.5V12.0605C7.5 12.5586 7.06055 12.9688 6.5625 12.9688C6.03516 12.9688 5.625 12.5586 5.625 12.0605V7.8418H1.40625C0.878906 7.8418 0.46875 7.40234 0.46875 6.875C0.46875 6.37695 0.878906 5.9668 1.40625 5.9668H5.625V1.74805C5.625 1.2207 6.03516 0.78125 6.5625 0.78125C7.06055 0.78125 7.5 1.2207 7.5 1.74805V5.9668H11.7188C12.2168 5.9375 12.6562 6.37695 12.6562 6.875Z"
                        fill="white" />
                </svg>
                <span>Tambah Database Lokasi</span>
            </div>
        </button>

        <div class="grid grid-cols-1 gap-5">
            <div class="bg-white border-2 border-lightgray/10 p-5 rounded-lg">
                <div class="overflow-auto space-y-4">

                    <div class="flex justify-between items-center gap-3 w-full">
                        <div class="flex space-x-2 items-center">
                            <p>Tampilkan</p>
                            <select id="filter" class="form-select !w-20"
                                onchange="window.location.href='{{ route('dashboard.lokasi.index') }}?per_page='+this.value">>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="w-full flex justify-end">
                            <form action="{{ route('dashboard.lokasi.index') }}" method="get">
                                <input type="search" name="search" placeholder="Cari desa..."
                                    value="{{ request('search') }}"
                                    class="h-12 rounded-md border-2 border-[#7780a11a] bg-[#7780a114] text-sm text-black">
                                <button type="submit" class="h-12 bg-orange-600 text-white rounded px-10">Cari</button>
                            </form>
                        </div>
                    </div>

                    <div class="overflow-auto" id="table-container">

                        <table class="min-w-[640px] w-full display" id="table">
                            <thead>
                                <th width="3%" class="dark:bg-white bg-white text-dark dark:text-dark">
                                    <div class="flex items-center justify-between gap-2">
                                        <p>No</p>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">Nama Desa</p>
                                        <div class="flex flex-col">
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'name' && '{{ $sortDirection }}'
                                                    === 'asc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.lokasi.index') }}?sort_by=name&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'name' && '{{ $sortDirection }}'
                                                    === 'desc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.lokasi.index') }}?sort_by=name&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M19 18l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">Nama Kecamatan</p>
                                        <div class="flex flex-col">
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'kecamatan' && '{{ $sortDirection }}'
                                                    === 'asc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.lokasi.index') }}?sort_by=kecamatan&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'kecamatan' && '{{ $sortDirection }}'
                                                    === 'desc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.lokasi.index') }}?sort_by=kecamatan&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M19 18l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">Nama Kab/Kota</p>
                                        <div class="flex flex-col">
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'kab_kota' && '{{ $sortDirection }}'
                                                    === 'asc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.lokasi.index') }}?sort_by=kab_kota&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'kab_kota' && '{{ $sortDirection }}'
                                                    === 'desc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.lokasi.index') }}?sort_by=kab_kota&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M19 18l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">Nama Provinsi</p>
                                    </div>
                                </th>
                                <th width="15%">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="">
                                            Aksi
                                        </span>
                                    </div>
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($villages as $item)
                                    <tr class="">
                                        <td>
                                            <span>{{ ($villages->currentPage() - 1) * $villages->perPage() + $loop->iteration }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $item->name }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $item->kecamatan }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $item->kab_kota }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $item->province }}</span>
                                        </td>
                                        <td>
                                            <div class="flex gap-2 items-center">
                                                <a href="{{ route('dashboard.lokasi.edit', ['id' => $item->id]) }}"
                                                    class="py-2 px-3 text-white bg-blue-btn rounded-lg cursor-pointer self-center">Edit</a>

                                                <form action="{{ route('dashboard.lokasi.delete', ['id' => $item->id]) }}"
                                                    class="self-center" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    {{ csrf_field() }}
                                                    <a class="py-2 px-3 text-white bg-red-btn rounded-lg cursor-pointer"
                                                        id="deleteBtn" data-id="{{ $item->id }}">Hapus</a>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <ul class="inline-flex items-center gap-1">
                            @if ($villages->onFirstPage())
                                <li><button type="button"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60"
                                        disabled>First</button></li>
                                <li><button type="button"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60"
                                        disabled>Prev</button></li>
                            @else
                                <li><a href="{{ $villages->url(1) }}"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">First</a>
                                </li>
                                <li><a href="{{ $villages->previousPageUrl() }}"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Prev</a>
                                </li>
                            @endif

                            @for ($i = 1; $i <= $villages->lastPage(); $i++)
                                @if ($i == $villages->currentPage())
                                    <li><button type="button"
                                            class="flex justify-center h-9 w-9 items-center rounded transition border border-gray/20 hover:border-gray/60 bg-blue-btn text-white">{{ $i }}</button>
                                    </li>
                                @else
                                    <li><a href="{{ $villages->url($i) }}"
                                            class="flex justify-center h-9 w-9 items-center rounded transition border border-gray/20 hover:border-gray/60">{{ $i }}</a>
                                    </li>
                                @endif
                            @endfor

                            @if ($villages->hasMorePages())
                                <li><a href="{{ $villages->nextPageUrl() }}"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Next</a>
                                </li>
                                <li><a href="{{ $villages->url($villages->lastPage()) }}"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Last</a>
                                </li>
                            @else
                                <li><button type="button"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60"
                                        disabled>Next</button></li>
                                <li><button type="button"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60"
                                        disabled>Last</button></li>
                            @endif
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Datatables Js -->
    <script src="{{ asset('assets/js/datatable-lokasi.js') }}"></script>
    <script src="{{ asset('assets/js/data-search.js') }}"></script>

    <script>
        var toggleModal = false
        const modal = document.getElementById("modal");
        const titleModal = document.getElementById("titleModal")
        const form = document.getElementById("modalForm");
        const nameInput = document.getElementById("name");
        const idInput = document.getElementById("id");

        function toggle(params) {
            toggleModal = !toggleModal
            if (params == 'Tambah') {
                titleModal.textContent = "Tambah Desa";
            } else if (params == 'Edit') {
                titleModal.textContent = "Edit Desa";
            }
            modal.classList.toggle("hidden");
        }

        var toggleModalDelete = false
        const modalDelete = document.getElementById("modalDelete");

        function toggleDelete() {
            toggleModalDelete = !toggleModalDelete
            modalDelete.classList.toggle("hidden");
        }

        var toggleModalUpdate = false
        const modalUpdate = document.getElementById("modalUpdate");

        function toggleUpdate(id) {
            toggleModalUpdate = !toggleModalUpdate
            modalUpdate.classList.toggle("hidden");
        }
    </script>

    <script>
        // Menggunakan event delegate untuk menangani klik tombol hapus
        $(document).on('click', '#deleteBtn', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengkonfirmasi penghapusan, kirim permintaan hapus ke server
                    $.ajax({
                        url: '/dashboard/lokasi/' +
                            id, // Ganti "/data" dengan URL endpoint penghapusan sesuai kebutuhan Anda
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}' // Pastikan Anda memiliki @csrf di form Anda atau tambahkan token CSRF secara manual
                        },
                        success: function(response) {
                            // Tampilkan pesan sukses menggunakan SweetAlert2
                            Swal.fire('Sukses', 'Data berhasil dihapus', 'success').then(() => {
                                // Lakukan tindakan lanjutan setelah penghapusan data, seperti memuat ulang tabel
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            // Tampilkan pesan error menggunakan SweetAlert2
                            Swal.fire('Error', 'Terjadi kesalahan saat menghapus data',
                                'error');
                        }
                    });
                }
            });
        });
    </script>
    <script>
        // Toggling antara form manual dan import
        // Toggle antara form manual dan import
        document.getElementById('manual').addEventListener('change', function() {
            document.getElementById('manual-form').style.display = 'block';
            document.getElementById('import-form').style.display = 'none';

            // Aktifkan input manual
            const manualInputs = document.querySelectorAll('#manual-form input');
            manualInputs.forEach(input => {
                input.disabled = false; // Aktifkan input manual
            });
        });

        document.getElementById('import').addEventListener('change', function() {
            document.getElementById('import-form').style.display = 'block';
            document.getElementById('manual-form').style.display = 'none';

            // Nonaktifkan input manual
            const manualInputs = document.querySelectorAll('#manual-form input');
            manualInputs.forEach(input => {
                input.disabled = true; // Nonaktifkan input manual
            });
        });
    </script>
@endsection
