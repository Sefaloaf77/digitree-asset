@extends('frontend.index')

@push('style-frontend')
@endpush

@section('konten-frontend')
    <div class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-[99999] hidden overflow-y-auto"
        id="modalDeskripsi">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div
                class="bg-white dark:border-gray/20 border-2 border-lightgray/10 rounded-lg overflow-hidden my-8 w-full max-w-xl">
                <div
                    class="flex bg-white items-center border-b border-lightgray/10 dark:border-gray/20 justify-between px-5 py-3">
                    <h5 class="font-semibold text-lg text-center" id="titleModal">Detail Deskripsi</h5>
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
                            <h3 class="font-bold mt-5 text-dark capitalize">Sejarah Aset</h3>
                            <p class="my-4">
                                {{ $asset['asset']['history'] }}
                            </p>
                            <h3 class="font-bold mt-5 text-dark capitalize">Deskripsi Aset</h3>
                            <p class="my-4">
                                {{ $asset['asset']['description'] }}
                            </p>
                            <h3 class="font-bold mt-5 text-dark capitalize">Manfaat Aset</h3>
                            <p class="my-4">
                                {{ $asset['asset']['benefit'] }}
                            </p>
                            <h3 class="font-bold mt-5 text-dark capitalize">Cerita Rakyat/Fakta Aset</h3>
                            <p class="my-4">
                                {{ $asset['asset']['fact'] }}
                            </p>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-[99999] overflow-y-auto" id="modalKonfirm">
        <div class="flex items-start justify-center min-h-screen px-4">
            <div
                class="bg-white dark:border-gray/20 border-2 border-lightgray/10 rounded-lg overflow-hidden my-8 w-full max-w-xl">
                <div
                    class="flex bg-white items-center border-b border-lightgray/10 dark:border-gray/20 justify-between px-5 py-3">
                    <h5 class="font-semibold text-lg text-center">Video Permission</h5>
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
                    <div class="w-full space-y-2">
                        <h1 class="font-bold text-dark text-center">Konfirmasi Autoplay Video</h1>
                        <p class="text-center">Apakah Anda ingin mengizinkan autoplay video di situs ini?</p>
                    </div>
                    <div class="flex justify-center space-x-4 mt-4 gap-4">
                        <button type="button" class="bg-green-digitree w-1/2 text-white px-4 py-2 rounded"
                            onclick="playVideo(true)">Ya, Izinkan</button>
                        <button type="button" class="bg-red-600 w-1/2 text-white px-4 py-2 rounded"
                            onclick="playVideo(false)">Tidak, Jangan Izinkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @isset($asset)
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
        <section id="treeImage">
            <div class="w-full relative">
                <img src="{{ Storage::url($asset['asset']['image']) }}" class="object-cover w-full h-[450px]"
                    alt="display asset">
                <div class="absolute inset-x-0 bottom-0 flex flex-row items-center gap-x-3 px-5 bg-black-gradient pb-4">
                    <div>
                        <img src="{{ asset('assets/img/icon/loc-icon.svg') }}" class="" alt="location icon">
                    </div>
                    <a class="text-white" href="https://www.google.com/maps/place/{{ $asset['asset']['location'] }}"
                        target="_blank">{{ $asset['asset']['address'] }}</a>
                </div>
            </div>
        </section>

        @if (session('success'))
            <div class="my-4 rounded p-3 bg-green-digitree/10 text-green-digitree border border-green-digitree/60">
                {{ session('success') }}
            </div>
        @endif

        <section>
            <div class="w-full px-5 py-8">
                <h1 class="font-bold text-dark text-2xl">{{ $asset['asset']['nama'] ?? '' }}
                    <span class="text-xl italic">({{ $asset['asset']['nama_lokal'] ?? '' }})</span>
                </h1>
                <p class="text-lg text-green-digitree py-2 capitalize">{{ $asset['asset']['jenis_aset'] ?? '' }}</p>

                <input type="hidden" name="id_asset" id="id_asset" value="{{ $asset['asset']['id'] }}">
                <div class="flex flex-row gap-3 my-3">
                    @php
                        $rating = round($asset['avgRating'], 0) ?? 0;
                        // echo $rating;
                    @endphp
                    @for ($i = 1; $i <= $rating; $i++)
                        <img src="{{ asset('assets/img/icon/star-fill.svg') }}">
                    @endfor
                    {{-- <img src="{{ asset('assets/img/icon/star-fill.svg') }}"> --}}
                    <p class="font-bold text-dark">
                        {{ round($asset['avgRating'], 0) }}/5
                        <span class="font-normal"> (Ulasan)</span>
                    </p>
                </div>
                <h3 class="font-bold my-4 text-dark">Detail Aset</h3>
                <table class="">
                    <tbody>

                        <tr class="">
                            <td colspan="3">Nilai Aset</td>
                            <td class="px-10">:</td>
                            <td>{{ $asset['asset']['value'] }}</td>
                        </tr>
                        <tr class="">
                            <td colspan="3">Jarak dari Pusat Desa</td>
                            <td class="px-10">:</td>
                            <td>{{ number_format($asset['asset']['age'], 2) }} KM</td>
                        </tr>
                        <tr class="">
                            <td colspan="3">Moda Tranportasi ke Lokasi</td>
                            <td class="px-10">:</td>
                            <td>{{ $asset['asset']['large'] }}</td>
                        </tr>
                        <tr class="">
                            <td colspan="3">Tanggal Dibuka</td>
                            <td class="px-10">:</td>
                            <td>{{ $asset['asset']['date_open'] }}</td>
                        </tr>
                        <tr class="">
                            <td colspan="3">Pengelola</td>
                            <td class="px-10">:</td>
                            <td>{{ $asset['asset']['organizer'] }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="my-4">

                    <h3 class="font-bold mt-5 text-dark">Sejarah Aset</h3>
                    <p class="my-4">
                        {{ $asset['asset']['history'] }}
                    </p>

                    <a id="modalDeskripsi" onclick="modalDeskripsi()"
                        class="text-green-digitree flex items-center gap-3 text-base mb-8 mt-3 cursor-pointer">
                        <span class="font-semibold">Lihat Selengkapnya</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-green-digitree" viewBox="0 0 24 24">
                            <path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="m6 9l6 6l6-6" />
                        </svg>
                    </a>
                </div>

                <div class="my-4" id="videoContainer">
                    <h3 class="font-bold my-3 text-dark">Video</h3>
                    <div id="youtubeContainer">
                        {{-- <iframe src="https://www.youtube.com/embed/{{ $asset['asset']['video'] }}?autoplay=1"
                            class="w-full h-72" frameborder="0" allow="autoplay; encrypted-media;unmute"
                            id="videoIframe"></iframe> --}}
                    </div>
                    {{-- <div class="max-h-44 h-44 w-full bg-red-600 rounded-xl"></div> --}}
                </div>

                <div class="my-4">
                    <h3 class="font-bold my-3 text-dark">Tulis Ulasan kamu
                        @php
                            $idasset = 'id=' . request()->segment(count(request()->segments()));
                            $nama_asset = '&nama_asset=' . $asset['asset']['nama'];
                            $jenis = '&jenis=' . $asset['asset']['jenis_aset'];
                            $data = $idasset . $nama_asset . $jenis;
                        @endphp
                    </h3>
                    <div class="flex gap-5">
                        <button
                            class="bg-green-digitree rounded-lg px-5 py-3 text-white font-bold flex gap-2 items-center hover:bg-green-digitree/80"
                            onclick="window.location.href='{{ route('aset.create', $data) }}'">
                            <svg id="Layer_1" version="1.1" class="fill-white w-5 h-5" viewBox="0 0 512 512"
                                xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path
                                    d="M417.4,224H288V94.6c0-16.9-14.3-30.6-32-30.6c-17.7,0-32,13.7-32,30.6V224H94.6C77.7,224,64,238.3,64,256  c0,17.7,13.7,32,30.6,32H224v129.4c0,16.9,14.3,30.6,32,30.6c17.7,0,32-13.7,32-30.6V288h129.4c16.9,0,30.6-14.3,30.6-32  C448,238.3,434.3,224,417.4,224z" />
                            </svg>
                            <span>Tambah Ulasan</span>
                        </button>

                        <a href="https://wa.me/6285176887689" target="_blank"
                            class="border-2 border-green-digitree bg-white rounded-lg px-5 py-3 text-green-digitree hover:bg-green-digitree/90 hover:text-white font-bold flex items-center">
                            Tanya / Lapor
                        </a>
                    </div>

                    @foreach ($asset['ulasan'] as $ulasan)
                        <div class="ulasan my-5">
                            <span class="text-sm font-medium">{{ $ulasan['name'] }}</span>
                            <div class="flex flex-row gap-3 my-2 items-center justify-start">
                                <div class="flex flex-row gap-1">
                                    @php
                                        $rating = $ulasan['rating'] ?? 0;
                                        // echo $rating;
                                    @endphp
                                    @for ($i = 1; $i <= $rating; $i++)
                                        <img src="{{ asset('assets/img/icon/star-fill.svg') }}">
                                    @endfor
                                </div>
                                <p class="inline-block text-gray-500">{{ $ulasan['created_at'] }}</span></p>
                            </div>
                            <p>{{ $ulasan['comment'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
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
        var toggleModal = false
        const modal = document.getElementById("modalDeskripsi");

        function modalDeskripsi() {
            toggleModal = !toggleModal
            modal.classList.toggle("hidden");
        }

        function playVideo(params) {
            let iframe = document.createElement("iframe")
            var youtubeContainer = document.getElementById("youtubeContainer")
            var modalKonfirm = document.getElementById("modalKonfirm")

            iframe.setAttribute("src",
                "https://www.youtube.com/embed/{{ $asset['asset']['video'] }}?autoplay=1&controls=0&rel=0")

            iframe.setAttribute("frameborder", "0")
            if (params == true) {
                iframe.setAttribute("allow", "autoplay; encrypted-media;unmute;accelerometer;clipboard-write;gyroscope")

            } else {
                iframe.setAttribute("allow", "encrypted-media;accelerometer;clipboard-write;gyroscope")
            }
            iframe.classList.add("w-full", "h-72")

            youtubeContainer.append(iframe)
            modalKonfirm.classList.add("hidden")
        }


        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    console.log("Location access granted. Latitude: " + position.coords.latitude + ", Longitude: " +
                        position.coords.longitude);

                    var assetId = document.getElementById("id_asset").value
                    console.log('assetId', assetId);


                    // Kirim data ke server menggunakan AJAX
                    $.ajax({
                        url: '/savelocation',
                        method: 'POST',
                        data: {
                            id: assetId,
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                            _token: '{{ csrf_token() }}' // Pastikan untuk menyertakan token CSRF
                        },

                        success: function(response) {
                            console.log('data', response)
                            console.log(response.message);
                        },
                        error: function(xhr) {
                            console.error("Error saving location: " + xhr.responseText);
                        }
                    });
                },
                function(error) {
                    console.error("Location access denied. Error code: " + error.code + " - " + error.message);
                }
            );
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    </script>
@endpush
