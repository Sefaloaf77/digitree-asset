<div class="h-[60px] bg-[#BDFFFC] border-b-2 border-lightgray/10 flex items-center justify-between gap-2.5 px-7">
    <div class="flex-auto flex items-center gap-2.5">
        <div class="lg:hidden">
            <button type="button" class="hover:text-primary" @click="$store.app.toggleSidebar()">
                <svg width="13" height="12" class="rotate-180" viewBox="0 0 13 12" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.2"
                        d="M5.46133 6.00002L11.1623 12L12.4613 10.633L8.05922 6.00002L12.4613 1.36702L11.1623 0L5.46133 6.00002Z"
                        fill="currentColor" />
                    <path d="M0 6.00002L5.70101 12L7 10.633L2.59782 6.00002L7 1.36702L5.70101 0L0 6.00002Z"
                        fill="currentColor" />
                </svg>
            </button>
        </div>
        <div class="max-w-[180px] md:max-w-[350px] flex-1">
            <form class="hidden min-[420px]:block w-full">
                <div class="relative">
                    <input type="text" id="search"
                        class="form-input ps-10 h-[42px] border-2 border-gray/10 bg-gray/[8%] rounded-full text-sm text-dark placeholder:text-lightgray/80 focus:ring-0 focus:border-primary/80 focus:outline-0"
                        placeholder="Search..." required="">
                    <button type="button" class="absolute inset-y-0 left-3 flex items-center">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_87_857)">
                                <circle cx="8.625" cy="8.625" r="7.125" stroke="#267DFF" stroke-width="2" />
                                <path opacity="0.3" d="M15 15L16.5 16.5" stroke="#267DFF" stroke-width="2"
                                    stroke-linecap="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_87_857">
                                    <rect width="18" height="18" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="flex items-center gap-5">
        <div x-data="{ fullScreen: false }">
            <button class="text-lightgray hover:text-primary block"
                x-bind:class="{ 'hidden': fullScreen, 'block': !fullScreen }" x-on:click="fullScreen = !fullScreen"
                @click="$store.app.toggleFullScreen()">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path d="M19 7V1H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M19 1L11.5 8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>
                    <path d="M1 13V19H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M8.5 11.5L1 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

            </button>
            <button class="text-lightgray hidden" x-bind:class="{ 'block': fullScreen, 'hidden': !fullScreen }"
                x-on:click="fullScreen = !fullScreen" @click="$store.app.toggleFullScreen()">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path d="M11.5 2.5V8.5H17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M11.5 8.5L19 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>
                    <path d="M8.5 17.5V11.5H2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M1 19L8.5 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <div class="text-lightgray hover:text-primary duration-300">
            <a href="javascript:;" x-show="$store.app.mode === 'light'" @click="$store.app.toggleMode('dark')"
                style="display: none;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                        d="M22 11.9999C22 17.5228 17.5228 21.9999 12 21.9999C10.8358 21.9999 9.71801 21.801 8.67887 21.4352C8.24138 20.3767 8 19.2165 8 17.9999C8 15.7787 8.80467 13.7454 10.1384 12.1757C11.31 13.8813 13.2744 14.9999 15.5 14.9999C17.8615 14.9999 19.9289 13.7405 21.0672 11.8568C21.3065 11.4607 22 11.5372 22 11.9999Z"
                        fill="currentColor" />
                    <path
                        d="M2 12C2 16.3586 4.78852 20.0659 8.67887 21.4353C8.24138 20.3768 8 19.2166 8 18C8 15.7788 8.80467 13.7455 10.1384 12.1758C9.42027 11.1303 9 9.86422 9 8.5C9 6.13845 10.2594 4.07105 12.1432 2.93276C12.5392 2.69347 12.4627 2 12 2C6.47715 2 2 6.47715 2 12Z"
                        fill="currentColor" />
                </svg>
            </a>
            <a href="javascript:;" x-show="$store.app.mode === 'dark'" @click="$store.app.toggleMode('light')">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18 12C18 15.3137 15.3137 18 12 18C8.68629 18 6 15.3137 6 12C6 8.68629 8.68629 6 12 6C15.3137 6 18 8.68629 18 12Z"
                        fill="currentColor" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 1.25C12.4142 1.25 12.75 1.58579 12.75 2V3C12.75 3.41421 12.4142 3.75 12 3.75C11.5858 3.75 11.25 3.41421 11.25 3V2C11.25 1.58579 11.5858 1.25 12 1.25ZM1.25 12C1.25 11.5858 1.58579 11.25 2 11.25H3C3.41421 11.25 3.75 11.5858 3.75 12C3.75 12.4142 3.41421 12.75 3 12.75H2C1.58579 12.75 1.25 12.4142 1.25 12ZM20.25 12C20.25 11.5858 20.5858 11.25 21 11.25H22C22.4142 11.25 22.75 11.5858 22.75 12C22.75 12.4142 22.4142 12.75 22 12.75H21C20.5858 12.75 20.25 12.4142 20.25 12ZM12 20.25C12.4142 20.25 12.75 20.5858 12.75 21V22C12.75 22.4142 12.4142 22.75 12 22.75C11.5858 22.75 11.25 22.4142 11.25 22V21C11.25 20.5858 11.5858 20.25 12 20.25Z"
                        fill="currentColor" />
                    <g opacity="0.3">
                        <path
                            d="M4.39838 4.39838C4.69127 4.10549 5.16615 4.10549 5.45904 4.39838L5.85188 4.79122C6.14477 5.08411 6.14477 5.55898 5.85188 5.85188C5.55898 6.14477 5.08411 6.14477 4.79122 5.85188L4.39838 5.45904C4.10549 5.16615 4.10549 4.69127 4.39838 4.39838Z"
                            fill="currentColor" />
                        <path
                            d="M19.6009 4.39864C19.8938 4.69153 19.8938 5.16641 19.6009 5.4593L19.2081 5.85214C18.9152 6.14503 18.4403 6.14503 18.1474 5.85214C17.8545 5.55924 17.8545 5.08437 18.1474 4.79148L18.5402 4.39864C18.8331 4.10575 19.308 4.10575 19.6009 4.39864Z"
                            fill="currentColor" />
                        <path
                            d="M18.1474 18.1474C18.4403 17.8545 18.9152 17.8545 19.2081 18.1474L19.6009 18.5402C19.8938 18.8331 19.8938 19.308 19.6009 19.6009C19.308 19.8938 18.8331 19.8938 18.5402 19.6009L18.1474 19.2081C17.8545 18.9152 17.8545 18.4403 18.1474 18.1474Z"
                            fill="currentColor" />
                        <path
                            d="M5.85188 18.1477C6.14477 18.4406 6.14477 18.9154 5.85188 19.2083L5.45904 19.6012C5.16615 19.8941 4.69127 19.8941 4.39838 19.6012C4.10549 19.3083 4.10549 18.8334 4.39838 18.5405L4.79122 18.1477C5.08411 17.8548 5.55898 17.8548 5.85188 18.1477Z"
                            fill="currentColor" />
                    </g>
                </svg>
            </a>
        </div>
        <div class="notification h-6" x-data="dropdown" @click.outside="open = false">
            <button type="button" class="text-lightgray hover:text-primary" @click="toggle()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3"
                        d="M18.7491 9V9.7041C18.7491 10.5491 18.9903 11.3752 19.4422 12.0782L20.5496 13.8012C21.5612 15.3749 20.789 17.5139 19.0296 18.0116C14.4273 19.3134 9.57274 19.3134 4.97036 18.0116C3.21105 17.5139 2.43882 15.3749 3.45036 13.8012L4.5578 12.0782C5.00972 11.3752 5.25087 10.5491 5.25087 9.7041V9C5.25087 5.13401 8.27256 2 12 2C15.7274 2 18.7491 5.13401 18.7491 9Z"
                        fill="currentColor" />
                    <path
                        d="M12.75 6C12.75 5.58579 12.4142 5.25 12 5.25C11.5858 5.25 11.25 5.58579 11.25 6V10C11.25 10.4142 11.5858 10.75 12 10.75C12.4142 10.75 12.75 10.4142 12.75 10V6Z"
                        fill="currentColor" />
                    <path
                        d="M7.24316 18.5449C7.8941 20.5501 9.77767 21.9997 11.9998 21.9997C14.222 21.9997 16.1055 20.5501 16.7565 18.5449C13.611 19.1352 10.3886 19.1352 7.24316 18.5449Z"
                        fill="currentColor" />
                </svg>
            </button>
            <div class="noti-area space-y-[22px]" x-show="open" x-transition="" x-transition.duration.300ms=""
                style="display: none;">
                <div class="flex items-center gap-2">
                    <h4 class="font-semibold text-dark">Notifications</h4>
                    <div x-data="{ dropdown: false }" class="dropdown ml-auto">
                        <a href="javaScript:;" class="text-lightgray h-3 flex items-center justify-center"
                            @click="dropdown = !dropdown" @keydown.escape="dropdown = false">
                            <svg width="18" height="4" viewBox="0 0 18 4" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="2" cy="2" r="2" fill="currentColor" />
                                <circle cx="9" cy="2" r="2" fill="currentColor" />
                                <circle cx="16" cy="2" r="2" fill="currentColor" />
                            </svg>
                        </a>
                        <ul x-show="dropdown" @click.away="dropdown = false" x-transition=""
                            x-transition.duration.300ms="" class="right-0 whitespace-nowrap">
                            <li><a href="javascript:;">All</a></li>
                            <li><a href="javascript:;">Read</a></li>
                            <li><a href="javascript:;">Unread</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="mt-5 space-y-[22px]">
                    <li>
                        <a href="#" class="flex items-center gap-2.5">
                            <div class="w-9 h-9 bg-primary/10 rounded-full flex items-center justify-center shrink-0">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M15.8333 9.94775V12.4998C15.8333 15.5104 13.5528 17.9882 10.625 18.3001V12.4998C10.625 12.1547 10.3452 11.8748 10 11.8748C9.65483 11.8748 9.37501 12.1547 9.37501 12.4998V18.3001C6.44724 17.9882 4.16668 15.5104 4.16668 12.4998V9.94775C4.16668 8.55831 5.03029 7.37058 6.25001 6.89204C6.62112 6.74645 7.02519 6.6665 7.44793 6.6665L12.5521 6.6665C12.9748 6.6665 13.3789 6.74645 13.75 6.89204C14.9697 7.37058 15.8333 8.55831 15.8333 9.94775Z"
                                        fill="#267DFF" />
                                    <path
                                        d="M15.8333 12.2918V11.0418H18.3333C18.6785 11.0418 18.9583 11.3216 18.9583 11.6668C18.9583 12.012 18.6785 12.2918 18.3333 12.2918H15.8333Z"
                                        fill="#267DFF" />
                                    <path
                                        d="M14.5796 16.1137C14.8386 15.7859 15.0632 15.4296 15.2479 15.0503L17.3629 16.108C17.6716 16.2623 17.7967 16.6378 17.6423 16.9465C17.488 17.2552 17.1125 17.3804 16.8038 17.226L14.5796 16.1137Z"
                                        fill="#267DFF" />
                                    <path
                                        d="M4.75217 15.0503C4.93683 15.4296 5.1614 15.7859 5.42042 16.1137L3.19622 17.226C2.88749 17.3804 2.51206 17.2552 2.35768 16.9465C2.20329 16.6378 2.32841 16.2623 2.63714 16.108L4.75217 15.0503Z"
                                        fill="#267DFF" />
                                    <path
                                        d="M4.16668 11.0418H1.66668C1.3215 11.0418 1.04168 11.3216 1.04168 11.6668C1.04168 12.012 1.3215 12.2918 1.66668 12.2918H4.16668V11.0418Z"
                                        fill="#267DFF" />
                                    <path
                                        d="M14.4612 7.27908L16.8038 6.10764C17.1125 5.95325 17.488 6.07837 17.6423 6.3871C17.7967 6.69583 17.6716 7.07126 17.3629 7.22564L15.3496 8.2324C15.1198 7.85843 14.8171 7.53406 14.4612 7.27908Z"
                                        fill="#267DFF" />
                                    <path
                                        d="M5.53879 7.27908C5.18297 7.53406 4.88024 7.85843 4.6504 8.2324L2.63714 7.22564C2.32841 7.07126 2.20329 6.69583 2.35768 6.3871C2.51206 6.07837 2.88749 5.95325 3.19622 6.10764L5.53879 7.27908Z"
                                        fill="#267DFF" />
                                    <path
                                        d="M13.75 6.89221V6.25C13.75 4.17893 12.0711 2.5 10 2.5C7.92895 2.5 6.25002 4.17893 6.25002 6.25V6.89221C6.62112 6.74661 7.02519 6.66667 7.44793 6.66667H12.5521C12.9748 6.66667 13.3789 6.74661 13.75 6.89221Z"
                                        fill="#267DFF" />
                                    <g opacity="0.5">
                                        <path
                                            d="M5.31339 1.31988C5.12192 1.60709 5.19952 1.99513 5.48673 2.1866L7.45307 3.49749C7.7877 3.18769 8.17893 2.93816 8.60951 2.76614L6.18011 1.14654C5.8929 0.955069 5.50486 1.03268 5.31339 1.31988Z"
                                            fill="#267DFF" />
                                        <path
                                            d="M12.547 3.49755C12.2124 3.18774 11.8212 2.9382 11.3906 2.76618L13.8201 1.14654C14.1073 0.955069 14.4953 1.03268 14.6868 1.31988C14.8783 1.60709 14.8006 1.99513 14.5134 2.1866L12.547 3.49755Z"
                                            fill="#267DFF" />
                                    </g>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10 11.875C10.3452 11.875 10.625 12.1548 10.625 12.5V18.3333H9.37502V12.5C9.37502 12.1548 9.65484 11.875 10 11.875Z"
                                        fill="#267DFF" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-dark">You have a bug that needs</p>
                                <p class="text-xs text-gray mt-0.5">Just now</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-2.5">
                            <div class="w-9 h-9 bg-purple/10 rounded-full flex items-center justify-center shrink-0">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="10" cy="5.49984" r="3.33333" fill="#7B6AFE" />
                                    <ellipse opacity="0.5" cx="10" cy="14.6668" rx="5.83333"
                                        ry="3.33333" fill="#7B6AFE" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-dark">New user registered</p>
                                <p class="text-xs text-gray mt-0.5">59 minutes ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-2.5">
                            <div class="w-9 h-9 bg-primary/10 rounded-full flex items-center justify-center shrink-0">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M15.8333 9.94775V12.4998C15.8333 15.5104 13.5528 17.9882 10.625 18.3001V12.4998C10.625 12.1547 10.3452 11.8748 10 11.8748C9.65483 11.8748 9.37501 12.1547 9.37501 12.4998V18.3001C6.44724 17.9882 4.16668 15.5104 4.16668 12.4998V9.94775C4.16668 8.55831 5.03029 7.37058 6.25001 6.89204C6.62112 6.74645 7.02519 6.6665 7.44793 6.6665L12.5521 6.6665C12.9748 6.6665 13.3789 6.74645 13.75 6.89204C14.9697 7.37058 15.8333 8.55831 15.8333 9.94775Z"
                                        fill="#267DFF" />
                                    <path
                                        d="M15.8333 12.2918V11.0418H18.3333C18.6785 11.0418 18.9583 11.3216 18.9583 11.6668C18.9583 12.012 18.6785 12.2918 18.3333 12.2918H15.8333Z"
                                        fill="#267DFF" />
                                    <path
                                        d="M14.5796 16.1137C14.8386 15.7859 15.0632 15.4296 15.2479 15.0503L17.3629 16.108C17.6716 16.2623 17.7967 16.6378 17.6423 16.9465C17.488 17.2552 17.1125 17.3804 16.8038 17.226L14.5796 16.1137Z"
                                        fill="#267DFF" />
                                    <path
                                        d="M4.75217 15.0503C4.93683 15.4296 5.1614 15.7859 5.42042 16.1137L3.19622 17.226C2.88749 17.3804 2.51206 17.2552 2.35768 16.9465C2.20329 16.6378 2.32841 16.2623 2.63714 16.108L4.75217 15.0503Z"
                                        fill="#267DFF" />
                                    <path
                                        d="M4.16668 11.0418H1.66668C1.3215 11.0418 1.04168 11.3216 1.04168 11.6668C1.04168 12.012 1.3215 12.2918 1.66668 12.2918H4.16668V11.0418Z"
                                        fill="#267DFF" />
                                    <path
                                        d="M14.4612 7.27908L16.8038 6.10764C17.1125 5.95325 17.488 6.07837 17.6423 6.3871C17.7967 6.69583 17.6716 7.07126 17.3629 7.22564L15.3496 8.2324C15.1198 7.85843 14.8171 7.53406 14.4612 7.27908Z"
                                        fill="#267DFF" />
                                    <path
                                        d="M5.53879 7.27908C5.18297 7.53406 4.88024 7.85843 4.6504 8.2324L2.63714 7.22564C2.32841 7.07126 2.20329 6.69583 2.35768 6.3871C2.51206 6.07837 2.88749 5.95325 3.19622 6.10764L5.53879 7.27908Z"
                                        fill="#267DFF" />
                                    <path
                                        d="M13.75 6.89221V6.25C13.75 4.17893 12.0711 2.5 10 2.5C7.92895 2.5 6.25002 4.17893 6.25002 6.25V6.89221C6.62112 6.74661 7.02519 6.66667 7.44793 6.66667H12.5521C12.9748 6.66667 13.3789 6.74661 13.75 6.89221Z"
                                        fill="#267DFF" />
                                    <g opacity="0.5">
                                        <path
                                            d="M5.31339 1.31988C5.12192 1.60709 5.19952 1.99513 5.48673 2.1866L7.45307 3.49749C7.7877 3.18769 8.17893 2.93816 8.60951 2.76614L6.18011 1.14654C5.8929 0.955069 5.50486 1.03268 5.31339 1.31988Z"
                                            fill="#267DFF" />
                                        <path
                                            d="M12.547 3.49755C12.2124 3.18774 11.8212 2.9382 11.3906 2.76618L13.8201 1.14654C14.1073 0.955069 14.4953 1.03268 14.6868 1.31988C14.8783 1.60709 14.8006 1.99513 14.5134 2.1866L12.547 3.49755Z"
                                            fill="#267DFF" />
                                    </g>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10 11.875C10.3452 11.875 10.625 12.1548 10.625 12.5V18.3333H9.37502V12.5C9.37502 12.1548 9.65484 11.875 10 11.875Z"
                                        fill="#267DFF" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-dark">You have a bug that needs</p>
                                <p class="text-xs text-gray mt-0.5">5 hours ago</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="text-end">
                    <a href="javascript:;"
                        class="text-gray font-semibold text-sm hover:text-primary duration-300">View
                        More</a>
                </div>
            </div>
        </div>
        <div class="profile z-10" x-data="dropdown" @click.outside="open = false">
            <button type="button" class="flex items-center gap-2.5" @click="toggle()">
                <img class="h-[38px] w-[38px] rounded-full" src="{{ asset('assets/images/account-profile.png') }}"
                    alt="Header Avatar">
                <div class="text-start">
                    <div class="flex items-center gap-1">
                        <span class="hidden xl:block text-sm font-semibold">
                            {{ Auth::user()->name ?? 'user' }}
                        </span>
                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.29241 5.20759C0.901881 4.81707 0.90188 4.18391 1.29241 3.79338C1.68293 3.40286 2.31609 3.40286 2.70662 3.79338L5.99951 7.08627L9.2924 3.79338C9.68293 3.40286 10.3161 3.40286 10.7066 3.79338C11.0971 4.18391 11.0971 4.81707 10.7066 5.20759L6.70662 9.2076C6.31609 9.59812 5.68293 9.59812 5.2924 9.2076L1.29241 5.20759Z"
                                fill="currentColor" />
                        </svg>
                    </div>
                    {{-- <span class="hidden xl:block text-xs text-lightgray">User</span> --}}
                </div>
            </button>
            <ul x-show="open" x-transition="" x-transition.duration.300ms="" style="display: none;">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();"
                            class="!text-danger flex items-center gap-2">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.3564 1.6665C9.42824 1.6665 8.58294 2.16709 6.89234 3.16827L6.32055 3.50688C4.62995 4.50806 3.78465 5.00865 3.32055 5.83317C2.85645 6.6577 2.85645 7.65887 2.85645 9.66122V10.3385C2.85645 12.3408 2.85645 13.342 3.32055 14.1665C3.78465 14.991 4.62995 15.4916 6.32055 16.4928L6.89234 16.8314C8.58294 17.8326 9.42824 18.3332 10.3564 18.3332C11.2846 18.3332 12.1299 17.8326 13.8205 16.8314L14.3923 16.4928C16.0829 15.4916 16.9282 14.991 17.3923 14.1665C17.8564 13.342 17.8564 12.3408 17.8564 10.3385V9.66122C17.8564 7.65887 17.8564 6.6577 17.3923 5.83317C16.9282 5.00865 16.0829 4.50806 14.3923 3.50688L13.8205 3.16827C12.1299 2.16709 11.2846 1.6665 10.3564 1.6665Z"
                                    fill="currentColor" />
                                <path
                                    d="M10.3564 6.875C8.63056 6.875 7.23145 8.27411 7.23145 10C7.23145 11.7259 8.63056 13.125 10.3564 13.125C12.0823 13.125 13.4814 11.7259 13.4814 10C13.4814 8.27411 12.0823 6.875 10.3564 6.875Z"
                                    fill="currentColor" />
                            </svg>
                            Sign Out
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
