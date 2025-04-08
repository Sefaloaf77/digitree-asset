@extends('layout.layout')
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">

    <style>
        .form-select-lg {
            font-size: 1.1rem;
            padding: .75rem 1.25rem;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: .375rem;
            padding: .75rem 1.25rem;
            font-size: 1.1rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .form-select {
            border-radius: .375rem;
        }

        .custom-popup {
            max-width: 500px;
            max-height: 40vh;
            height: 40vh;
            width: 100%;
            overflow-y: scroll;
        }
    </style>
@endpush

@section('content')
    <div class="mt-4">
        <div class="panel container absolute top-5 left-5">
            <form method="GET" action="{{ route('dashboard.pemetaan.index') }}"
                class="flex flex-col gap-5 md:flex-row md:gap-4">
                <!-- Search Input -->
                <div class="w-full md:w-80">
                    <input type="search" name="search" id="sc-general" class="w-full" placeholder="Cari Semua Data"
                        value="{{ request('search') }}">
                </div>

                <!-- Location Filter -->
                <div class="w-full md:w-38">
                    <select class="w-full" name="address">
                        <option value=""> Lokasi</option>
                        @foreach ($addresses as $address)
                            <option value="{{ $address }}" {{ request('address') == $address ? 'selected' : '' }}>
                                {{ $address }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Name Filter -->
                <div class="w-full md:w-38">
                    <select class="w-full" name="name">
                        <option value=""> Asset</option>
                        @foreach ($names as $name)
                            <option value="{{ $name }}" {{ request('name') == $name ? 'selected' : '' }}>
                                {{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Species Filter -->
                {{-- <div class="w-full md:w-38">
                    <select class="w-full" name="species">
                        <option value=""> Nama Latin</option>
                        @foreach ($species as $speciesItem)
                            <option value="{{ $speciesItem }}" {{ request('species') == $speciesItem ? 'selected' : '' }}>
                                {{ $speciesItem }}</option>
                        @endforeach
                    </select>
                </div> --}}

                <!-- Code Plants Filter -->
                <div class="w-full md:w-38">
                    <select name="code_asset" class="w-full">
                        <option value=""> Kode Asset</option>
                        @foreach ($codeAssets as $codeAsset)
                            <option value="{{ $codeAsset }}" {{ request('code_asset') == $codeAsset ? 'selected' : '' }}>
                                {{ $codeAsset }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <!-- Submit Button -->
                <div class="flex flex-col md:flex-row md:items-end gap-2">
                    <button type="submit" class="btn bg-green-digitree w-full md:w-auto">Filter</button>
                    <a href="{{ route('dashboard.pemetaan.index') }}" class="btn bg-red-500 w-full md:w-auto">Reset</a>
                </div>
            </form>

        </div>
    </div><br>

    <div class="zoom-panel absolute bottom-8 right-12 z-20">
        <div class="w-fit bg-white border-2 border-green-digitree p-4 text-center rounded-2xl shadow-lg">
            <span class="text-black text-base">Legenda Usia Asset</span>

            <div class="flex flex-col gap-2 mt-4">
                <a href="{{ route('dashboard.pemetaan.index', ['age' => '< 1 tahun']) }}"
                    class="bg-[#DD2A56]/10 py-1 rounded-md cursor-pointer">
                    <span>
                        < 1 tahun </span>
                </a>
                <a href="{{ route('dashboard.pemetaan.index', ['age' => '1-5 tahun']) }}"
                    class="bg-[#F1B40A]/10 py-1 rounded-md cursor-pointer">
                    <span>1-5 tahun</span>
                </a>
                <a href="{{ route('dashboard.pemetaan.index', ['age' => '6-20 tahun']) }}"
                    class="bg-[#00D085]/10 py-1 rounded-md cursor-pointer">
                    <span>6-20 tahun</span>
                </a>
                <a href="{{ route('dashboard.pemetaan.index', ['age' => '21-50 tahun']) }}"
                    class="bg-[#267DFF]/10 py-1 rounded-md cursor-pointer">
                    <span>21-50 tahun</span>
                </a>
                <a href="{{ route('dashboard.pemetaan.index', ['age' => '> 50 tahun']) }}"
                    class="bg-[#7B6AFE]/10 py-1 rounded-md cursor-pointer">
                    <span>> 50 tahun</span>
                </a>
            </div>
        </div>
    </div>

    <div id="map" class="w-full h-[82vh] z-10"></div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable.js') }}"></script>
    <script src="{{ asset('assets/js/data-search.js') }}"></script>
    <script>
        // Set map options
        let mapOptions = {
            center: [-7.31159591116748, 110.21358380807234],
            zoom: 6
        };

        // Create new map instance
        let map = L.map('map', mapOptions);

        // Define tile layers
        let streetLayer = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        let satelliteLayer = L.tileLayer(
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/satellite-v9',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'YOUR_MAPBOX_ACCESS_TOKEN'
            });
        let darkLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            maxZoom: 19
        });
        let lightLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            maxZoom: 19
        });

        // Add layers to map
        streetLayer.addTo(map);

        // Define base layers
        let baseLayers = {
            "Street": streetLayer,
            "Satellite": satelliteLayer,
            "Dark": darkLayer,
            "Light": lightLayer
        };

        // Add layer control
        L.control.layers(baseLayers).addTo(map);

        // Define custom icon for trees
        var treeIcon = L.icon({
            iconUrl: '/images/tree.png',
            iconSize: [35, 35]
        });

        // Data assets from PHP
        let assets = @json($assets);

        console.log(assets);

        // Add markers for each asset location
        assets.forEach(function(asset) {
            let location = asset.location.split(',');
            let lat = parseFloat(location[0]);
            let lng = parseFloat(location[1]);

            // Assuming the image filename is correctly stored in asset.content_asset.image
            let imageTag = asset.content_asset.image ?
                `<img src="/storage/${asset.content_asset.image}" alt="Gambar Asset" style="width: 70%; height:150px; display: block; margin: 0 auto;"><br><br>` :
                '';

            // Assuming the YouTube video ID is stored in asset.content_asset.video
            let videoLink = asset.content_asset.video ?
                `<b>Video Asset:</b> <a href="https://www.youtube.com/watch?v=${asset.content_asset.video}" target="_blank">Tonton Video by Youtube</a><br><br>` :
                '';

            L.marker([lat, lng], {
                    icon: treeIcon
                })
                .bindPopup(`
        <div class="custom-popup" style="max-width: 500px;
            max-height: 40vh;
            height: 40vh;
            width: 100%;
            overflow-y: scroll;">
            <b style="color: #ff0000; font-size: 18px;">Data Asset ID ${asset.code_asset}</b><br><br>
            ${imageTag}
            ${videoLink}
            <b>Nama Asset:</b> ${asset.index_asset.nama}<br>
            <b>Alamat Asset: </b>${asset.address}, ${asset.villages.name}, ${asset.villages.kecamatan}, ${asset.villages.kab_kota} - ${asset.villages.province}<br>
            <b>Umur Asset: </b>${asset.age} Tahun<br>
            <b>Luas Asset: </b>${asset.large} Meter<br>
            <b>Nilai Asset: </b>${asset.value}<br>
            <b>Tanggal Buka: </b>${asset.date_open}<br>
            <b>Pengelola: </b>${asset.organizer}<br>
            <b>Sejarah Asset:</b><br> ${asset.content_asset.history}<br><br>
            <b>Morfologi Asset:</b><br> ${asset.content_asset.morfologi}<br><br>
            <b>Manfaat Asset:</b><br> ${asset.content_asset.benefit}<br><br>
            <b>Fakta Asset:</b><br> ${asset.content_asset.fact}<br>
        </div>
    `)
                .addTo(map);
        });
    </script>
@endsection
