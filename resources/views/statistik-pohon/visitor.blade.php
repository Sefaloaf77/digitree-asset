@extends('layout.layout')

@push('styles')
@endpush

@section('content')
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
                    <li>Statistik Pengunjung</li>
                </ul>
            </div>
        </div>

        <div class="flex w-fit outline outline-offset-4 outline-gray-300 rounded-lg">
            <a class="px-3 py-2 bg-green-digitree/10 text-green-digitree rounded-lg"
                href="{{ route('dashboard.statistik.index') }}">Visitor</a>
            <a class="px-3 py-2" href="{{ route('dashboard.statistik.reviewer') }}">Reviewer</a>
        </div>
        <div class="grid grid-cols-1 gap-5">
            <div class="bg-white border-2 border-lightgray/10 p-5 rounded-lg">
                <div class="overflow-auto space-y-4">
                    <div class="flex justify-between items-center gap-3 w-full">
                        <div class="flex space-x-2 items-center">
                            <p>Tampilkan</p>
                            <select id="filter" class="form-select !w-20"
                                onchange="window.location.href='{{ route('dashboard.statistik.index') }}?per_page='+this.value">>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="w-full flex justify-end">
                            <form action="{{ route('dashboard.statistik.index') }}" method="get">
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
                                                    === 'scan_date' && '{{ $sortDirection }}'
                                                    === 'asc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.statistik.index') }}?sort_by=scan_date&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="4" viewBox="0 0 24 24" stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': '{{ $sortBy }}'
                                                    === 'scan_date' && '{{ $sortDirection }}'
                                                    === 'desc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.statistik.index') }}?sort_by=scan_date&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M19 18l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">Alamat IP</p>
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
                                                    === 'kab_kota' && '{{ $sortDirection }}'
                                                    === 'asc'
                                                }"
                                                onclick="window.location.href='{{ route('dashboard.statistik.index') }}?sort_by=kab_kota&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
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
                                                onclick="window.location.href='{{ route('dashboard.statistik.index') }}?sort_by=kab_kota&sort_direction={{ $sortDirection == 'asc' ? 'desc' : 'asc' }}'">
                                                <path d="M19 18l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">Lokasi</p>
                                    </div>
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($visitor as $item)
                                    <tr class="">
                                        <td>
                                            <span>{{ ($visitor->currentPage() - 1) * $visitor->perPage() + $loop->iteration }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $item->scan_date }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $item->ip_address }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $item->nama }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $item->location }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <ul class="inline-flex items-center gap-1">
                            @if ($visitor->onFirstPage())
                                <li><button type="button"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60"
                                        disabled>First</button></li>
                                <li><button type="button"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60"
                                        disabled>Prev</button></li>
                            @else
                                <li><a href="{{ $visitor->url(1) }}"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">First</a>
                                </li>
                                <li><a href="{{ $visitor->previousPageUrl() }}"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Prev</a>
                                </li>
                            @endif

                            @for ($i = 1; $i <= $visitor->lastPage(); $i++)
                                @if ($i == $visitor->currentPage())
                                    <li><button type="button"
                                            class="flex justify-center h-9 w-9 items-center rounded transition border border-gray/20 hover:border-gray/60 bg-blue-btn text-white">{{ $i }}</button>
                                    </li>
                                @else
                                    <li><a href="{{ $visitor->url($i) }}"
                                            class="flex justify-center h-9 w-9 items-center rounded transition border border-gray/20 hover:border-gray/60">{{ $i }}</a>
                                    </li>
                                @endif
                            @endfor

                            @if ($visitor->hasMorePages())
                                <li><a href="{{ $visitor->nextPageUrl() }}"
                                        class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Next</a>
                                </li>
                                <li><a href="{{ $visitor->url($visitor->lastPage()) }}"
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
@endsection
