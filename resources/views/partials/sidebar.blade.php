<nav class="sidebar fixed z-50 flex-none w-[226px] border-r-2 border-lightgray/[8%] transition-all duration-300">
    <div class="bg-green-800 h-full">
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
            <button type="button" class="shrink-0 btn-toggle hover:text-primary duration-300"
                @click="$store.app.toggleSidebar()">
                <svg class="w-3.5" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.2"
                        d="M5.46133 6.00002L11.1623 12L12.4613 10.633L8.05922 6.00002L12.4613 1.36702L11.1623 0L5.46133 6.00002Z"
                        fill="currentColor" />
                    <path d="M0 6.00002L5.70101 12L7 10.633L2.59782 6.00002L7 1.36702L5.70101 0L0 6.00002Z"
                        fill="currentColor" />
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
                <h2 class="pt-3.5 pb-2.5 text-white text-xs">Menu</h2>
                <li class="menu nav-item">
                    <a href="javaScript:;"
                        class="nav-link group items-center justify-between @if (Request::is('dashboard/semua-lokasi') || Request::is('dashboard/perlokasi')) text-green-digitree bg-[#00a85a36] @endif"
                        @click="activeMenu === 'dashboard' ? activeMenu = null : activeMenu = 'dashboard'">
                        <div class="flex items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M10.8939 22H13.1061C16.5526 22 18.2759 22 19.451 20.9882C20.626 19.9764 20.8697 18.2827 21.3572 14.8952L21.6359 12.9579C22.0154 10.3208 22.2051 9.00229 21.6646 7.87495C21.1242 6.7476 19.9738 6.06234 17.6731 4.69182L17.6731 4.69181L16.2882 3.86687C14.199 2.62229 13.1543 2 12 2C10.8457 2 9.80104 2.62229 7.71175 3.86687L6.32691 4.69181L6.32691 4.69181C4.02619 6.06234 2.87583 6.7476 2.33537 7.87495C1.79491 9.00229 1.98463 10.3208 2.36407 12.9579L2.64284 14.8952C3.13025 18.2827 3.37396 19.9764 4.54903 20.9882C5.72409 22 7.44737 22 10.8939 22Z"
                                    fill="currentColor" />
                                <path
                                    d="M9.44666 15.397C9.11389 15.1504 8.64418 15.2202 8.39752 15.5529C8.15086 15.8857 8.22067 16.3554 8.55343 16.6021C9.52585 17.3229 10.7151 17.7496 12 17.7496C13.285 17.7496 14.4742 17.3229 15.4467 16.6021C15.7794 16.3554 15.8492 15.8857 15.6026 15.5529C15.3559 15.2202 14.8862 15.1504 14.5534 15.397C13.8251 15.9369 12.9459 16.2496 12 16.2496C11.0541 16.2496 10.175 15.9369 9.44666 15.397Z"
                                    fill="currentColor" />
                            </svg>
                            <span class="pl-1.5">Dashboard</span>
                        </div>
                        <div class="w-4 h-4 flex items-center justify-center dropdown-icon"
                            :class="{ '!rotate-180': activeMenu === 'dashboard' }">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6">
                                <path
                                    d="M11.9997 13.1714L16.9495 8.22168L18.3637 9.63589L11.9997 15.9999L5.63574 9.63589L7.04996 8.22168L11.9997 13.1714Z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                    </a>
                    <ul x-cloak x-show="activeMenu === 'dashboard'" x-collapse
                        class="sub-menu flex flex-col gap-1 capitalize">
                        @can('superadmin')
                            <li>
                                <a class="@if (Request::is('dashboard/semua-lokasi')) !text-[#bfc6d2] @endif"
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
                            <a class="@if (Request::is('dashboard/perlokasi/' . $id)) !text-[#bfc6d2] @endif"
                                href="{{ route('dashboard.perlokasi', ['id' => $id]) }}">per lokasi</a>
                        </li>
                    </ul>
                </li>
                @can('superadmin')
                    <li class="menu nav-item">
                        <a href="{{ route('dashboard.pemetaan.index') }}"
                            class="nav-link group capitalize @if (Request::is('dashboard/pemetaan')) text-green-digitree bg-[#00a85a36] @endif">
                            <div class="flex items-center">
                                <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21.7383 5.4707C21.9844 5.61133 22.125 5.89258 22.125 6.13867V17.9512C22.125 18.3027 21.8789 18.6191 21.5625 18.7598L15.6562 21.0098C15.4805 21.0801 15.2695 21.0801 15.0938 21.0098L8.625 18.8652L3 21.0098C2.75391 21.1152 2.4375 21.0801 2.22656 20.9043C1.98047 20.7637 1.875 20.4824 1.875 20.2012V8.38867C1.875 8.03711 2.08594 7.75586 2.40234 7.61523L8.30859 5.36523C8.48438 5.29492 8.69531 5.29492 8.87109 5.36523L15.3398 7.50977L20.9648 5.36523C21.2109 5.25977 21.5273 5.29492 21.7383 5.4707ZM3.5625 19.0059L7.78125 17.3887V7.36914L3.5625 8.98633V19.0059ZM14.5312 9.02148L9.46875 7.33398V17.3535L14.5312 19.041V9.02148ZM16.2188 19.0059L20.4375 17.3887V7.36914L16.2188 8.98633V19.0059Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="pl-1.5">Pemetaan Asset</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu nav-item">
                        <a href="javaScript:;"
                            class="nav-link group items-center justify-between @if (Request::is('dashboard/asset') || Request::is('dashboard/lokasi')) text-green-digitree bg-[#00a85a36] @endif"
                            @click="activeMenu === 'database-asset' ? activeMenu = null : activeMenu = 'database-asset'">
                            <div class="flex items-center">
                                <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21 3.91992C21.5523 3.91992 22 4.36764 22 4.91992V20.92C22 21.4722 21.5523 21.9199 21 21.9199H3C2.44772 21.9199 2 21.4722 2 20.92V4.91992C2 4.36764 2.44772 3.91992 3 3.91992H21ZM19.9999 16.9199H3.99999V19.9199H19.9999V16.9199ZM8 5.91993H3.99999V14.92H8V5.91993ZM13.9999 5.91993H9.99999V14.92H13.9999V5.91993ZM19.9999 5.91993H16V14.92H19.9999V5.91993Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="pl-1.5">Database</span>
                            </div>
                            <div class="w-4 h-4 flex items-center justify-center dropdown-icon"
                                :class="{ '!rotate-180': activeMenu === 'database-asset' }">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6">
                                    <path
                                        d="M11.9997 13.1714L16.9495 8.22168L18.3637 9.63589L11.9997 15.9999L5.63574 9.63589L7.04996 8.22168L11.9997 13.1714Z"
                                        fill="currentColor"></path>
                                </svg>
                            </div>
                        </a>
                        <ul x-cloak x-show="activeMenu === 'database-asset'" x-collapse
                            class="sub-menu flex flex-col gap-1 capitalize">
                            <li>
                                <a class="@if (Request::is('dashboard/asset')) !text-[#050c17] @endif"
                                    href="{{ route('dashboard.asset.index') }}">Database Asset</a>
                            </li>
                            <li>
                                <a class="@if (Request::is('dashboard/lokasi')) !text-[#050c17] @endif"
                                    href="{{ route('dashboard.lokasi.index') }}">Database
                                    Lokasi</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu nav-item">
                        <a href="{{ route('dashboard.statistik.index') }}"
                            class="nav-link group @if (Request::is('dashboard/statistik/*') || Request::is('dashboard/statistik')) text-green-digitree bg-[#00a85a36] @endif">
                            <div class="flex items-center">
                                <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.25 18.2324C5.25 18.5488 5.49609 18.7949 5.8125 18.7949H19.875C20.4727 18.7949 21 19.3223 21 19.9199C21 20.5527 20.4727 21.0449 19.875 21.0449H5.8125C4.23047 21.0449 3 19.8145 3 18.2324V6.41992C3 5.82227 3.49219 5.29492 4.125 5.29492C4.72266 5.29492 5.25 5.82227 5.25 6.41992V18.2324ZM15.0234 13.9785C14.6016 14.4355 13.8633 14.4355 13.4414 13.9785L11.4375 11.9746L8.27344 15.1035C7.85156 15.5605 7.11328 15.5605 6.69141 15.1035C6.23438 14.6816 6.23438 13.9434 6.69141 13.5215L10.6289 9.58398C11.0508 9.12695 11.7891 9.12695 12.2109 9.58398L14.25 11.5879L17.9414 7.89648C18.3633 7.43945 19.1016 7.43945 19.5234 7.89648C19.9805 8.31836 19.9805 9.05664 19.5234 9.47852L15.0234 13.9785Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="pl-1.5">Statistik Asset</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu nav-item">
                        <a href="javaScript:;"
                            class="nav-link group items-center justify-between @if (Request::is('dashboard/asset/create')) text-green-digitree bg-[#00a85a36] @endif"
                            @click="activeMenu === 'tables' ? activeMenu = null : activeMenu = 'tables'">
                            <div class="flex items-center">
                                <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 13.1699C3 8.21289 7.00781 4.16992 12 4.16992C16.957 4.16992 21 8.21289 21 13.1699C21 18.1621 16.957 22.1699 12 22.1699C7.00781 22.1699 3 18.1621 3 13.1699ZM12 17.1074C12.457 17.1074 12.8438 16.7559 12.8438 16.2637V14.0137H15.0938C15.5508 14.0137 15.9375 13.6621 15.9375 13.1699C15.9375 12.7129 15.5508 12.3262 15.0938 12.3262H12.8438V10.0762C12.8438 9.61914 12.457 9.23242 12 9.23242C11.5078 9.23242 11.1562 9.61914 11.1562 10.0762V12.3262H8.90625C8.41406 12.3262 8.0625 12.7129 8.0625 13.1699C8.0625 13.6621 8.41406 14.0137 8.90625 14.0137H11.1562V16.2637C11.1562 16.7559 11.5078 17.1074 12 17.1074Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="pl-1.5">Tambah Data</span>
                            </div>
                            <div class="w-4 h-4 flex items-center justify-center dropdown-icon"
                                :class="{ '!rotate-180': activeMenu === 'tables' }">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6">
                                    <path
                                        d="M11.9997 13.1714L16.9495 8.22168L18.3637 9.63589L11.9997 15.9999L5.63574 9.63589L7.04996 8.22168L11.9997 13.1714Z"
                                        fill="currentColor"></path>
                                </svg>
                            </div>
                        </a>
                        <ul x-cloak x-show="activeMenu === 'tables'" x-collapse class="sub-menu flex flex-col gap-1">
                            <li>
                                <a class="@if (Request::is('dashboard/asset/create')) text-[#050c17] @endif"
                                    href="{{ route('dashboard.asset.create') }}">Asset Per Lokasi</a>
                            </li>
                        </ul>
                    </li>
                @endcan
            </ul>
            <ul class="relative flex sidebar-upgrade flex-col gap-1 text-sm">
                @can('superadmin')
                    <li class="menu nav-item">
                        <a href="{{ route('dashboard.user-role.index') }}"
                            class="nav-link group capitalize @if (Request::is('dashboard/user-role') || Request::is('dashboard/user-role/*')) text-green-digitree bg-[#00a85a36] @endif">
                            <div class="flex items-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3"
                                        d="M12 10C14.2091 10 16 8.20914 16 6C16 3.79086 14.2091 2 12 2C9.79086 2 8 3.79086 8 6C8 8.20914 9.79086 10 12 10Z"
                                        fill="#5A6383" />
                                    <path
                                        d="M12 21C15.866 21 19 19.2091 19 17C19 14.7909 15.866 13 12 13C8.13401 13 5 14.7909 5 17C5 19.2091 8.13401 21 12 21Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="pl-1.5">Pengaturan User</span>
                            </div>
                        </a>
                    </li>
                @endcan
                <li class="menu nav-item px-3 mt-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();"
                            class="nav-link group capitalize">
                            <div class="flex items-center">
                                <svg width="19" height="17" viewBox="0 0 19 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.375 16.125C1.47656 16.125 0 14.6133 0 12.75V3.75C0 1.88672 1.47656 0.375 3.375 0.375H5.625C6.22266 0.375 6.75 0.902344 6.75 1.5C6.75 2.13281 6.22266 2.625 5.625 2.625H3.375C2.74219 2.625 2.25 3.15234 2.25 3.75V12.75C2.25 13.3828 2.74219 13.875 3.375 13.875H5.625C6.22266 13.875 6.75 14.4023 6.75 15C6.75 15.6328 6.22266 16.125 5.625 16.125H3.375ZM17.7188 7.65234C18.0703 7.96875 18.0703 8.56641 17.7188 8.84766L12.6562 13.6289C12.4102 13.875 12.0586 13.9102 11.7422 13.8047C11.4258 13.6641 11.25 13.3477 11.25 13.0312V10.5H6.75C6.11719 10.5 5.625 10.0078 5.625 9.375V7.125C5.625 6.52734 6.11719 6 6.75 6H11.25V3.46875C11.25 3.15234 11.4258 2.83594 11.7422 2.69531C12.0586 2.58984 12.4102 2.625 12.6562 2.87109L17.7188 7.65234Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="pl-1.5">Logout</span>
                            </div>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
