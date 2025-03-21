@extends('Layout.layout')

@section('content')

<div class="flex flex-col gap-5 min-h-[calc(100vh-188px)] sm:min-h-[calc(100vh-204px)]">
    <div class="grid grid-cols-1 gap-4 flex-1" x-data="email">
        <div class="flex gap-5 items-stretch relative overflow-hidden" x-data="{activeTab:'profile'}">
            <div class="bg-white border-2 border-lightgray/10 rounded-lg p-5 absolute w-[240px] z-20 flex-none -left-[410px] xl:static overflow-hidden overflow-y-auto h-[calc(100vh-188px)] sm:h-[calc(100vh-204px)]" :class="isShowChatMenu && '!left-0'">
                <div class="flex flex-col space-y-5">
                    <button @click="activeTab = 'profile'" :class="activeTab === 'profile' ? 'bg-primary text-white' : 'bg-gray/[8%] text-gray hover:bg-primary hover:text-white'" class="flex duration-300 p-5 text-sm/none font-semibold items-center gap-3 rounded-lg">
                        Edit Profile
                    </button>
                    <button @click="activeTab = 'notification'" :class="activeTab === 'notification' ? 'bg-primary text-white' : 'bg-gray/[8%] text-gray hover:bg-primary hover:text-white'" class="flex duration-300 p-5 text-sm/none font-semibold items-center gap-3 rounded-lg">
                        Notifications
                    </button>
                    <button @click="activeTab = 'plan'" :class="activeTab === 'plan' ? 'bg-primary text-white' : 'bg-gray/[8%] text-gray hover:bg-primary hover:text-white'" class="flex duration-300 p-5 text-sm/none font-semibold items-center gap-3 rounded-lg">
                        Choose Plan
                    </button>
                    <button @click="activeTab = 'pw'" :class="activeTab === 'pw' ? 'bg-primary text-white' : 'bg-gray/[8%] text-gray hover:bg-primary hover:text-white'" class="flex duration-300 p-5 text-sm/none font-semibold items-center gap-3 rounded-lg">
                        Password & Security
                    </button>
                </div>
            </div>
            <div class="bg-transparent lg:hidden z-[5] w-full h-full absolute hidden" :class="isShowChatMenu && '!block xl:!hidden'" @click="isShowChatMenu = !isShowChatMenu"></div>
            <div x-show="activeTab === 'profile'" class="flex flex-row items-start gap-4 relative w-full">
                <div class="w-full flex flex-col flex-1 rounded-lg overflow-y-auto h-[calc(100vh-188px)] sm:h-[calc(100vh-204px)]">
                    <div class="flex items-center gap-5">
                        <button type="button" class="xl:hidden hover:text-primary duration-300" @click="isShowChatMenu = !isShowChatMenu">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.3" x="3" y="17.2" width="18" height="1.6" rx="0.8" fill="currentColor"></rect>
                                <rect opacity="0.5" x="3" y="11.6" width="18" height="1.6" rx="0.8" fill="currentColor"></rect>
                                <rect x="3" y="6" width="18" height="1.6" rx="0.8" fill="currentColor"></rect>
                            </svg>
                        </button>
                        <h3 class="text-lg font-semibold">Edit Profile</h3>
                    </div>
                    <div class="mt-[30px]">
                        <div class="flex flex-wrap items-center gap-5 p-5 border-2 border-gray/[0.14] rounded-lg" style="background: linear-gradient(90.17deg, rgba(48, 154, 252, 0.1) -3.08%, rgba(87, 84, 255, 0.1) 31.4%, rgba(255, 81, 164, 0.1) 65.89%, rgba(255, 124, 81, 0.1) 100.37%);">
                            <img src="{{ asset('assets/images/profile-user.png') }}" class="shrink-0 rounded-full" alt="">
                            <div class="flex items-center gap-5 flex-wrap">
                                <button type="button" class="btn bg-dark border border-dark rounded-md text-white transition-all duration-300 hover:bg-dark/[0.85] hover:border-dark/[0.85]">Upload new picture</button>
                                <button type="button" class="btn border border-transparent rounded-md transition-all duration-300 bg-gray/10 text-gray hover:bg-primary hover:text-white">Delete</button>
                            </div>
                        </div>
                    <form class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <input type="text" id="full-name" class="form-input rounded-[10px] h-14 placeholder:text-dark" placeholder="Full Name" required="">
                        <input type="email" id="email1" class="form-input rounded-[10px] h-14 placeholder:text-dark" placeholder="Email" required="">
                        <input type="password" id="password" class="form-input rounded-[10px] h-14 placeholder:text-dark" placeholder="Password" required="">
                        <input type="password" id="confirm-password" class="form-input rounded-[10px] h-14 placeholder:text-dark" placeholder="Confirm password" required="">
                        <div class="flex items-stretch gap-5">
                            <select id="country-code" class="form-select !w-20 h-14 rounded-[10px]">
                                <option value="5">+91</option>
                                <option value="10">+910</option>
                                <option value="25">+25</option>
                                <option value="50">+50</option>
                                <option value="100">+100</option>
                            </select>
                            <input type="text" id="phone-number" class="form-input rounded-[10px] h-14 placeholder:text-dark" placeholder="Phone number" required="">
                        </div>
                        <input type="date" id="date-of-birth" class="form-input rounded-[10px] h-14 placeholder:text-dark" placeholder="Date of birth" required="">
                        <input type="text" id="city" class="form-input rounded-[10px] h-14 placeholder:text-dark" placeholder="City" required="">
                        <input type="text" id="state" class="form-input rounded-[10px] h-14 placeholder:text-dark" placeholder="State" required="">
                        <input type="number" id="zip-code" class="form-input rounded-[10px] h-14 placeholder:text-dark" placeholder="Zip code" required="">
                        <input type="text" id="country1" class="form-input rounded-[10px] h-14 placeholder:text-dark" placeholder="Country" required="">
                        <input type="submit" class="btn mt-2.5 max-w-[200px] h-14 bg-primary border border-primary rounded-md text-white transition-all duration-300 hover:bg-primary/[0.85] hover:border-primary/[0.85]" value="save">
                    </form>
                    </div>
                </div>
            </div>
            <div x-show="activeTab === 'notification'" x-data="{selectedMail: false}" class="flex flex-row items-start gap-4 relative w-full h-[calc(100vh-188px)] sm:h-[calc(100vh-204px)]">
                <div class="w-full flex flex-col flex-1 rounded-lg overflow-y-auto h-[calc(100vh-188px)] sm:h-[calc(100vh-204px)]">
                    <div class="flex items-center gap-5">
                        <button type="button" class="xl:hidden hover:text-primary duration-300" @click="isShowChatMenu = !isShowChatMenu">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.3" x="3" y="17.2" width="18" height="1.6" rx="0.8" fill="currentColor"></rect>
                                <rect opacity="0.5" x="3" y="11.6" width="18" height="1.6" rx="0.8" fill="currentColor"></rect>
                                <rect x="3" y="6" width="18" height="1.6" rx="0.8" fill="currentColor"></rect>
                            </svg>
                        </button>
                        <h3 class="text-lg font-semibold">Notifications</h3>
                    </div>
                    <div class="mt-[30px] space-y-5">
                        <div class="bg-white border-2 border-lightgray/10 rounded-lg p-5 space-y-4">
                            <div class="flex items-center gap-3.5">
                                <div class="togglebutton setting inline-block">
                                    <label for="toggleD1" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="toggleD1" class="sr-only">
                                            <div class="block band bg-gray/50 w-7 h-4 rounded-full"></div>
                                            <div class="dot absolute left-1 top-1/2 -translate-y-1/2 right-0 bg-white w-2.5 h-2.5 rounded-full transition"></div>
                                        </div>
                                    </label>
                                </div>
                                <p class="text-sm font-semibold">Comments and replies</p>
                            </div>
                            <p class="text-gray text-sm">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                        <div class="bg-white border-2 border-lightgray/10 rounded-lg p-5 space-y-4">
                            <div class="flex items-center gap-3.5">
                                <div class="togglebutton setting inline-block">
                                    <label for="toggleD2" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="toggleD2" class="sr-only" checked>
                                            <div class="block band bg-gray/50 w-7 h-4 rounded-full"></div>
                                            <div class="dot absolute left-1 top-1/2 -translate-y-1/2 right-0 bg-white w-2.5 h-2.5 rounded-full transition"></div>
                                        </div>
                                    </label>
                                </div>
                                <p class="text-sm font-semibold">Messages</p>
                            </div>
                            <p class="text-gray text-sm">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                        </div>
                        <div class="bg-white border-2 border-lightgray/10 rounded-lg p-5 space-y-4">
                            <div class="flex items-center gap-3.5">
                                <div class="togglebutton setting inline-block">
                                    <label for="toggleD3" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="toggleD3" class="sr-only">
                                            <div class="block band bg-gray/50 w-7 h-4 rounded-full"></div>
                                            <div class="dot absolute left-1 top-1/2 -translate-y-1/2 right-0 bg-white w-2.5 h-2.5 rounded-full transition"></div>
                                        </div>
                                    </label>
                                </div>
                                <p class="text-sm font-semibold">Mentions</p>
                            </div>
                            <p class="text-gray text-sm">Contrary to popular belief, Lorem Ipsum is not simply random text.</p>
                        </div>
                        <div class="bg-white border-2 border-lightgray/10 rounded-lg p-5 space-y-4">
                            <div class="flex items-center gap-3.5">
                                <div class="togglebutton setting inline-block">
                                    <label for="toggleD4" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="toggleD4" class="sr-only" checked>
                                            <div class="block band bg-gray/50 w-7 h-4 rounded-full"></div>
                                            <div class="dot absolute left-1 top-1/2 -translate-y-1/2 right-0 bg-white w-2.5 h-2.5 rounded-full transition"></div>
                                        </div>
                                    </label>
                                </div>
                                <p class="text-sm font-semibold">Like</p>
                            </div>
                            <p class="text-gray text-sm">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.</p>
                        </div>
                        <div class="bg-white border-2 border-lightgray/10 rounded-lg p-5 space-y-4">
                            <div class="flex items-center gap-3.5">
                                <div class="togglebutton setting inline-block">
                                    <label for="toggleD5" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="toggleD5" class="sr-only">
                                            <div class="block band bg-gray/50 w-7 h-4 rounded-full"></div>
                                            <div class="dot absolute left-1 top-1/2 -translate-y-1/2 right-0 bg-white w-2.5 h-2.5 rounded-full transition"></div>
                                        </div>
                                    </label>
                                </div>
                                <p class="text-sm font-semibold">Comments</p>
                            </div>
                            <p class="text-gray text-sm">The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
                        </div>
                        <div class="bg-white border-2 border-lightgray/10 rounded-lg p-5 space-y-4">
                            <div class="flex items-center gap-3.5">
                                <div class="togglebutton setting inline-block">
                                    <label for="toggleD6" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="toggleD6" class="sr-only">
                                            <div class="block band bg-gray/50 w-7 h-4 rounded-full"></div>
                                            <div class="dot absolute left-1 top-1/2 -translate-y-1/2 right-0 bg-white w-2.5 h-2.5 rounded-full transition"></div>
                                        </div>
                                    </label>
                                </div>
                                <p class="text-sm font-semibold">Reminders</p>
                            </div>
                            <p class="text-gray text-sm">It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div x-show="activeTab === 'plan'" x-data="{selectedMail: false}" class="flex flex-row items-start gap-4 relative w-full h-[calc(100vh-188px)] sm:h-[calc(100vh-204px)]">
                <div class="w-full flex flex-col flex-1 rounded-lg overflow-y-auto h-[calc(100vh-188px)] sm:h-[calc(100vh-204px)]">
                    <div class="flex items-center gap-5">
                        <button type="button" class="xl:hidden hover:text-primary duration-300" @click="isShowChatMenu = !isShowChatMenu">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.3" x="3" y="17.2" width="18" height="1.6" rx="0.8" fill="currentColor"></rect>
                                <rect opacity="0.5" x="3" y="11.6" width="18" height="1.6" rx="0.8" fill="currentColor"></rect>
                                <rect x="3" y="6" width="18" height="1.6" rx="0.8" fill="currentColor"></rect>
                            </svg>
                        </button>
                        <h3 class="text-lg font-semibold">Choose Plan</h3>
                    </div>
                    <div class="mt-[30px]" x-data="{ isYearly: false }">
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <p class="text-gray">Cost - Effective, Full Service. High Security</p>
                                <div class="mt-[30px]">
                                    <div class="flex items-center gap-[30px] flex-wrap">
                                        <div class="flex justify-center items-center">
                                            <span class="text-sm/[24px] font-semibold">
                                                Monthly
                                            </span>
                                            <div class="mx-4">
                                                <label class="relative inline-block w-[42px] h-[22px] rounded-full">
                                                    <input type="checkbox" id="isYearly x-model="isYearly" class="peer opacity-0 w-0 h-0">
                                                    <span class="absolute cursor-pointer top-0 left-0 right-0 bottom-0 bg-gray/20 rounded-full duration-300 before:content-[''] before:absolute before:w-3.5 before:h-3.5 before:top-1/2 before:-translate-y-1/2 before:left-[3px] before:rounded-full before:bg-white before:duration-300 peer-checked:before:translate-x-[22px] peer-checked:bg-success"></span>
                                                </label>
                                            </div>
                                            <span class="text-sm/[24px] font-semibold">
                                                Yearly
                                            </span>
                                        </div>
                                        <span class="bg-primary text-white text-sm font-semibold py-2 px-4 rounded-full">
                                            30% discount
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-[30px]">
                            <div class="bg-white border-2 border-lightgray/10 p-5 rounded-lg">
                                <div class="flex items-center gap-5">
                                    <svg width="28" height="40" class="text-purple" viewBox="0 0 28 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_614_8769)">
                                            <path d="M18.1866 9.92589C17.8248 6.86999 16.9512 4.2336 15.7965 2.64406C15.3385 2.02442 14.6111 1.28931 13.7605 1.28931C12.91 1.28931 12.1864 2.02442 11.7284 2.64406C10.5738 4.2182 9.68472 6.87768 9.32294 9.92589C8.92597 13.0375 9.15895 16.1971 10.008 19.2168L12.7175 28.192H14.7843L17.5054 19.2168C18.3532 16.1968 18.5848 13.0372 18.1866 9.92589Z" fill="currentColor" />
                                            <path d="M25.4184 6.62754C24.3105 4.59897 22.697 2.89131 20.7345 1.67036C19.4383 0.873952 18.0136 0.308765 16.5239 0C16.9576 0.363374 17.3453 0.778249 17.6785 1.23545C19.0872 3.12903 20.1264 6.19648 20.5343 9.6488C20.9686 13.0835 20.7068 16.5705 19.7646 19.9019L17.2475 28.1921H19.9031L24.9912 20.1905C26.2826 18.1799 27.0043 15.8565 27.0796 13.4681C27.1548 11.0796 26.5807 8.71547 25.4184 6.62754Z" fill="currentColor" />
                                            <path d="M9.81554 1.23545C10.1499 0.779205 10.5376 0.364462 10.9702 0C9.48052 0.308765 8.05584 0.873952 6.75964 1.67036C5.24963 2.59418 3.93921 3.81012 2.90519 5.24692C1.87117 6.68371 1.13434 8.31245 0.73789 10.0377C0.341443 11.7629 0.293351 13.5499 0.596435 15.294C0.899518 17.038 1.54768 18.704 2.50293 20.1944L7.59097 28.1921H10.2466L7.73337 19.9019C6.79111 16.5705 6.52933 13.0835 6.96362 9.6488C7.37159 6.19648 8.41075 3.13288 9.81554 1.23545Z" fill="currentColor" />
                                            <path opacity="0.3" d="M16.1698 30.5513L15.2308 33.7034H12.2634L11.3243 30.5513H8.86108L10.2043 35.0543V40H17.2898V35.0543L18.633 30.5513H16.1698Z" fill="currentColor" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_614_8769">
                                                <rect width="28" height="40" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="font-semibold text-lg">Starter</span>
                                </div>
                                <p class="mt-5 text-gray max-w-[266px] text-sm/7">Contrary to popular belief, Lorem Ipsum not simply random text.</p>
                                <p class="font-semibold mt-10"><span class="text-[44px]">$<span x-text="isYearly ? '199' : '29'"></span></span><span class="text-gray" x-text="isYearly ? '/yr' : '/mo'"></span></p>
                                <div class="h-[2px] bg-gray/10 dark my-[30px]"></div>
                                <div class="space-y-5">
                                    <p class="flex items-center gap-2.5 text-sm">
                                        <span class="text-success">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.39786 0.511071C8.59052 -0.170358 7.40949 -0.170357 6.60215 0.511071L5.8669 1.13166C5.52376 1.42128 5.09913 1.59718 4.65169 1.63502L3.69296 1.7161C2.64025 1.80513 1.80513 2.64025 1.7161 3.69296L1.63502 4.65169C1.59718 5.09913 1.42128 5.52376 1.13166 5.86691L0.511071 6.60215C-0.170358 7.40949 -0.170357 8.59052 0.511071 9.39786L1.13166 10.1331C1.42128 10.4762 1.59718 10.9009 1.63502 11.3483L1.7161 12.3071C1.80513 13.3598 2.64025 14.1949 3.69296 14.2839L4.65169 14.365C5.09913 14.4029 5.52376 14.5788 5.86691 14.8684L6.60215 15.489C7.40949 16.1703 8.59052 16.1703 9.39786 15.489L10.1331 14.8684C10.4762 14.5788 10.9009 14.4029 11.3483 14.365L12.3071 14.2839C13.3598 14.1949 14.1949 13.3598 14.2839 12.3071L14.365 11.3483C14.4029 10.9009 14.5788 10.4762 14.8684 10.1331L15.489 9.39786C16.1703 8.59052 16.1703 7.40949 15.489 6.60215L14.8684 5.8669C14.5788 5.52376 14.4029 5.09913 14.365 4.65169L14.2839 3.69296C14.1949 2.64025 13.3598 1.80513 12.3071 1.7161L11.3483 1.63502C10.9009 1.59718 10.4762 1.42128 10.1331 1.13166L9.39786 0.511071ZM11.9408 6.52246C12.3217 6.1416 12.3217 5.52411 11.9408 5.14326C11.5601 4.7624 10.9425 4.7624 10.5616 5.14326L6.91687 8.78805L5.43928 7.31046C5.05843 6.9296 4.44094 6.9296 4.06008 7.31046C3.67922 7.69131 3.67922 8.3088 4.06008 8.68965L6.22728 10.8568C6.60814 11.2377 7.22562 11.2377 7.60648 10.8568L11.9408 6.52246Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        15 Admin account
                                    </p>
                                    <p class="flex items-center gap-2.5 text-sm">
                                        <span class="text-success">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.39786 0.511071C8.59052 -0.170358 7.40949 -0.170357 6.60215 0.511071L5.8669 1.13166C5.52376 1.42128 5.09913 1.59718 4.65169 1.63502L3.69296 1.7161C2.64025 1.80513 1.80513 2.64025 1.7161 3.69296L1.63502 4.65169C1.59718 5.09913 1.42128 5.52376 1.13166 5.86691L0.511071 6.60215C-0.170358 7.40949 -0.170357 8.59052 0.511071 9.39786L1.13166 10.1331C1.42128 10.4762 1.59718 10.9009 1.63502 11.3483L1.7161 12.3071C1.80513 13.3598 2.64025 14.1949 3.69296 14.2839L4.65169 14.365C5.09913 14.4029 5.52376 14.5788 5.86691 14.8684L6.60215 15.489C7.40949 16.1703 8.59052 16.1703 9.39786 15.489L10.1331 14.8684C10.4762 14.5788 10.9009 14.4029 11.3483 14.365L12.3071 14.2839C13.3598 14.1949 14.1949 13.3598 14.2839 12.3071L14.365 11.3483C14.4029 10.9009 14.5788 10.4762 14.8684 10.1331L15.489 9.39786C16.1703 8.59052 16.1703 7.40949 15.489 6.60215L14.8684 5.8669C14.5788 5.52376 14.4029 5.09913 14.365 4.65169L14.2839 3.69296C14.1949 2.64025 13.3598 1.80513 12.3071 1.7161L11.3483 1.63502C10.9009 1.59718 10.4762 1.42128 10.1331 1.13166L9.39786 0.511071ZM11.9408 6.52246C12.3217 6.1416 12.3217 5.52411 11.9408 5.14326C11.5601 4.7624 10.9425 4.7624 10.5616 5.14326L6.91687 8.78805L5.43928 7.31046C5.05843 6.9296 4.44094 6.9296 4.06008 7.31046C3.67922 7.69131 3.67922 8.3088 4.06008 8.68965L6.22728 10.8568C6.60814 11.2377 7.22562 11.2377 7.60648 10.8568L11.9408 6.52246Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        30-day chat history
                                    </p>
                                    <p class="flex items-center gap-2.5 text-sm">
                                        <span class="text-success">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.39786 0.511071C8.59052 -0.170358 7.40949 -0.170357 6.60215 0.511071L5.8669 1.13166C5.52376 1.42128 5.09913 1.59718 4.65169 1.63502L3.69296 1.7161C2.64025 1.80513 1.80513 2.64025 1.7161 3.69296L1.63502 4.65169C1.59718 5.09913 1.42128 5.52376 1.13166 5.86691L0.511071 6.60215C-0.170358 7.40949 -0.170357 8.59052 0.511071 9.39786L1.13166 10.1331C1.42128 10.4762 1.59718 10.9009 1.63502 11.3483L1.7161 12.3071C1.80513 13.3598 2.64025 14.1949 3.69296 14.2839L4.65169 14.365C5.09913 14.4029 5.52376 14.5788 5.86691 14.8684L6.60215 15.489C7.40949 16.1703 8.59052 16.1703 9.39786 15.489L10.1331 14.8684C10.4762 14.5788 10.9009 14.4029 11.3483 14.365L12.3071 14.2839C13.3598 14.1949 14.1949 13.3598 14.2839 12.3071L14.365 11.3483C14.4029 10.9009 14.5788 10.4762 14.8684 10.1331L15.489 9.39786C16.1703 8.59052 16.1703 7.40949 15.489 6.60215L14.8684 5.8669C14.5788 5.52376 14.4029 5.09913 14.365 4.65169L14.2839 3.69296C14.1949 2.64025 13.3598 1.80513 12.3071 1.7161L11.3483 1.63502C10.9009 1.59718 10.4762 1.42128 10.1331 1.13166L9.39786 0.511071ZM11.9408 6.52246C12.3217 6.1416 12.3217 5.52411 11.9408 5.14326C11.5601 4.7624 10.9425 4.7624 10.5616 5.14326L6.91687 8.78805L5.43928 7.31046C5.05843 6.9296 4.44094 6.9296 4.06008 7.31046C3.67922 7.69131 3.67922 8.3088 4.06008 8.68965L6.22728 10.8568C6.60814 11.2377 7.22562 11.2377 7.60648 10.8568L11.9408 6.52246Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        Email reminders
                                    </p>
                                    <p class="flex items-center gap-2.5 text-sm">
                                        <span class="text-success">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.39786 0.511071C8.59052 -0.170358 7.40949 -0.170357 6.60215 0.511071L5.8669 1.13166C5.52376 1.42128 5.09913 1.59718 4.65169 1.63502L3.69296 1.7161C2.64025 1.80513 1.80513 2.64025 1.7161 3.69296L1.63502 4.65169C1.59718 5.09913 1.42128 5.52376 1.13166 5.86691L0.511071 6.60215C-0.170358 7.40949 -0.170357 8.59052 0.511071 9.39786L1.13166 10.1331C1.42128 10.4762 1.59718 10.9009 1.63502 11.3483L1.7161 12.3071C1.80513 13.3598 2.64025 14.1949 3.69296 14.2839L4.65169 14.365C5.09913 14.4029 5.52376 14.5788 5.86691 14.8684L6.60215 15.489C7.40949 16.1703 8.59052 16.1703 9.39786 15.489L10.1331 14.8684C10.4762 14.5788 10.9009 14.4029 11.3483 14.365L12.3071 14.2839C13.3598 14.1949 14.1949 13.3598 14.2839 12.3071L14.365 11.3483C14.4029 10.9009 14.5788 10.4762 14.8684 10.1331L15.489 9.39786C16.1703 8.59052 16.1703 7.40949 15.489 6.60215L14.8684 5.8669C14.5788 5.52376 14.4029 5.09913 14.365 4.65169L14.2839 3.69296C14.1949 2.64025 13.3598 1.80513 12.3071 1.7161L11.3483 1.63502C10.9009 1.59718 10.4762 1.42128 10.1331 1.13166L9.39786 0.511071ZM11.9408 6.52246C12.3217 6.1416 12.3217 5.52411 11.9408 5.14326C11.5601 4.7624 10.9425 4.7624 10.5616 5.14326L6.91687 8.78805L5.43928 7.31046C5.05843 6.9296 4.44094 6.9296 4.06008 7.31046C3.67922 7.69131 3.67922 8.3088 4.06008 8.68965L6.22728 10.8568C6.60814 11.2377 7.22562 11.2377 7.60648 10.8568L11.9408 6.52246Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        Email & chat support
                                    </p>
                                    <p class="flex items-center gap-2.5 text-sm line-through text-gray">
                                        <span class="text-gray">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="16" height="16" rx="8" fill="gray" fill-opacity="0.2" />
                                                <path d="M5.20277 5.20277C5.47314 4.93241 5.91148 4.93241 6.18184 5.20277L8.00001 7.02094L9.81816 5.20279C10.0885 4.93243 10.5269 4.93243 10.7972 5.20279C11.0676 5.47315 11.0676 5.9115 10.7972 6.18186L8.97908 8.00001L10.7972 9.81814C11.0676 10.0885 11.0676 10.5268 10.7972 10.7972C10.5268 11.0676 10.0885 11.0676 9.81814 10.7972L8.00001 8.97908L6.18186 10.7972C5.9115 11.0676 5.47316 11.0676 5.20279 10.7972C4.93243 10.5269 4.93243 10.0885 5.20279 9.81816L7.02094 8.00001L5.20277 6.18184C4.93241 5.91148 4.93241 5.47314 5.20277 5.20277Z" fill="gray" />
                                            </svg>
                                        </span>
                                        Template Library
                                    </p>
                                </div>
                                <div class="mt-10">
                                    <a href="javascript:;" class="bg-gray/10 block text-center rounded-full py-5 px-3 uppercase text-xs font-extrabold tracking-[3px] hover:bg-dark hover:text-white duration-300">Get Started</a>
                                </div>
                            </div>
                            <div class="bg-white border-2 border-lightgray/10 p-5 rounded-lg">
                                <div class="flex items-center gap-5">
                                    <svg width="40" height="40" class="text-pink" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_614_8877)">
                                            <path opacity="0.3" d="M33.2485 28.5688L36.8879 24.9248L35.2315 23.2684L32.4787 26.0212L31.5828 23.0538L35.0915 19.5451L33.4352 17.8887L30.8177 20.5296L30.0805 18.0987L22.2092 25.6293L31.2096 40L35.4088 35.8008L33.2485 28.5688Z" fill="currentColor" />
                                            <path opacity="0.3" d="M21.9293 9.91484L19.4984 9.18231L22.1206 6.56479L20.4642 4.90376L16.9462 8.39846L13.9974 7.52128L16.7456 4.76845L15.0706 3.11209L11.4312 6.75142L4.19923 4.57716L0 8.77639L14.3707 17.7861L21.9293 9.91484Z" fill="currentColor" />
                                            <path d="M38.8522 6.41549C39.2432 6.08122 39.561 5.66972 39.7854 5.20683C40.0099 4.74394 40.1362 4.23965 40.1565 3.72561C40.1768 3.21157 40.0907 2.69889 39.9034 2.21973C39.7162 1.74057 39.4319 1.30529 39.0685 0.941205C38.7051 0.577119 38.2703 0.292091 37.7915 0.104009C37.3126 -0.0840732 36.8001 -0.171148 36.286 -0.151749C35.772 -0.13235 35.2674 -0.00689727 34.8042 0.216736C34.3409 0.440368 33.9288 0.757353 33.5938 1.14779L10.7967 24.8968L3.63 23.3291L0.0419922 26.9171L8.35647 31.6435L13.0643 39.9533L16.6523 36.3653L15.1032 29.1987L38.8522 6.41549Z" fill="currentColor" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_614_8877">
                                                <rect width="40" height="40" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="font-semibold text-lg">Enterprise</span>
                                </div>
                                <p class="mt-5 text-gray max-w-[266px] text-sm/7">Contrary to popular belief, Lorem Ipsum not simply random text.</p>
                                <p class="font-semibold mt-10"><span class="text-[44px]">$<span x-text="isYearly ? '399' : '49'"></span></span><span class="text-gray" x-text="isYearly ? '/yr' : '/mo'"></span></p>
                                <div class="h-[2px] bg-gray/10 dark my-[30px]"></div>
                                <div class="space-y-5">
                                    <p class="flex items-center gap-2.5 text-sm">
                                        <span class="text-success">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.39786 0.511071C8.59052 -0.170358 7.40949 -0.170357 6.60215 0.511071L5.8669 1.13166C5.52376 1.42128 5.09913 1.59718 4.65169 1.63502L3.69296 1.7161C2.64025 1.80513 1.80513 2.64025 1.7161 3.69296L1.63502 4.65169C1.59718 5.09913 1.42128 5.52376 1.13166 5.86691L0.511071 6.60215C-0.170358 7.40949 -0.170357 8.59052 0.511071 9.39786L1.13166 10.1331C1.42128 10.4762 1.59718 10.9009 1.63502 11.3483L1.7161 12.3071C1.80513 13.3598 2.64025 14.1949 3.69296 14.2839L4.65169 14.365C5.09913 14.4029 5.52376 14.5788 5.86691 14.8684L6.60215 15.489C7.40949 16.1703 8.59052 16.1703 9.39786 15.489L10.1331 14.8684C10.4762 14.5788 10.9009 14.4029 11.3483 14.365L12.3071 14.2839C13.3598 14.1949 14.1949 13.3598 14.2839 12.3071L14.365 11.3483C14.4029 10.9009 14.5788 10.4762 14.8684 10.1331L15.489 9.39786C16.1703 8.59052 16.1703 7.40949 15.489 6.60215L14.8684 5.8669C14.5788 5.52376 14.4029 5.09913 14.365 4.65169L14.2839 3.69296C14.1949 2.64025 13.3598 1.80513 12.3071 1.7161L11.3483 1.63502C10.9009 1.59718 10.4762 1.42128 10.1331 1.13166L9.39786 0.511071ZM11.9408 6.52246C12.3217 6.1416 12.3217 5.52411 11.9408 5.14326C11.5601 4.7624 10.9425 4.7624 10.5616 5.14326L6.91687 8.78805L5.43928 7.31046C5.05843 6.9296 4.44094 6.9296 4.06008 7.31046C3.67922 7.69131 3.67922 8.3088 4.06008 8.68965L6.22728 10.8568C6.60814 11.2377 7.22562 11.2377 7.60648 10.8568L11.9408 6.52246Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        Unlimited Admin account
                                    </p>
                                    <p class="flex items-center gap-2.5 text-sm">
                                        <span class="text-success">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.39786 0.511071C8.59052 -0.170358 7.40949 -0.170357 6.60215 0.511071L5.8669 1.13166C5.52376 1.42128 5.09913 1.59718 4.65169 1.63502L3.69296 1.7161C2.64025 1.80513 1.80513 2.64025 1.7161 3.69296L1.63502 4.65169C1.59718 5.09913 1.42128 5.52376 1.13166 5.86691L0.511071 6.60215C-0.170358 7.40949 -0.170357 8.59052 0.511071 9.39786L1.13166 10.1331C1.42128 10.4762 1.59718 10.9009 1.63502 11.3483L1.7161 12.3071C1.80513 13.3598 2.64025 14.1949 3.69296 14.2839L4.65169 14.365C5.09913 14.4029 5.52376 14.5788 5.86691 14.8684L6.60215 15.489C7.40949 16.1703 8.59052 16.1703 9.39786 15.489L10.1331 14.8684C10.4762 14.5788 10.9009 14.4029 11.3483 14.365L12.3071 14.2839C13.3598 14.1949 14.1949 13.3598 14.2839 12.3071L14.365 11.3483C14.4029 10.9009 14.5788 10.4762 14.8684 10.1331L15.489 9.39786C16.1703 8.59052 16.1703 7.40949 15.489 6.60215L14.8684 5.8669C14.5788 5.52376 14.4029 5.09913 14.365 4.65169L14.2839 3.69296C14.1949 2.64025 13.3598 1.80513 12.3071 1.7161L11.3483 1.63502C10.9009 1.59718 10.4762 1.42128 10.1331 1.13166L9.39786 0.511071ZM11.9408 6.52246C12.3217 6.1416 12.3217 5.52411 11.9408 5.14326C11.5601 4.7624 10.9425 4.7624 10.5616 5.14326L6.91687 8.78805L5.43928 7.31046C5.05843 6.9296 4.44094 6.9296 4.06008 7.31046C3.67922 7.69131 3.67922 8.3088 4.06008 8.68965L6.22728 10.8568C6.60814 11.2377 7.22562 11.2377 7.60648 10.8568L11.9408 6.52246Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        Unlimited chat history
                                    </p>
                                    <p class="flex items-center gap-2.5 text-sm">
                                        <span class="text-success">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.39786 0.511071C8.59052 -0.170358 7.40949 -0.170357 6.60215 0.511071L5.8669 1.13166C5.52376 1.42128 5.09913 1.59718 4.65169 1.63502L3.69296 1.7161C2.64025 1.80513 1.80513 2.64025 1.7161 3.69296L1.63502 4.65169C1.59718 5.09913 1.42128 5.52376 1.13166 5.86691L0.511071 6.60215C-0.170358 7.40949 -0.170357 8.59052 0.511071 9.39786L1.13166 10.1331C1.42128 10.4762 1.59718 10.9009 1.63502 11.3483L1.7161 12.3071C1.80513 13.3598 2.64025 14.1949 3.69296 14.2839L4.65169 14.365C5.09913 14.4029 5.52376 14.5788 5.86691 14.8684L6.60215 15.489C7.40949 16.1703 8.59052 16.1703 9.39786 15.489L10.1331 14.8684C10.4762 14.5788 10.9009 14.4029 11.3483 14.365L12.3071 14.2839C13.3598 14.1949 14.1949 13.3598 14.2839 12.3071L14.365 11.3483C14.4029 10.9009 14.5788 10.4762 14.8684 10.1331L15.489 9.39786C16.1703 8.59052 16.1703 7.40949 15.489 6.60215L14.8684 5.8669C14.5788 5.52376 14.4029 5.09913 14.365 4.65169L14.2839 3.69296C14.1949 2.64025 13.3598 1.80513 12.3071 1.7161L11.3483 1.63502C10.9009 1.59718 10.4762 1.42128 10.1331 1.13166L9.39786 0.511071ZM11.9408 6.52246C12.3217 6.1416 12.3217 5.52411 11.9408 5.14326C11.5601 4.7624 10.9425 4.7624 10.5616 5.14326L6.91687 8.78805L5.43928 7.31046C5.05843 6.9296 4.44094 6.9296 4.06008 7.31046C3.67922 7.69131 3.67922 8.3088 4.06008 8.68965L6.22728 10.8568C6.60814 11.2377 7.22562 11.2377 7.60648 10.8568L11.9408 6.52246Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        Email & SMS reminders
                                    </p>
                                    <p class="flex items-center gap-2.5 text-sm">
                                        <span class="text-success">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.39786 0.511071C8.59052 -0.170358 7.40949 -0.170357 6.60215 0.511071L5.8669 1.13166C5.52376 1.42128 5.09913 1.59718 4.65169 1.63502L3.69296 1.7161C2.64025 1.80513 1.80513 2.64025 1.7161 3.69296L1.63502 4.65169C1.59718 5.09913 1.42128 5.52376 1.13166 5.86691L0.511071 6.60215C-0.170358 7.40949 -0.170357 8.59052 0.511071 9.39786L1.13166 10.1331C1.42128 10.4762 1.59718 10.9009 1.63502 11.3483L1.7161 12.3071C1.80513 13.3598 2.64025 14.1949 3.69296 14.2839L4.65169 14.365C5.09913 14.4029 5.52376 14.5788 5.86691 14.8684L6.60215 15.489C7.40949 16.1703 8.59052 16.1703 9.39786 15.489L10.1331 14.8684C10.4762 14.5788 10.9009 14.4029 11.3483 14.365L12.3071 14.2839C13.3598 14.1949 14.1949 13.3598 14.2839 12.3071L14.365 11.3483C14.4029 10.9009 14.5788 10.4762 14.8684 10.1331L15.489 9.39786C16.1703 8.59052 16.1703 7.40949 15.489 6.60215L14.8684 5.8669C14.5788 5.52376 14.4029 5.09913 14.365 4.65169L14.2839 3.69296C14.1949 2.64025 13.3598 1.80513 12.3071 1.7161L11.3483 1.63502C10.9009 1.59718 10.4762 1.42128 10.1331 1.13166L9.39786 0.511071ZM11.9408 6.52246C12.3217 6.1416 12.3217 5.52411 11.9408 5.14326C11.5601 4.7624 10.9425 4.7624 10.5616 5.14326L6.91687 8.78805L5.43928 7.31046C5.05843 6.9296 4.44094 6.9296 4.06008 7.31046C3.67922 7.69131 3.67922 8.3088 4.06008 8.68965L6.22728 10.8568C6.60814 11.2377 7.22562 11.2377 7.60648 10.8568L11.9408 6.52246Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        Email & chat support
                                    </p>
                                    <p class="flex items-center gap-2.5 text-sm">
                                        <span class="text-success">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.39786 0.511071C8.59052 -0.170358 7.40949 -0.170357 6.60215 0.511071L5.8669 1.13166C5.52376 1.42128 5.09913 1.59718 4.65169 1.63502L3.69296 1.7161C2.64025 1.80513 1.80513 2.64025 1.7161 3.69296L1.63502 4.65169C1.59718 5.09913 1.42128 5.52376 1.13166 5.86691L0.511071 6.60215C-0.170358 7.40949 -0.170357 8.59052 0.511071 9.39786L1.13166 10.1331C1.42128 10.4762 1.59718 10.9009 1.63502 11.3483L1.7161 12.3071C1.80513 13.3598 2.64025 14.1949 3.69296 14.2839L4.65169 14.365C5.09913 14.4029 5.52376 14.5788 5.86691 14.8684L6.60215 15.489C7.40949 16.1703 8.59052 16.1703 9.39786 15.489L10.1331 14.8684C10.4762 14.5788 10.9009 14.4029 11.3483 14.365L12.3071 14.2839C13.3598 14.1949 14.1949 13.3598 14.2839 12.3071L14.365 11.3483C14.4029 10.9009 14.5788 10.4762 14.8684 10.1331L15.489 9.39786C16.1703 8.59052 16.1703 7.40949 15.489 6.60215L14.8684 5.8669C14.5788 5.52376 14.4029 5.09913 14.365 4.65169L14.2839 3.69296C14.1949 2.64025 13.3598 1.80513 12.3071 1.7161L11.3483 1.63502C10.9009 1.59718 10.4762 1.42128 10.1331 1.13166L9.39786 0.511071ZM11.9408 6.52246C12.3217 6.1416 12.3217 5.52411 11.9408 5.14326C11.5601 4.7624 10.9425 4.7624 10.5616 5.14326L6.91687 8.78805L5.43928 7.31046C5.05843 6.9296 4.44094 6.9296 4.06008 7.31046C3.67922 7.69131 3.67922 8.3088 4.06008 8.68965L6.22728 10.8568C6.60814 11.2377 7.22562 11.2377 7.60648 10.8568L11.9408 6.52246Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        Template Library
                                    </p>
                                </div>
                                <div class="mt-10">
                                    <a href="javascript:;" class="block text-center rounded-full py-5 px-3 uppercase text-xs font-extrabold tracking-[3px] bg-dark text-white duration-300">Get Started</a>
                                </div>
                            </div>
                            <div class="bg-white border-2 border-lightgray/10 p-5 rounded-lg">
                                <div class="flex items-center gap-5">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_614_8762)">
                                            <path d="M37.9991 0.343757L35.5752 2.76773C31.7223 2.18289 27.7859 2.51508 24.0855 3.73732L36.2627 15.9145C37.4853 12.2081 37.8174 8.26589 37.2323 4.40722L39.6651 2.00087C39.8848 1.77996 40.0078 1.4808 40.007 1.1692C40.0061 0.857603 39.8816 0.559098 39.6607 0.33935C39.4397 0.119603 39.1406 -0.00338585 38.829 -0.00255934C38.5174 -0.00173283 38.2189 0.122841 37.9991 0.343757Z" fill="#7B6AFE" />
                                            <path opacity="0.3" d="M20.2292 14.7995C19.734 15.2917 19.3961 15.9199 19.2584 16.6044C19.1206 17.2889 19.1892 17.9989 19.4555 18.6444C19.7217 19.2899 20.1736 19.8418 20.7539 20.2301C21.3341 20.6185 22.0166 20.8258 22.7149 20.8258C23.4131 20.8258 24.0956 20.6185 24.6759 20.2301C25.2561 19.8418 25.708 19.2899 25.9743 18.6444C26.2405 17.9989 26.3091 17.2889 26.1714 16.6044C26.0336 15.9199 25.6957 15.2917 25.2005 14.7995C24.5399 14.1428 23.6463 13.7742 22.7149 13.7742C21.7834 13.7742 20.8898 14.1428 20.2292 14.7995Z" fill="#7B6AFE" />
                                            <path d="M35.2887 18.2547L21.7453 4.71132C19.9522 5.59195 18.3148 6.75901 16.8973 8.16659C13.2349 11.829 12.1199 14.6805 10.7052 18.3032C10.0397 20 9.27282 21.9524 8.13135 24.2662L15.7426 31.851C18.0564 30.7051 20.0088 29.9427 21.7056 29.2772C25.3195 27.8625 28.171 26.743 31.8422 23.0851C33.2515 21.668 34.4201 20.0305 35.3019 18.2371L35.2887 18.2547ZM26.8577 21.4279C26.0384 22.2468 24.9947 22.8043 23.8586 23.03C22.7225 23.2558 21.545 23.1396 20.4749 22.6962C19.4048 22.2528 18.4903 21.502 17.8468 20.5389C17.2033 19.5758 16.8599 18.4434 16.8599 17.2851C16.8599 16.1268 17.2033 14.9945 17.8468 14.0314C18.4903 13.0682 19.4048 12.3175 20.4749 11.8741C21.545 11.4307 22.7225 11.3145 23.8586 11.5402C24.9947 11.766 26.0384 12.3235 26.8577 13.1423C27.9546 14.242 28.5707 15.7319 28.5707 17.2851C28.5707 18.8384 27.9546 20.3283 26.8577 21.4279Z" fill="#7B6AFE" />
                                            <path opacity="0.3" d="M4.48654 28.885C3.16437 30.2071 1.9656 35.0551 1.52488 37.078C1.48374 37.2701 1.49133 37.4694 1.54698 37.6578C1.60262 37.8462 1.70454 38.0176 1.84344 38.1565C1.98234 38.2954 2.1538 38.3974 2.34218 38.453C2.53057 38.5086 2.72989 38.5162 2.92197 38.4751C4.93607 38.0344 9.7708 36.8576 11.115 35.5134C11.898 34.619 12.3116 33.4604 12.2722 32.2723C12.2328 31.0842 11.7432 29.9555 10.9026 29.115C10.0621 28.2744 8.9334 27.7848 7.74533 27.7454C6.55725 27.706 5.39861 28.1196 4.50416 28.9026L4.48654 28.885Z" fill="#7B6AFE" />
                                            <path d="M0.176298 22.8735C0.318299 23.0941 0.529452 23.2613 0.776684 23.3491C1.02392 23.4368 1.29326 23.44 1.54254 23.3583C2.97717 22.7699 4.5752 22.7152 6.04673 23.2041C7.14853 20.9784 7.88895 19.0921 8.54122 17.4306C8.73954 16.9193 8.93787 16.4169 9.1406 15.9233C6.94541 15.9994 4.86116 16.9069 3.30984 18.4619L0.343773 21.4279C0.157092 21.6148 0.0389816 21.8592 0.00858443 22.1216C-0.0218128 22.384 0.0372844 22.6489 0.176298 22.8735Z" fill="#7B6AFE" />
                                            <path d="M17.1265 39.8237C17.3501 39.9638 17.6145 40.0244 17.8769 39.9956C18.1392 39.9668 18.3842 39.8503 18.5721 39.665L21.5381 36.699C23.094 35.1419 23.9985 33.0507 24.0679 30.8506C23.5743 31.0533 23.0719 31.2517 22.5606 31.45C20.8991 32.1022 19.0348 32.8427 16.7871 33.9401C17.2713 35.4138 17.2166 37.0115 16.6329 38.4487C16.5474 38.6999 16.5496 38.9727 16.6393 39.2225C16.729 39.4723 16.9007 39.6842 17.1265 39.8237Z" fill="#7B6AFE" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_614_8762">
                                                <rect width="40" height="40" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="font-semibold text-lg">Agency</span>
                                </div>
                                <p class="mt-5 text-gray max-w-[266px] text-sm/7">Contrary to popular belief, Lorem Ipsum not simply random text.</p>
                                <p class="font-semibold mt-10"><span class="text-[44px]">$<span x-text="isYearly ? '899' : '99'"></span></span><span class="text-gray" x-text="isYearly ? '/yr' : '/mo'"></span></p>
                                <div class="h-[2px] bg-gray/10 dark my-[30px]"></div>
                                <div class="space-y-5">
                                    <p class="flex items-center gap-2.5 text-sm">
                                        <span class="text-success">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.39786 0.511071C8.59052 -0.170358 7.40949 -0.170357 6.60215 0.511071L5.8669 1.13166C5.52376 1.42128 5.09913 1.59718 4.65169 1.63502L3.69296 1.7161C2.64025 1.80513 1.80513 2.64025 1.7161 3.69296L1.63502 4.65169C1.59718 5.09913 1.42128 5.52376 1.13166 5.86691L0.511071 6.60215C-0.170358 7.40949 -0.170357 8.59052 0.511071 9.39786L1.13166 10.1331C1.42128 10.4762 1.59718 10.9009 1.63502 11.3483L1.7161 12.3071C1.80513 13.3598 2.64025 14.1949 3.69296 14.2839L4.65169 14.365C5.09913 14.4029 5.52376 14.5788 5.86691 14.8684L6.60215 15.489C7.40949 16.1703 8.59052 16.1703 9.39786 15.489L10.1331 14.8684C10.4762 14.5788 10.9009 14.4029 11.3483 14.365L12.3071 14.2839C13.3598 14.1949 14.1949 13.3598 14.2839 12.3071L14.365 11.3483C14.4029 10.9009 14.5788 10.4762 14.8684 10.1331L15.489 9.39786C16.1703 8.59052 16.1703 7.40949 15.489 6.60215L14.8684 5.8669C14.5788 5.52376 14.4029 5.09913 14.365 4.65169L14.2839 3.69296C14.1949 2.64025 13.3598 1.80513 12.3071 1.7161L11.3483 1.63502C10.9009 1.59718 10.4762 1.42128 10.1331 1.13166L9.39786 0.511071ZM11.9408 6.52246C12.3217 6.1416 12.3217 5.52411 11.9408 5.14326C11.5601 4.7624 10.9425 4.7624 10.5616 5.14326L6.91687 8.78805L5.43928 7.31046C5.05843 6.9296 4.44094 6.9296 4.06008 7.31046C3.67922 7.69131 3.67922 8.3088 4.06008 8.68965L6.22728 10.8568C6.60814 11.2377 7.22562 11.2377 7.60648 10.8568L11.9408 6.52246Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        Unlimited Admin account
                                    </p>
                                    <p class="flex items-center gap-2.5 text-sm">
                                        <span class="text-success">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.39786 0.511071C8.59052 -0.170358 7.40949 -0.170357 6.60215 0.511071L5.8669 1.13166C5.52376 1.42128 5.09913 1.59718 4.65169 1.63502L3.69296 1.7161C2.64025 1.80513 1.80513 2.64025 1.7161 3.69296L1.63502 4.65169C1.59718 5.09913 1.42128 5.52376 1.13166 5.86691L0.511071 6.60215C-0.170358 7.40949 -0.170357 8.59052 0.511071 9.39786L1.13166 10.1331C1.42128 10.4762 1.59718 10.9009 1.63502 11.3483L1.7161 12.3071C1.80513 13.3598 2.64025 14.1949 3.69296 14.2839L4.65169 14.365C5.09913 14.4029 5.52376 14.5788 5.86691 14.8684L6.60215 15.489C7.40949 16.1703 8.59052 16.1703 9.39786 15.489L10.1331 14.8684C10.4762 14.5788 10.9009 14.4029 11.3483 14.365L12.3071 14.2839C13.3598 14.1949 14.1949 13.3598 14.2839 12.3071L14.365 11.3483C14.4029 10.9009 14.5788 10.4762 14.8684 10.1331L15.489 9.39786C16.1703 8.59052 16.1703 7.40949 15.489 6.60215L14.8684 5.8669C14.5788 5.52376 14.4029 5.09913 14.365 4.65169L14.2839 3.69296C14.1949 2.64025 13.3598 1.80513 12.3071 1.7161L11.3483 1.63502C10.9009 1.59718 10.4762 1.42128 10.1331 1.13166L9.39786 0.511071ZM11.9408 6.52246C12.3217 6.1416 12.3217 5.52411 11.9408 5.14326C11.5601 4.7624 10.9425 4.7624 10.5616 5.14326L6.91687 8.78805L5.43928 7.31046C5.05843 6.9296 4.44094 6.9296 4.06008 7.31046C3.67922 7.69131 3.67922 8.3088 4.06008 8.68965L6.22728 10.8568C6.60814 11.2377 7.22562 11.2377 7.60648 10.8568L11.9408 6.52246Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        Unlimited chat history
                                    </p>
                                    <p class="flex items-center gap-2.5 text-sm">
                                        <span class="text-success">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.39786 0.511071C8.59052 -0.170358 7.40949 -0.170357 6.60215 0.511071L5.8669 1.13166C5.52376 1.42128 5.09913 1.59718 4.65169 1.63502L3.69296 1.7161C2.64025 1.80513 1.80513 2.64025 1.7161 3.69296L1.63502 4.65169C1.59718 5.09913 1.42128 5.52376 1.13166 5.86691L0.511071 6.60215C-0.170358 7.40949 -0.170357 8.59052 0.511071 9.39786L1.13166 10.1331C1.42128 10.4762 1.59718 10.9009 1.63502 11.3483L1.7161 12.3071C1.80513 13.3598 2.64025 14.1949 3.69296 14.2839L4.65169 14.365C5.09913 14.4029 5.52376 14.5788 5.86691 14.8684L6.60215 15.489C7.40949 16.1703 8.59052 16.1703 9.39786 15.489L10.1331 14.8684C10.4762 14.5788 10.9009 14.4029 11.3483 14.365L12.3071 14.2839C13.3598 14.1949 14.1949 13.3598 14.2839 12.3071L14.365 11.3483C14.4029 10.9009 14.5788 10.4762 14.8684 10.1331L15.489 9.39786C16.1703 8.59052 16.1703 7.40949 15.489 6.60215L14.8684 5.8669C14.5788 5.52376 14.4029 5.09913 14.365 4.65169L14.2839 3.69296C14.1949 2.64025 13.3598 1.80513 12.3071 1.7161L11.3483 1.63502C10.9009 1.59718 10.4762 1.42128 10.1331 1.13166L9.39786 0.511071ZM11.9408 6.52246C12.3217 6.1416 12.3217 5.52411 11.9408 5.14326C11.5601 4.7624 10.9425 4.7624 10.5616 5.14326L6.91687 8.78805L5.43928 7.31046C5.05843 6.9296 4.44094 6.9296 4.06008 7.31046C3.67922 7.69131 3.67922 8.3088 4.06008 8.68965L6.22728 10.8568C6.60814 11.2377 7.22562 11.2377 7.60648 10.8568L11.9408 6.52246Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        Email & SMS reminders
                                    </p>
                                    <p class="flex items-center gap-2.5 text-sm">
                                        <span class="text-success">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.39786 0.511071C8.59052 -0.170358 7.40949 -0.170357 6.60215 0.511071L5.8669 1.13166C5.52376 1.42128 5.09913 1.59718 4.65169 1.63502L3.69296 1.7161C2.64025 1.80513 1.80513 2.64025 1.7161 3.69296L1.63502 4.65169C1.59718 5.09913 1.42128 5.52376 1.13166 5.86691L0.511071 6.60215C-0.170358 7.40949 -0.170357 8.59052 0.511071 9.39786L1.13166 10.1331C1.42128 10.4762 1.59718 10.9009 1.63502 11.3483L1.7161 12.3071C1.80513 13.3598 2.64025 14.1949 3.69296 14.2839L4.65169 14.365C5.09913 14.4029 5.52376 14.5788 5.86691 14.8684L6.60215 15.489C7.40949 16.1703 8.59052 16.1703 9.39786 15.489L10.1331 14.8684C10.4762 14.5788 10.9009 14.4029 11.3483 14.365L12.3071 14.2839C13.3598 14.1949 14.1949 13.3598 14.2839 12.3071L14.365 11.3483C14.4029 10.9009 14.5788 10.4762 14.8684 10.1331L15.489 9.39786C16.1703 8.59052 16.1703 7.40949 15.489 6.60215L14.8684 5.8669C14.5788 5.52376 14.4029 5.09913 14.365 4.65169L14.2839 3.69296C14.1949 2.64025 13.3598 1.80513 12.3071 1.7161L11.3483 1.63502C10.9009 1.59718 10.4762 1.42128 10.1331 1.13166L9.39786 0.511071ZM11.9408 6.52246C12.3217 6.1416 12.3217 5.52411 11.9408 5.14326C11.5601 4.7624 10.9425 4.7624 10.5616 5.14326L6.91687 8.78805L5.43928 7.31046C5.05843 6.9296 4.44094 6.9296 4.06008 7.31046C3.67922 7.69131 3.67922 8.3088 4.06008 8.68965L6.22728 10.8568C6.60814 11.2377 7.22562 11.2377 7.60648 10.8568L11.9408 6.52246Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        Email & chat support
                                    </p>
                                    <p class="flex items-center gap-2.5 text-sm">
                                        <span class="text-success">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.39786 0.511071C8.59052 -0.170358 7.40949 -0.170357 6.60215 0.511071L5.8669 1.13166C5.52376 1.42128 5.09913 1.59718 4.65169 1.63502L3.69296 1.7161C2.64025 1.80513 1.80513 2.64025 1.7161 3.69296L1.63502 4.65169C1.59718 5.09913 1.42128 5.52376 1.13166 5.86691L0.511071 6.60215C-0.170358 7.40949 -0.170357 8.59052 0.511071 9.39786L1.13166 10.1331C1.42128 10.4762 1.59718 10.9009 1.63502 11.3483L1.7161 12.3071C1.80513 13.3598 2.64025 14.1949 3.69296 14.2839L4.65169 14.365C5.09913 14.4029 5.52376 14.5788 5.86691 14.8684L6.60215 15.489C7.40949 16.1703 8.59052 16.1703 9.39786 15.489L10.1331 14.8684C10.4762 14.5788 10.9009 14.4029 11.3483 14.365L12.3071 14.2839C13.3598 14.1949 14.1949 13.3598 14.2839 12.3071L14.365 11.3483C14.4029 10.9009 14.5788 10.4762 14.8684 10.1331L15.489 9.39786C16.1703 8.59052 16.1703 7.40949 15.489 6.60215L14.8684 5.8669C14.5788 5.52376 14.4029 5.09913 14.365 4.65169L14.2839 3.69296C14.1949 2.64025 13.3598 1.80513 12.3071 1.7161L11.3483 1.63502C10.9009 1.59718 10.4762 1.42128 10.1331 1.13166L9.39786 0.511071ZM11.9408 6.52246C12.3217 6.1416 12.3217 5.52411 11.9408 5.14326C11.5601 4.7624 10.9425 4.7624 10.5616 5.14326L6.91687 8.78805L5.43928 7.31046C5.05843 6.9296 4.44094 6.9296 4.06008 7.31046C3.67922 7.69131 3.67922 8.3088 4.06008 8.68965L6.22728 10.8568C6.60814 11.2377 7.22562 11.2377 7.60648 10.8568L11.9408 6.52246Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        Professional Reporting
                                    </p>
                                </div>
                                <div class="mt-10">
                                    <a href="javascript:;" class="bg-gray/10 block text-center rounded-full py-5 px-3 uppercase text-xs font-extrabold tracking-[3px] hover:bg-dark hover:text-white duration-300">Get Started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div x-show="activeTab === 'pw'" x-data="{selectedMail: false}" class="flex flex-row items-start gap-4 relative w-full h-[calc(100vh-188px)] sm:h-[calc(100vh-204px)]">
                <div class="w-full flex flex-col flex-1 rounded-lg overflow-y-auto h-[calc(100vh-188px)] sm:h-[calc(100vh-204px)]">
                    <div>
                        <button type="button" class="xl:hidden hover:text-primary duration-300" @click="isShowChatMenu = !isShowChatMenu">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.3" x="3" y="17.2" width="18" height="1.6" rx="0.8" fill="currentColor"></rect>
                                <rect opacity="0.5" x="3" y="11.6" width="18" height="1.6" rx="0.8" fill="currentColor"></rect>
                                <rect x="3" y="6" width="18" height="1.6" rx="0.8" fill="currentColor"></rect>
                            </svg>
                        </button>
                    </div>
                    <div class="bg-white border-2 border-lightgray/10 rounded-lg p-5 space-y-4">
                        <h3 class="text-lg font-semibold">Password</h3>
                        <form class="mt-[30px] grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <input type="password" id="password2" class="form-input rounded-[10px] h-14 placeholder:text-dark" placeholder="New Password" required="">
                            <input type="password" id="password3"class="form-input rounded-[10px] h-14 placeholder:text-dark" placeholder="Confirm Password" required="">
                            <div class="sm:col-span-2 text-end">
                                <input type="submit" class="btn mt-2.5 w-full max-w-[200px] h-14 bg-primary border border-primary rounded-md text-white transition-all duration-300 hover:bg-primary/[0.85] hover:border-primary/[0.85]" value="save">
                            </div>
                        </form>
                    </div>
                    <div class="bg-white border-2 border-lightgray/10 rounded-lg p-5 mt-5">
                        <h3 class="text-lg font-semibold">Security</h3>
                        <p class="text-gray mt-[30px]">Enter the authentication code below we sent to <span class="text-primary font-bold block mt-4">+1 603-756-4530</span></p>
                        <div class="bg-white border-2 border-lightgray/10 rounded-lg mt-[30px]">
                            <div class="flex items-center gap-2 justify-between p-5">
                                <div>
                                    <h5 class="font-semibold">Text Message</h5>
                                    <p class="text-gray mt-2">Use your mobile phone to receive security codes.</p>
                                </div>
                                <div class="togglebutton setting inline-block">
                                    <label for="toggleD7" class="flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" id="toggleD7" class="sr-only" checked>
                                            <div class="block band bg-gray/50 w-7 h-4 rounded-full"></div>
                                            <div class="dot absolute left-1 top-1/2 -translate-y-1/2 right-0 bg-white w-2.5 h-2.5 rounded-full transition"></div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="bg-gray/[0.14] p-5 border-t-2 border-lightgray/5">
                                <div class="flex items-center justify-between flex-wrap gap-y-3">
                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center gap-2.5 text-sm">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 10C20 11.2029 18.2865 12.1106 17.8192 13.2394C17.3692 14.3279 17.9558 16.1865 17.0712 17.0712C16.1865 17.9558 14.3279 17.3692 13.2394 17.8192C12.1154 18.2865 11.2019 20 10 20C8.79808 20 7.88462 18.2865 6.76058 17.8192C5.67212 17.3692 3.81346 17.9558 2.92885 17.0712C2.04423 16.1865 2.63077 14.3279 2.18077 13.2394C1.71346 12.1154 0 11.2019 0 10C0 8.79808 1.71346 7.88462 2.18077 6.76058C2.63077 5.67308 2.04423 3.81346 2.92885 2.92885C3.81346 2.04423 5.67308 2.63077 6.76058 2.18077C7.88942 1.71346 8.79808 0 10 0C11.2019 0 12.1154 1.71346 13.2394 2.18077C14.3279 2.63077 16.1865 2.04423 17.0712 2.92885C17.9558 3.81346 17.3692 5.67212 17.8192 6.76058C18.2865 7.88942 20 8.79808 20 10Z" fill="#00D085" />
                                                <path d="M13.8045 7.1955C13.8665 7.25741 13.9156 7.33093 13.9492 7.41185C13.9827 7.49277 14 7.57952 14 7.66712C14 7.75472 13.9827 7.84146 13.9492 7.92238C13.9156 8.0033 13.8665 8.07682 13.8045 8.13873L9.13835 12.8049C9.07644 12.8669 9.00293 12.916 8.922 12.9496C8.84108 12.9831 8.75434 13.0004 8.66674 13.0004C8.57914 13.0004 8.4924 12.9831 8.41147 12.9496C8.33055 12.916 8.25703 12.8669 8.19513 12.8049L6.19535 10.8051C6.07027 10.68 6 10.5104 6 10.3335C6 10.1566 6.07027 9.98695 6.19535 9.86187C6.32043 9.73679 6.49007 9.66652 6.66696 9.66652C6.84385 9.66652 7.0135 9.73679 7.13858 9.86187L8.66674 11.3909L12.8613 7.1955C12.9232 7.13352 12.9967 7.08436 13.0776 7.05081C13.1585 7.01727 13.2453 7 13.3329 7C13.4205 7 13.5072 7.01727 13.5881 7.05081C13.6691 7.08436 13.7426 7.13352 13.8045 7.1955Z" fill="white" />
                                            </svg>Verified August 10, 2022
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm">
                                        <p>+91 65982 65421</p>
                                        <a href="javascript:;" class="text-primary">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white border-2 border-lightgray/10 rounded-lg p-5 mt-5">
                            <h5 class="font-semibold">Google Authenticator</h5>
                            <p class="text-gray mt-2">Use the google authenticator app to generate one time security codes.</p>
                        </div>
                        <div class="bg-white border-2 border-lightgray/10 rounded-lg p-5 mt-5">
                            <h5 class="font-semibold">Duo Security</h5>
                            <p class="text-gray mt-2">Use the Duo Security app to generate a push notification to your device.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("email", () => ({
                isShowChatMenu: false,
                selectMail: false,
            }));
        });
    </script>

@endsection