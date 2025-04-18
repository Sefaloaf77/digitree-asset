<nav class="sidebar fixed z-50 flex-none w-[226px] border-r-2 border-lightgray/[8%] transition-all duration-300">
    <div class="bg-teal-600 h-full">
        <div class="p-3.5">
            <a href="{{ route('dashboard.index') }}" class="main-logo w-full">
                <img src="{{ asset('assets/img/logo-new.png') }}" class="mx-auto dark-logo h-8 logo" alt="logo" />
                <img src="{{ asset('assets/img/logo-new.png') }}" class="mx-auto light-logo h-8 logo hidden"
                    alt="logo" />
                <img src="{{ asset('assets/img/logo-new.png') }}" class="logo-icon h-8 mx-auto hidden" alt="">
            </a>
        </div>
        <div class="flex items-center gap-2.5 py-2.5 pe-2.5">
            <div class="h-[2px] bg-lightgray/10 block flex-1"></div>
            <button type="button" class="shrink-0 btn-toggle hover:bg-[#dbf3f2] duration-300"
                @click="$store.app.toggleSidebar()">
                <svg class="w-3.5" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.2"
                        d="M5.46133 6.00002L11.1623 12L12.4613 10.633L8.05922 6.00002L12.4613 1.36702L11.1623 0L5.46133 6.00002Z"
                        fill="#ffff" />
                    <path d="M0 6.00002L5.70101 12L7 10.633L2.59782 6.00002L7 1.36702L5.70101 0L0 6.00002Z"
                        fill="#ffff" />
                </svg>
            </button>
        </div>
        @php
            // Get the current path
            $currentPath = request()->path();

            if ($currentPath == '/') {
                $activemenu = 'dashboard';
                $activeitem = 'analysis';
            } else {
                // Split the path by '/'

                $pathSegments = explode('/', $currentPath);

                // Set the variables based on the segments
                $activemenu = isset($pathSegments[0]) ? $pathSegments[0] : 'dashboard';
                $activeitem = isset($pathSegments[1]) ? $pathSegments[1] : 'analysis';
            }
        @endphp

        <div class="h-[calc(100vh-93px)] overflow-y-auto overflow-x-hidden space-y-16 px-4 pt-2 pb-4">
            <ul class="relative flex flex-col gap-1 text-sm" x-data="{ activeMenu: '{{ $activemenu }}', activeItem: '{{ $activeitem }}' }">
                {{-- <h2 class="pt-3.5 pb-2.5 text-white text-xs">Menu</h2> --}}
                <li class="menu nav-item">
                    <a href="javaScript:;"
                        class="nav-link group items-center justify-between @if (Request::is('dashboard/semua-lokasi') || Request::is('dashboard/perlokasi')) text-lime-300 bg-[rgba(0,168,90,0.21)] @endif"
                        @click="activeMenu === 'dashboard' ? activeMenu = null : activeMenu = 'dashboard'">
                        <div class="flex items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M10.8939 22H13.1061C16.5526 22 18.2759 22 19.451 20.9882C20.626 19.9764 20.8697 18.2827 21.3572 14.8952L21.6359 12.9579C22.0154 10.3208 22.2051 9.00229 21.6646 7.87495C21.1242 6.7476 19.9738 6.06234 17.6731 4.69182L17.6731 4.69181L16.2882 3.86687C14.199 2.62229 13.1543 2 12 2C10.8457 2 9.80104 2.62229 7.71175 3.86687L6.32691 4.69181L6.32691 4.69181C4.02619 6.06234 2.87583 6.7476 2.33537 7.87495C1.79491 9.00229 1.98463 10.3208 2.36407 12.9579L2.64284 14.8952C3.13025 18.2827 3.37396 19.9764 4.54903 20.9882C5.72409 22 7.44737 22 10.8939 22Z"
                                    fill="#ffff" />
                                <path
                                    d="M9.44666 15.397C9.11389 15.1504 8.64418 15.2202 8.39752 15.5529C8.15086 15.8857 8.22067 16.3554 8.55343 16.6021C9.52585 17.3229 10.7151 17.7496 12 17.7496C13.285 17.7496 14.4742 17.3229 15.4467 16.6021C15.7794 16.3554 15.8492 15.8857 15.6026 15.5529C15.3559 15.2202 14.8862 15.1504 14.5534 15.397C13.8251 15.9369 12.9459 16.2496 12 16.2496C11.0541 16.2496 10.175 15.9369 9.44666 15.397Z"
                                    fill="#ffff" />
                            </svg>
                            <span class="pl-1.5 text-white">Dashboard</span>
                        </div>
                        <div class="w-4 h-4 flex items-center justify-center dropdown-icon"
                            :class="{ '!rotate-180': activeMenu === 'dashboard' }">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6">
                                <path
                                    d="M11.9997 13.1714L16.9495 8.22168L18.3637 9.63589L11.9997 15.9999L5.63574 9.63589L7.04996 8.22168L11.9997 13.1714Z"
                                    fill="#ffff"></path>
                            </svg>
                        </div>
                    </a>
                    <ul x-cloak x-show="activeMenu === 'dashboard'" x-collapse
                        class="sub-menu flex flex-col gap-1 capitalize">
                        @can('superadmin')
                            <li>
                                <a class="@if (Request::is('dashboard/semua-lokasi')) !text-[#ffff] @else !text-[#c6c6c6] @endif"
                                    href="{{ route('dashboard.index') }}">
                                    semua
                                    lokasi
                                </a>
                            </li>
                        @endcan
                        @php
                            $currentUri = Request::path(); // Mendapatkan URI saat ini
                            $segments = explode('/', $currentUri); // Memisahkan URI berdasarkan '/'
                            $id = end($segments); // Mengambil bagian terakhir dari URI sebagai ID
                        @endphp
                        <li>
                            <a class="@if (Request::is('dashboard/perlokasi/' . $id)) !text-[#ffff] @else !text-[#c6c6c6] @endif"
                                href="{{ route('dashboard.perlokasi', ['id' => $id]) }}">per lokasi</a>
                        </li>
                    </ul>
                </li>
                @can('superadmin')
                    <li class="menu nav-item">
                        <a href="{{ route('dashboard.pemetaan.index') }}"
                            class="nav-link group capitalize @if (Request::is('dashboard/pemetaan')) text-green-digitree bg-[rgba(0,168,90,0.21)] @endif">
                            <div class="flex items-center">
                                <img src="{{ asset('assets/img/icon/icon-pemetaan.svg') }}">
                                <span class="pl-1.5 text-white">Pemetaan Aset</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu nav-item">
                        <a href="javaScript:;"
                            class="nav-link group items-center justify-between @if (Request::is('dashboard/asset') || Request::is('dashboard/lokasi')) text-green-digitree bg-[rgba(0,168,90,0.21)] @endif"
                            @click="activeMenu === 'database-asset' ? activeMenu = null : activeMenu = 'database-asset'">
                            <div class="flex items-center">
                                <img src="{{ asset('assets/img/icon/icon-database.svg') }}">
                                <span class="pl-1.5 text-white">Database</span>
                            </div>
                            <div class="w-4 h-4 flex items-center justify-center dropdown-icon"
                                :class="{ '!rotate-180': activeMenu === 'database-asset' }">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6">
                                    <path
                                        d="M11.9997 13.1714L16.9495 8.22168L18.3637 9.63589L11.9997 15.9999L5.63574 9.63589L7.04996 8.22168L11.9997 13.1714Z"
                                        fill="#ffff"></path>
                                </svg>
                            </div>
                        </a>
                        <ul x-cloak x-show="activeMenu === 'database-asset'" x-collapse
                            class="sub-menu flex flex-col gap-1 capitalize">
                            <li>
                                <a class="@if (Request::is('dashboard/asset')) !text-[#ffff] @else !text-[#c6c6c6] @endif"
                                    href="{{ route('dashboard.asset.index') }}">Database Aset</a>
                            </li>
                            <li>
                                <a class="@if (Request::is('dashboard/lokasi')) !text-[#ffff] @else !text-[#c6c6c6] @endif"
                                    href="{{ route('dashboard.lokasi.index') }}">Database
                                    Lokasi</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu nav-item">
                        <a href="{{ route('dashboard.statistik.index') }}"
                            class="nav-link group @if (Request::is('dashboard/statistik/*') || Request::is('dashboard/statistik')) text-green-digitree bg-[rgba(0,168,90,0.21)] @endif">
                            <div class="flex items-center">
                                <img src="{{ asset('assets/img/icon/icon-statistik.svg') }}">
                                <span class="pl-1.5 text-white">Statistik Aset</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu nav-item">
                        <a href="{{ route('dashboard.ads.index') }}"
                            class="nav-link group @if (Request::is('dashboard/ads/*') || Request::is('dashboard/ads')) text-green-digitree bg-[rgba(0,168,90,0.21)] @endif">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <g fill="none" stroke="#ffff" stroke-width="1.5">
                                        <path
                                            d="M17.414 10.414C18 9.828 18 8.886 18 7s0-2.828-.586-3.414m0 6.828C16.828 11 15.886 11 14 11h-4c-1.886 0-2.828 0-3.414-.586m10.828 0Zm0-6.828C16.828 3 15.886 3 14 3h-4c-1.886 0-2.828 0-3.414.586m10.828 0Zm-10.828 0C6 4.172 6 5.114 6 7s0 2.828.586 3.414m0-6.828Zm0 6.828ZM13 7a1 1 0 1 1-2 0a1 1 0 0 1 2 0Z" />
                                        <path stroke-linecap="round"
                                            d="M18 6a3 3 0 0 1-3-3m3 5a3 3 0 0 0-3 3M6 6a3 3 0 0 0 3-3M6 8a3 3 0 0 1 3 3m-4 9.388h2.26c1.01 0 2.033.106 3.016.308a14.9 14.9 0 0 0 5.33.118c.868-.14 1.72-.355 2.492-.727c.696-.337 1.549-.81 2.122-1.341c.572-.53 1.168-1.397 1.59-2.075c.364-.582.188-1.295-.386-1.728a1.89 1.89 0 0 0-2.22 0l-1.807 1.365c-.7.53-1.465 1.017-2.376 1.162q-.165.026-.345.047m0 0l-.11.012m.11-.012a1 1 0 0 0 .427-.24a1.49 1.49 0 0 0 .126-2.134a1.9 1.9 0 0 0-.45-.367c-2.797-1.669-7.15-.398-9.779 1.467m9.676 1.274a.5.5 0 0 1-.11.012m0 0a9.3 9.3 0 0 1-1.814.004" />
                                        <rect width="3" height="8" x="2" y="14" rx="1.5" />
                                    </g>
                                </svg>
                                <span class="pl-1.5 text-white">Iklan</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu nav-item">
                        <a href="javaScript:;"
                            class="nav-link group items-center justify-between @if (Request::is('dashboard/asset/create')) text-green-digitree bg-[rgba(0,168,90,0.21)] @endif"
                            @click="activeMenu === 'tables' ? activeMenu = null : activeMenu = 'tables'">
                            <div class="flex items-center">
                                <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 13.1699C3 8.21289 7.00781 4.16992 12 4.16992C16.957 4.16992 21 8.21289 21 13.1699C21 18.1621 16.957 22.1699 12 22.1699C7.00781 22.1699 3 18.1621 3 13.1699ZM12 17.1074C12.457 17.1074 12.8438 16.7559 12.8438 16.2637V14.0137H15.0938C15.5508 14.0137 15.9375 13.6621 15.9375 13.1699C15.9375 12.7129 15.5508 12.3262 15.0938 12.3262H12.8438V10.0762C12.8438 9.61914 12.457 9.23242 12 9.23242C11.5078 9.23242 11.1562 9.61914 11.1562 10.0762V12.3262H8.90625C8.41406 12.3262 8.0625 12.7129 8.0625 13.1699C8.0625 13.6621 8.41406 14.0137 8.90625 14.0137H11.1562V16.2637C11.1562 16.7559 11.5078 17.1074 12 17.1074Z"
                                        fill="#ffff" />
                                </svg>
                                <span class="pl-1.5 text-white">Tambah Data</span>
                            </div>
                            <div class="w-4 h-4 flex items-center justify-center dropdown-icon"
                                :class="{ '!rotate-180': activeMenu === 'tables' }">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6">
                                    <path
                                        d="M11.9997 13.1714L16.9495 8.22168L18.3637 9.63589L11.9997 15.9999L5.63574 9.63589L7.04996 8.22168L11.9997 13.1714Z"
                                        fill="#ffff"></path>
                                </svg>
                            </div>
                        </a>
                        <ul x-cloak x-show="activeMenu === 'tables'" x-collapse class="sub-menu flex flex-col gap-1">
                            <li>
                                <a class="@if (Request::is('dashboard/asset/create')) !text-[#ffff] @else !text-[#c6c6c6] @endif"
                                    href="{{ route('dashboard.asset.create') }}">
                                    Aset Per Lokasi
                                    {{-- <span class="ml-2">&#8250;</span> <!-- Menambahkan tanda panah --> --}}
                                </a>
                            </li>
                        </ul>

                    </li>
                @endcan
            </ul>
            <ul class="relative flex sidebar-upgrade flex-col gap-1 text-sm">
                @can('superadmin')
                    <li class="menu nav-item">
                        <a href="{{ route('dashboard.user-role.index') }}"
                            class="nav-link group capitalize @if (Request::is('dashboard/user-role') || Request::is('dashboard/user-role/*')) text-lime-300 !bg-[rgba(0,168,90,0.21)] @endif">
                            <div class="flex items-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3"
                                        d="M12 10C14.2091 10 16 8.20914 16 6C16 3.79086 14.2091 2 12 2C9.79086 2 8 3.79086 8 6C8 8.20914 9.79086 10 12 10Z"
                                        fill="#ffff" />
                                    <path
                                        d="M12 21C15.866 21 19 19.2091 19 17C19 14.7909 15.866 13 12 13C8.13401 13 5 14.7909 5 17C5 19.2091 8.13401 21 12 21Z"
                                        fill="#ffff" />
                                </svg>
                                <span class="pl-1.5 text-white">Pengaturan User</span>
                            </div>
                        </a>
                    </li>
                @endcan
                <li class="menu nav-item px-3 mt-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();"
                            class="nav-link group capitalize">
                            <div class="flex items-center bg-white px-3 py-2 rounded-lg">
                                <svg width="19" height="17" viewBox="0 0 19 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.375 16.125C1.47656 16.125 0 14.6133 0 12.75V3.75C0 1.88672 1.47656 0.375 3.375 0.375H5.625C6.22266 0.375 6.75 0.902344 6.75 1.5C6.75 2.13281 6.22266 2.625 5.625 2.625H3.375C2.74219 2.625 2.25 3.15234 2.25 3.75V12.75C2.25 13.3828 2.74219 13.875 3.375 13.875H5.625C6.22266 13.875 6.75 14.4023 6.75 15C6.75 15.6328 6.22266 16.125 5.625 16.125H3.375ZM17.7188 7.65234C18.0703 7.96875 18.0703 8.56641 17.7188 8.84766L12.6562 13.6289C12.4102 13.875 12.0586 13.9102 11.7422 13.8047C11.4258 13.6641 11.25 13.3477 11.25 13.0312V10.5H6.75C6.11719 10.5 5.625 10.0078 5.625 9.375V7.125C5.625 6.52734 6.11719 6 6.75 6H11.25V3.46875C11.25 3.15234 11.4258 2.83594 11.7422 2.69531C12.0586 2.58984 12.4102 2.625 12.6562 2.87109L17.7188 7.65234Z"
                                        fill="#f7434f" />
                                </svg>
                                <span class="pl-1.5 text-[#f7434f]">Logout</span>
                            </div>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
