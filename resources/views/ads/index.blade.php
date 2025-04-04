@extends('layout.layout')

@push('styles')
@endpush

@section('content')
    <div class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-[99999] hidden overflow-y-auto" id="modal"
        data-mode="add">
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
                    <form action="{{ route('dashboard.ads.store') }}" id="modalForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" id="formMethod" value="POST">
                        <input type="hidden" name="id" id="id">
                        <div class="w-full space-y-4">
                            <label class="text-base font-semibold mb-4">Judul <span class="text-red-700"> *</span></label>
                            <input id="title" type="text" name="title"
                                class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]"
                                placeholder="Masukkan judul iklan..." required>
                        </div>
                        <div class="w-full space-y-4 mt-4">
                            <label class="text-base font-semibold mb-4 capitalize">Gambar Banner <span class="text-red-700">
                                    *</span></label>
                            <div
                                class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                <div class="text-center">
                                    <svg id="imageNullT" class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <img id="previewImgT" class="mx-auto w-full max-h-48 object-cover hidden">
                                    <div class="text-center mt-4">
                                        <label for="file-uploadT" class="cursor-pointer font-semibold text-indigo-600">
                                            <span>Upload New Image</span>
                                            <input id="file-uploadT" name="image" type="file" class="sr-only"
                                                accept="image/*" onchange="handleFileChangeT(event)">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center items-center gap-4 mt-6">
                            <button type="submit"
                                class="btn bg-green-digitree text-white rounded-md px-4 py-2">Simpan</button>
                            <button type="button" class="btn bg-gray-200 text-dark rounded-md px-4 py-2"
                                onclick="toggleModal()">Tutup</button>
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
                    <li>Manajemen Iklan</li>
                </ul>
            </div>
        </div>
        <button onclick="toggle('tambah')" class="py-3 px-5 rounded-lg bg-green-digitree text-white inline-block max-w-fit">
            <div class="flex items-center gap-2">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12.6562 6.875C12.6562 7.40234 12.2168 7.8418 11.7188 7.8418H7.5V12.0605C7.5 12.5586 7.06055 12.9688 6.5625 12.9688C6.03516 12.9688 5.625 12.5586 5.625 12.0605V7.8418H1.40625C0.878906 7.8418 0.46875 7.40234 0.46875 6.875C0.46875 6.37695 0.878906 5.9668 1.40625 5.9668H5.625V1.74805C5.625 1.2207 6.03516 0.78125 6.5625 0.78125C7.06055 0.78125 7.5 1.2207 7.5 1.74805V5.9668H11.7188C12.2168 5.9375 12.6562 6.37695 12.6562 6.875Z"
                        fill="white" />
                </svg>
                <span>Tambah Iklan</span>
            </div>
        </button>
        <div class="grid grid-cols-1 gap-5">
            <div class="bg-white border-2 border-lightgray/10 p-5 rounded-lg">
                <div class="overflow-auto space-y-4">
                    <div class="flex justify-between items-center gap-3 w-full">
                        <div class="flex space-x-2 items-center">
                            <p>Tampilkan</p>
                            <select id="filter" class="form-select !w-20"
                                onchange="window.location.href='{{ route('dashboard.ads.index') }}?per_page='+this.value">>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="w-full flex justify-end">
                            <form action="{{ route('dashboard.ads.index') }}" method="get">
                                <input type="search" name="search" placeholder="Cari ..."
                                    value="{{ request('search') }}"
                                    class="h-12 rounded-md border-2 border-[#7780a11a] bg-[#7780a114] text-sm text-black">
                                <button type="submit" class="h-12 bg-yellow-500 text-white rounded px-10">Cari</button>
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
                                    <p class="text-start">Gambar</p>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">Judul</p>
                                        <div class="flex flex-col">
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'title' && '{{ $sortDirection }}'
                                                    === 'asc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.ads.index') }}?sort_by=title&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'title' && '{{ $sortDirection }}'
                                                    === 'desc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.ads.index') }}?sort_by=title&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M19 18l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="15%">
                                    <div class="flex items-center justify-center gap-2">
                                        <span class="text-center">
                                            Aksi
                                        </span>
                                    </div>
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($ads as $item)
                                    <tr class="">
                                        <td>
                                            <span>{{ ($ads->currentPage() - 1) * $ads->perPage() + $loop->iteration }}</span>
                                        </td>
                                        <td>
                                            <div>
                                                <img src="{{ asset('storage/images/iklan/' . $item->image) }}"
                                                    class="w-fit max-h-40 object-contain max-w-full" alt="ads image">
                                            </div>
                                        </td>
                                        <td>
                                            <span>{{ $item->title }}</span>
                                        </td>
                                        <td>
                                            <div class="flex gap-2 items-center justify-center">
                                                <a onclick="toggle('edit', {{ $item }})"
                                                    class="py-2 px-3 text-white bg-blue-btn rounded-lg cursor-pointer self-center">Edit</a>

                                                <form action="{{ route('dashboard.ads.delete', ['id' => $item->id]) }}"
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
                            @if ($ads->onFirstPage())
                                <li><button type="button"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60"
                                        disabled>First</button></li>
                                <li><button type="button"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60"
                                        disabled>Prev</button></li>
                            @else
                                <li><a href="{{ $ads->url(1) }}"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">First</a>
                                </li>
                                <li><a href="{{ $ads->previousPageUrl() }}"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Prev</a>
                                </li>
                            @endif

                            @for ($i = 1; $i <= $ads->lastPage(); $i++)
                                @if ($i == $ads->currentPage())
                                    <li><button type="button"
                                            class="flex justify-center h-9 w-9 items-center rounded transition border border-gray/20 hover:border-gray/60 bg-blue-btn text-white">{{ $i }}</button>
                                    </li>
                                @else
                                    <li><a href="{{ $ads->url($i) }}"
                                            class="flex justify-center h-9 w-9 items-center rounded transition border border-gray/20 hover:border-gray/60">{{ $i }}</a>
                                    </li>
                                @endif
                            @endfor

                            @if ($ads->hasMorePages())
                                <li><a href="{{ $ads->nextPageUrl() }}"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Next</a>
                                </li>
                                <li><a href="{{ $ads->url($ads->lastPage()) }}"
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
                        url: '/dashboard/ads/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}' // Pastikan Anda memiliki @csrf di form Anda atau tambahkan token CSRF secara manual
                        },
                        success: function(response) {
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
        var toggleModal = false

        function toggle(mode, data = null) {
            const modal = document.getElementById("modal");
            const modalTitle = document.getElementById("titleModal");
            const modalForm = document.getElementById("modalForm");
            const formMethod = document.getElementById("formMethod");
            const idInput = document.getElementById("id");
            const titleInput = document.getElementById("title");
            const previewImg = document.getElementById("previewImgT");
            const imageNull = document.getElementById("imageNullT");

            modal.dataset.mode = mode;
            toggleModal = !toggleModal
            if (mode === "edit" && data) {
                modalTitle.innerText = "Edit Iklan";
                modalForm.action = `/dashboard/ads/${data.id}`;
                formMethod.value = "PUT";
                idInput.value = data.id;
                titleInput.value = data.title;

                // Jika ada gambar sebelumnya, tampilkan
                if (data.image) {
                    previewImg.src = `/storage/images/iklan/${data.image}`;
                    previewImg.classList.remove("hidden");
                    imageNull.classList.add("hidden");
                }
            } else if (mode == 'tambah') {
                modalTitle.innerText = "Tambah Iklan";
                modalForm.action = `/dashboard/ads`;
                formMethod.value = "POST";
                idInput.value = "";
                titleInput.value = "";
                previewImg.classList.add("hidden");
                imageNull.classList.remove("hidden");
            }

            // modal.classList.remove("hidden");
            modal.classList.toggle("hidden");
        }

        function handleFileChangeT(event) {
            // const fileInput = document.getElementById('file-uploadT');
            console.log(event);
            const previewImg = document.getElementById('previewImgT');
            if (event.target.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const imageNull = document.getElementById('imageNullT')
                    if (previewImg) { // Check if element exists
                        imageNull.classList.add('hidden')
                        previewImg.classList.remove('hidden')
                        previewImg.classList.add('block')
                        previewImg.src = e.target.result;
                    }
                };
                reader.readAsDataURL(event.target.files[0]);
            }

        }
    </script>
@endsection
