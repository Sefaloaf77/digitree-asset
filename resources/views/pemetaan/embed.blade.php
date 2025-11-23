<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Premium Laravel Admin & Dashboard Template" />
    <meta name="author" content="Webonzer" />
    <meta name="base-url" content="{{ url('/') }}">

    <!-- Site Tiltle -->
    <title>Digitree</title>

    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <!-- Style Css -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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
</head>

<body>
    <!-- Start Layout -->
    <div class="bg-white text-dark">
        <!-- Start Main Content -->
        <div class="main-container flex mx-auto">
            <!-- Start Content Area -->
            <div class="flex-1">

                <!-- Start Content -->
                <div class="h-[calc(100vh-60px)]s relative">
                    <div id="map" class="w-full z-10" style="height: 100vh"></div>
                </div>
                <!-- End Content -->
            </div>
            <!-- End Content Area -->
        </div>
    </div>
    <!-- End Layout -->

    <!-- All javascirpt -->
    <script src="{{ asset('assets/js/datatable.js') }}"></script>
    <script src="{{ asset('assets/js/data-search.js') }}"></script>
    <script src="{{ asset('assets/js/alpine-collaspe.min.js') }}"></script>
    <script src="{{ asset('assets/js/alpine-persist.min.js') }}"></script>
    <script src="{{ asset('assets/js/alpine.min.js') }}" defer></script>

    {{-- data table --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.tailwindcss.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom js -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
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
            iconUrl: '/images/loc-icon.png',
            iconSize: [35, 35]
        });

        // Data assets from PHP
        let assets = @json($assets);

        console.log('assets', assets);

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

</body>

</html>
