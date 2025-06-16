@extends('frontend.index')

@push('style-frontend')
    <style>
        .language-switcher {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 100000;
        }

        /* Toast Notification */
        #langToast {
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            z-index: 100001;
        }

        #langToast.show {
            opacity: 1;
        }
    </style>
    </style>
@endpush

@section('konten-frontend')
    {{-- Language Toggle --}}

    <div id="google_translate_element" style="display:none;"></div>
    {{-- Toast Notification --}}
    <div id="langToast"></div>

    {{-- Deskripsi Modal --}}
    <div class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-[99999] hidden overflow-y-auto"
        id="modalDeskripsi">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div
                class="bg-white dark:border-gray/20 border-2 border-lightgray/10 rounded-lg overflow-hidden my-8 w-full max-w-xl">
                <div
                    class="flex bg-white items-center border-b border-lightgray/10 dark:border-gray/20 justify-between px-5 py-3">
                    <h5 class="font-semibold text-lg text-center" id="titleModal">{{ __('Detail Deskripsi') }}</h5>
                    <button type="button" class="text-lightgray hover:text-primary" onclick="modalDeskripsi()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                            <path
                                d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"
                                fill="currentColor"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-5 space-y-4">
                    @isset($asset)
                        <div class="w-full space-y-4">
                            <h3 class="font-bold mt-5 text-dark capitalize">{{ __('Sejarah Aset') }}</h3>
                            <p class="my-4">{{ $asset['asset']['history'] }}</p>
                            <h3 class="font-bold mt-5 text-dark capitalize">{{ __('Deskripsi Aset') }}</h3>
                            <p class="my-4">{{ $asset['asset']['description'] }}</p>
                            <h3 class="font-bold mt-5 text-dark capitalize">{{ __('Manfaat Aset') }}</h3>
                            <p class="my-4">{{ $asset['asset']['benefit'] }}</p>
                            <h3 class="font-bold mt-5 text-dark capitalize">{{ __('Cerita Rakyat/Fakta Aset') }}</h3>
                            <p class="my-4">{{ $asset['asset']['fact'] }}</p>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>

    {{-- Video Permission Modal --}}
    <div class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-[99999] overflow-y-auto" id="modalKonfirm">
        <div class="flex items-start justify-center min-h-screen px-4">
            <div
                class="bg-white dark:border-gray/20 border-2 border-lightgray/10 rounded-lg overflow-hidden my-8 w-full max-w-xl">
                <div
                    class="flex bg-white items-center border-b border-lightgray/10 dark:border-gray/20 justify-between px-5 py-3">
                    <h5 class="font-semibold text-lg text-center">{{ __('Video Permission') }}</h5>
                    <button type="button" class="text-lightgray hover:text-primary" id="closeModalKonfirm"
                        onclick="playVideo(false)">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                            <path
                                d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"
                                fill="currentColor"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-5 space-y-4">
                    <div class="w-full space-y-2 text-center">
                        <h1 class="font-bold text-dark">{{ __('Konfirmasi Autoplay Video') }}</h1>
                        <p>{{ __('Apakah Anda ingin mengizinkan autoplay video di situs ini?') }}</p>
                    </div>
                    <div class="flex justify-center space-x-4 mt-4 gap-4">
                        <button type="button" class="bg-green-digitree w-1/2 text-white px-4 py-2 rounded"
                            onclick="playVideo(true)">{{ __('Ya, Izinkan') }}</button>
                        <button type="button" class="bg-red-600 w-1/2 text-white px-4 py-2 rounded"
                            onclick="playVideo(false)">{{ __('Tidak, Jangan Izinkan') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @isset($asset)
        {{-- Iklan Atas --}}
        <section id="iklan-atas">
            <div class="w-full">
                @if (isset($asset['ads']['image']) && $asset['ads']['image'])
                    <img src="{{ Storage::url('images/iklan/' . $asset['ads']['image']) }}" class="object-contain w-full h-32"
                        alt="iklan">
                @else
                    <img src="{{ asset('images/tree.png') }}" class="object-contain w-full h-32" alt="iklan default">
                @endif
            </div>
        </section>

        {{-- Gambar Aset --}}
        <section id="treeImage">
            <div class="w-full relative">
                <img src="{{ Storage::url($asset['asset']['image']) }}" class="object-cover w-full h-[450px]"
                    alt="display asset">
                <div class="absolute inset-x-0 bottom-0 flex items-center gap-x-3 px-5 bg-black-gradient pb-4">
                    <img src="{{ asset('assets/img/icon/loc-icon.svg') }}" alt="location icon">
                    <a class="text-white" href="https://www.google.com/maps/place/{{ $asset['asset']['location'] }}"
                        target="_blank">{{ $asset['asset']['address'] }}</a>
                </div>
            </div>
            {{-- Toggle Bahasa di bawah gambar --}}
            <div class="flex justify-center mt-4 space-x-4">
                <button type="button" onclick="changeLanguage('en')"
                    class="px-4 py-2 rounded transition-colors duration-200
                    {{ app()->getLocale() == 'en' ? 'bg-blue-600 text-white' : 'bg-slate-800 dark:bg-black text-white dark:text-white' }}">
                    {{ __('English') }}
                </button>
                <button type="button" onclick="changeLanguage('id')"
                    class="px-4 py-2 rounded transition-colors duration-200
                    {{ app()->getLocale() == 'id' ? 'bg-blue-600 text-white' : 'bg-slate-800 dark:bg-black text-white dark:text-white' }}">
                    {{ __('Bahasa Indonesia') }}
                </button>
            </div>
        </section>
        </section>

        {{-- Flash message --}}
        @if (session('success'))
            <div class="my-4 rounded p-3 bg-green-digitree/10 text-green-digitree border border-green-digitree/60">
                {{ session('success') }}
            </div>
        @endif

        {{-- Konten Utama --}}
        <section>
            <div class="w-full px-5 py-8">
                <h1 class="font-bold text-dark text-2xl">{{ $asset['asset']['nama'] ?? '' }} <span
                        class="text-xl italic">({{ $asset['asset']['nama_lokal'] ?? '' }})</span></h1>
                <p class="text-lg text-green-digitree py-2 capitalize">{{ $asset['asset']['jenis_aset'] ?? '' }}</p>

                <input type="hidden" name="id_asset" id="id_asset" value="{{ $asset['asset']['id'] }}">
                <div class="flex items-center gap-3 my-3">
                    @php $rating = round($asset['avgRating'], 0) ?? 0; @endphp
                    @for ($i = 1; $i <= $rating; $i++)
                        <img src="{{ asset('assets/img/icon/star-fill.svg') }}">
                    @endfor
                    <p class="font-bold text-dark">{{ round($asset['avgRating'], 0) }}/5 <span
                            class="font-normal">({{ __('Ulasan') }})</span></p>
                </div>

                <h3 class="font-bold my-4 text-dark">{{ __('Detail Aset') }}</h3>
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td>Nilai Aset</td>
                            <td>:</td>
                            <td>{{ $asset['asset']['value'] }}</td>
                        </tr>
                        <tr>
                            <td>Jarak dari Pusat Desa</td>
                            <td>:</td>
                            <td>{{ number_format($asset['asset']['age'], 2) }} KM</td>
                        </tr>
                        <tr>
                            <td>Moda Transportasi</td>
                            <td>:</td>
                            <td>{{ $asset['asset']['large'] }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Dibuka</td>
                            <td>:</td>
                            <td>{{ $asset['asset']['date_open'] }}</td>
                        </tr>
                        <tr>
                            <td>Pengelola</td>
                            <td>:</td>
                            <td>{{ $asset['asset']['organizer'] }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="my-4">
                    <h3 class="font-bold mt-5 text-dark">{{ __('Sejarah Aset') }}</h3>
                    <p class="my-4">{{ $asset['asset']['history'] }}</p>
                    <a onclick="modalDeskripsi()" class="text-green-digitree flex items-center gap-3 text-base cursor-pointer">
                        <span class="font-semibold">{{ __('Lihat Selengkapnya') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-green-digitree" viewBox="0 0 24 24">
                            <path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="m6 9l6 6l6-6" />
                        </svg>
                    </a>
                </div>

                <div class="my-4" id="videoContainer">
                    <h3 class="font-bold my-3 text-dark">{{ __('Video') }}</h3>
                    <div id="youtubeContainer"></div>
                </div>

                <div class="my-4">
                    <h3 class="font-bold my-3 text-dark">{{ __('Tulis Ulasan kamu') }}</h3>
                    <div class="flex gap-5">
                        <button
                            class="bg-green-digitree rounded-lg px-5 py-3 text-white font-bold flex items-center gap-2 hover:bg-green-digitree/80"
                            onclick="window.location.href='{{ route('aset.create', 'id=' . request()->segment(count(request()->segments())) . '&nama_asset=' . $asset['asset']['nama'] . '&jenis=' . $asset['asset']['jenis_aset']) }}'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white w-5 h-5" viewBox="0 0 512 512">
                                <path
                                    d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256 c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32 C448,238.3,434.3,224,417.4,224z" />
                            </svg>
                            <span>{{ __('Tambah Ulasan') }}</span>
                        </button>
                        <a href="https://wa.me/6285176887689" target="_blank"
                            class="border-2 border-green-digitree bg-white rounded-lg px-5 py-3 text-green-digitree hover:bg-green-digitree/90 hover:text-white font-bold flex items-center">
                            {{ __('Tanya / Lapor') }}
                        </a>
                    </div>

                    @foreach ($asset['ulasan'] as $ulasan)
                        <div class="ulasan my-5">
                            <span class="text-sm font-medium">{{ $ulasan['name'] }}</span>
                            <div class="flex items-center gap-3 my-2">
                                <div class="flex gap-1">
                                    @php $rating = $ulasan['rating'] ?? 0; @endphp
                                    @for ($i = 1; $i <= $rating; $i++)
                                        <img src="{{ asset('assets/img/icon/star-fill.svg') }}">
                                    @endfor
                                </div>
                                <p class="text-gray-500 text-sm">{{ $ulasan['created_at'] }}</p>
                            </div>
                            <p>{{ $ulasan['comment'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Iklan Bawah --}}
        <section id="iklan-bawah">
            <div class="w-full">
                @if (isset($asset['ads']['image']) && $asset['ads']['image'])
                    <img src="{{ Storage::url('images/iklan/' . $asset['ads']['image']) }}"
                        class="object-contain w-full h-32" alt="iklan">
                @else
                    <img src="{{ asset('images/tree.png') }}" class="object-contain w-full h-32" alt="iklan default">
                @endif
            </div>
        </section>
    @endisset
@endsection

@push('script-frontend')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        let toggleModal = false;
        const modal = document.getElementById("modalDeskripsi");

        function modalDeskripsi() {
            toggleModal = !toggleModal;
            modal.classList.toggle("hidden");
        }

        function playVideo(allowAutoplay) {
            const iframe = document.createElement("iframe");
            const container = document.getElementById("youtubeContainer");
            const konfirm = document.getElementById("modalKonfirm");
            iframe.setAttribute("src",
                `https://www.youtube.com/embed/{{ $asset['asset']['video'] }}?autoplay=1&controls=0&rel=0`);
            iframe.setAttribute("frameborder", "0");
            const allow = allowAutoplay ? "autoplay; encrypted-media; unmute; accelerometer; clipboard-write; gyroscope" :
                "encrypted-media; accelerometer; clipboard-write; gyroscope";
            iframe.setAttribute("allow", allow);
            iframe.classList.add("w-full", "h-72");
            container.appendChild(iframe);
            konfirm.classList.add("hidden");
        }
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(pos => {
                const id = document.getElementById("id_asset").value;
                $.post('/savelocation', {
                    id,
                    latitude: pos.coords.latitude,
                    longitude: pos.coords.longitude,
                    _token: '{{ csrf_token() }}'
                });
            });
        }
    </script>

    <!-- Google Translate widget init -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'en,id',
                autoDisplay: false
            }, 'google_translate_element');
        }

        function showToast(message) {
            const toast = document.getElementById('langToast');
            toast.textContent = message;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2000);
        }

        function changeLanguage(lang) {
            // Initialize Google Translate widget if not already done
            if (!document.querySelector('.goog-te-combo')) {
                googleTranslateElementInit();
            }

            function applyLang() {
                const combo = document.querySelector('.goog-te-combo');
                if (combo) {
                    combo.value = lang;
                    combo.dispatchEvent(new Event('change'));
                    // Show toast notification
                    const msg = lang === 'en' ? 'Language changed to English' : 'Bahasa diubah ke Indonesia';
                    showToast(msg);
                } else {
                    // retry after 500ms if not yet injected
                    setTimeout(applyLang, 500);
                }
            }
            applyLang();
        }
    </script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@endpush
