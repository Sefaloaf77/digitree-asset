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
                <div class="p-5 space-y-4">
                    <h5 class="font-semibold text-lg text-center">
                        Detail Review
                    </h5>
                    <div id="deskripsiModal"></div>
                </div>
            </div>
        </div>
    </div>
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
                    <li>Statistik Pengunjung</li>
                </ul>
            </div>
        </div>

        <div class="flex w-fit outline outline-offset-4 outline-gray-300 rounded-lg">
            <a class="px-3 py-2" href="{{ route('dashboard.statistik.index') }}">Visitor</a>
            <a class="px-3 py-2 bg-green-digitree/10 text-green-digitree rounded-lg"
                href="{{ route('dashboard.statistik.reviewer') }}">Reviewer</a>
        </div>
        <div class="grid grid-cols-1 gap-5">
            <div class="bg-white border-2 border-lightgray/10 p-5 rounded-lg">
                <div class="overflow-auto space-y-4">
                    <div class="flex justify-between items-center gap-3 w-full">
                        <div class="flex space-x-2 items-center">
                            <p>Tampilkan</p>
                            <select id="filter" class="form-select !w-20"
                                onchange="window.location.href='{{ route('dashboard.statistik.reviewer') }}?per_page='+this.value">>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="w-full flex justify-end">
                            <form action="{{ route('dashboard.statistik.reviewer') }}" method="get">
                                <input type="search" name="search" placeholder="Cari..." value="{{ request('search') }}"
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
                                        <p class="">Waktu</p>
                                        <div class="flex flex-col">
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'created_at' && '{{ $sortDirection }}'
                                                    === 'asc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.statistik.reviewer') }}?sort_by=created_at&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'created_at' && '{{ $sortDirection }}'
                                                    === 'desc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.statistik.reviewer') }}?sort_by=created_at&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M19 18l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">Nama Asset</p>
                                        <div class="flex flex-col">
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'name' && '{{ $sortDirection }}'
                                                    === 'asc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.statistik.reviewer') }}?sort_by=name&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
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
                                                onclick="window.location.href='{{ route('dashboard.statistik.reviewer') }}?sort_by=name&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M19 18l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">Nama Reviewer</p>
                                        <div class="flex flex-col">
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'name' && '{{ $sortDirection }}'
                                                    === 'asc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.statistik.reviewer') }}?sort_by=name&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
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
                                                onclick="window.location.href='{{ route('dashboard.statistik.reviewer') }}?sort_by=name&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M19 18l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">Nomor Telepon</p>
                                        <div class="flex flex-col">
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'phone' && '{{ $sortDirection }}'
                                                    === 'asc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.statistik.reviewer') }}?sort_by=phone&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'phone' && '{{ $sortDirection }}'
                                                    === 'desc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.statistik.reviewer') }}?sort_by=phone&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M19 18l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="5%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">Rating</p>
                                    </div>
                                </th>
                                <th width="15%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">ulasan</p>
                                        <div class="flex flex-col">
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'comment' && '{{ $sortDirection }}'
                                                    === 'asc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.statistik.reviewer') }}?sort_by=comment&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'comment' && '{{ $sortDirection }}'
                                                    === 'desc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.statistik.reviewer') }}?sort_by=comment&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M19 18l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="5%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">Aksi</p>
                                    </div>
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($reviewer as $item)
                                    <tr class="">
                                        <td>
                                            <span>{{ ($reviewer->currentPage() - 1) * $reviewer->perPage() + $loop->iteration }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $item->created_at }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $item->asset?->IndexAsset?->nama_lokal ?? '-' }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $item->name }}</span>
                                        </td>
                                        <td>
                                            <span>0{{ $item->phone }}</span>
                                        </td>
                                        <td>
                                            <div class="flex">
                                                @php
                                                    $rating = $item->rating;
                                                    $sisa = 5 - (int) $rating;
                                                @endphp
                                                @for ($i = 1; $i <= $rating; $i++)
                                                    <img src="{{ asset('assets/img/icon/star-fill.svg') }}">
                                                @endfor
                                                @for ($i = 1; $i <= $sisa; $i++)
                                                    <img src="{{ asset('assets/img/icon/star-border.svg') }}">
                                                @endfor
                                            </div>
                                        </td>
                                        <td>
                                            @if (strlen($item->comment) > 30)
                                                <span>{{ substr($item->comment, 0, 30) . '...' }}</span>
                                            @else
                                                <span>{{ $item->comment }}</span>
                                            @endif

                                        </td>
                                        <td>
                                            <a class="py-2 px-3 text-white bg-green-digitree rounded-lg cursor-pointer self-center"
                                                id="detailBtn" data-id="{{ $item->id }}">Lihat
                                                Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <ul class="inline-flex items-center gap-1">
                            @if ($reviewer->onFirstPage())
                                <li><button type="button"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60"
                                        disabled>First</button></li>
                                <li><button type="button"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60"
                                        disabled>Prev</button></li>
                            @else
                                <li><a href="{{ $reviewer->url(1) }}"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">First</a>
                                </li>
                                <li><a href="{{ $reviewer->previousPageUrl() }}"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Prev</a>
                                </li>
                            @endif

                            @for ($i = 1; $i <= $reviewer->lastPage(); $i++)
                                @if ($i == $reviewer->currentPage())
                                    <li><button type="button"
                                            class="flex justify-center h-9 w-9 items-center rounded transition border border-gray/20 hover:border-gray/60 bg-blue-btn text-white">{{ $i }}</button>
                                    </li>
                                @else
                                    <li><a href="{{ $reviewer->url($i) }}"
                                            class="flex justify-center h-9 w-9 items-center rounded transition border border-gray/20 hover:border-gray/60">{{ $i }}</a>
                                    </li>
                                @endif
                            @endfor

                            @if ($reviewer->hasMorePages())
                                <li><a href="{{ $reviewer->nextPageUrl() }}"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Next</a>
                                </li>
                                <li><a href="{{ $reviewer->url($reviewer->lastPage()) }}"
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
    <script>
        var toggleModal = true
        const modal = document.getElementById("modal");

        function toggle(params) {
            toggleModal = !toggleModal
            modal.classList.toggle("hidden");
        }

        $(document).on('click', '#detailBtn', function(e) {
            e.preventDefault()
            var id = $(this).data('id')
            console.log(id);
            $.ajax({
                url: "/dashboard/statistik/reviewer/" + id,
                type: "GET",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#deskripsiModal').html(data)
                    toggle("hidden")
                    if (data) {
                        // Mengisi modal dengan data reviewer
                        $('#deskripsiModal').html(`
                         <div class="grid grid-cols-2 gap-5 mt-4">
                            <div class="w-full space-y-4">
                                <label class="text-base font-semibold mb-4">Rating</label>
                                <div id="rating-container" class="flex mt-3"></div>
                            </div>
                            <div class="w-full space-y-4">
                                <label class="text-base font-semibold mb-4 capitalize">nama asset</label>
                                <input id="nama" type="text" name="nama"
                                    class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" value="${data.index_asset_nama}" readonly>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-5 mt-4">
                            <div class="w-full space-y-4">
                                <label class="text-base font-semibold mb-4 capitalize">nama reviewe</label>
                                <input id="nama" type="text" name="nama"
                                    class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" value="${data.name}" readonly>
                            </div>
                            <div class="w-full space-y-4">
                                <label class="text-base font-semibold mb-4 capitalize">nomor telepon</label>
                                <input id="phone" type="text" name="phone"
                                    class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" value="0${data.phone}" readonly>
                            </div>
                            </div>
                            <div class="w-full space-y-4 mt-4">
                                <label class="text-base font-semibold mb-4 capitalize">komentar</label>
                                <textarea name="comment" class="form-input mt-3 rounded-lg p-2 text-gray-800 bg-[#F2F3F6] w-full" readonly rows="6">${data.comment}</textarea>
                            </div>
                        <div class="flex justify-center items-center gap-4 mt-6">
                            <a target="_blank" href="/aset/${data.code_asset}"
                                class="btn grow border border-transparent rounded-md text-white flex justify-center items-center gap-3 bg-green-digitree">
                                <svg xmlns="http://www.w3.org/2000/svg"  class="w-6 h-6"  viewBox="0 0 24 24"><path fill="white" d="M8 16.5v.5c1.691-2.578 3.6-3.953 6-4v3c0 .551.511 1 1.143 1c.364 0 .675-.158.883-.391C17.959 14.58 22 10.5 22 10.5s-4.041-4.082-5.975-6.137A1.262 1.262 0 0 0 15.143 4C14.511 4 14 4.447 14 5v3c-4.66 0-6 4.871-6 8.5M5 21h14a1 1 0 0 0 1-1v-6.046c-.664.676-1.364 1.393-2 2.047V19H6V7h7V5H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1"/></svg>
                                <span>Lihat Aset</span>
                            </a>
                            <button type="button" class="btn grow border border-transparent rounded-md text-dark bg-[#F2F3F6]"
                                onclick="toggle()">Tutup</button>
                        </div>
                                `);

                        renderStars(data.rating);
                        $('#modal').removeClass('hidden');
                    }
                }
            })
        })

        function renderStars(rating) {
            // Mendapatkan elemen container untuk bintang
            var container = document.getElementById('rating-container');
            container.innerHTML = ''; // Menghapus konten sebelumnya jika ada

            // Menyisipkan bintang penuh
            for (var i = 1; i <= rating; i++) {
                var fullStar = document.createElement('img');
                fullStar.src = "{{ asset('assets/img/icon/star-fill.svg') }}";
                fullStar.className = "w-5 h-5";
                container.appendChild(fullStar);
            }

            // Menyisipkan bintang kosong
            var emptyStars = 5 - rating;
            for (var i = 1; i <= emptyStars; i++) {
                var emptyStar = document.createElement('img');
                emptyStar.src = "{{ asset('assets/img/icon/star-border.svg') }}";
                emptyStar.className = "w-5 h-5";
                container.appendChild(emptyStar);
            }
        }
    </script>
@endsection
