@extends('layout.layout')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.css">
@endpush

@section('content')
    {{-- Tambah Data Modal --}}
    <div x-data="modals">
        <div class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-[99999] hidden overflow-y-auto"
            id="modalTambah">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div
                    class="bg-white dark:bg-dark dark:border-gray/20 border-2 border-lightgray/10 rounded-lg overflow-hidden my-8 w-full max-w-5xl">
                    <div
                        class="flex bg-white dark:bg-dark items-center border-b border-lightgray/10 dark:border-gray/20 justify-between px-5 py-3">
                        <h5 class="font-semibold text-lg text-center" id="titleModal"></h5>
                        <button type="button" class="text-lightgray hover:text-primary" onclick="toggleTambah()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                                <path
                                    d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"
                                    fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="{{ route('dashboard.pohon.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('POST') --}}
                        <div class="p-5 space-y-4">
                            <div class="flex justify-center">
                                <div
                                    class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">

                                    {{-- <div class="text-center">
                                        <svg id="imageNullT" class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="text-center mt-4 flex text-sm leading-6 text-gray-600"
                                            x-data="{ selectedFile: null }">
                                            <label for="file-upload"
                                                class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <span>Select Image</span>
                                                <input id="file-uploadT" name="file-uploadT" type="file" class="sr-only"
                                                    x-on:change="handleFileChangeT(1)" required>
                                            </label>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, JPEG, and WEBP Extensions</p>
                                    </div> --}}
                                    <div class="text-center">
                                        <svg id="imageNullT" class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <img id="previewImgT" :src="previewImgT"
                                            class="mx-auto w-full max-h-48 object-cover hidden">
                                        <div class="text-center mt-4 flex justify-center text-sm leading-6 text-gray-600"
                                            x-data="{ selectedFile: null }">
                                            <label for="file-uploadT"
                                                class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <span>Upload New Image <span class="text-red-700"> *</span></span>
                                                <input id="file-uploadT" name="file-uploadT" type="file" class="sr-only"
                                                    x-on:change="handleFileChangeT" required>
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, JPEG, and WEBP Extensions</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white border-2 border-lightgray/10 p-5 rounded-lg">
                                <div id="tabs">
                                    <ul
                                        class="sm:flex w-full md:overflow-scroll lg:overflow-hidden text-sm text-center border-b border-lightgray/10">
                                        <li class="w-full">
                                            <a href="#" onclick="openTab(event, 'informasi-umum')"
                                                class="tablink flex w-full justify-center items-center gap-2 px-5 py-3 border-b-2">
                                                Informasi Umum
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a href="#" onclick="openTab(event, 'video')"
                                                class="tablink flex w-full justify-center items-center gap-2 px-5 py-3 border-b-2">
                                                Video
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div id="informasi-umum" class="tabcontent p-5">
                                    <div class="overflow-auto">
                                        <table class="w-full max-w-5xl">
                                            <tbody>
                                                <tr>
                                                    <td>Nama Umum<span class="text-red-700"> *</span></td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="text" placeholder="Masukkan nama umum pohon"
                                                            name="name_pohon" id="nama_pohonT" required
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Taksonomi</td>
                                                    <td>:</td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>Kingdom<span class="text-red-700"> *</span></td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text"
                                                                        placeholder="Masukkan nama Kingdom" name="kingdom"
                                                                        id="kingdomT" required
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Divisi<span class="text-red-700"> *</span></td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text" placeholder="Masukkan nama Divisi"
                                                                        name="divisi" id="divisiT" required
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kelas<span class="text-red-700"> *</span></td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text" placeholder="Masukkan nama Kelas"
                                                                        name="kelas" id="kelasT" required
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ordo<span class="text-red-700"> *</span></td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text" placeholder="Masukkan nama Ordo"
                                                                        name="ordo" id="ordoT" required
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Famili<span class="text-red-700"> *</span></td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text" placeholder="Masukkan nama Famili"
                                                                        name="famili" id="familiT" required
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Genus<span class="text-red-700"> *</span></td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text" placeholder="Masukkan nama Genus"
                                                                        name="genus" id="genusT" required
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Spesies<span class="text-red-700"> *</span></td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text"
                                                                        placeholder="Masukkan nama Spesies" name="spesies"
                                                                        id="spesiesT" required
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>

                                                </tr>
                                                <tr class="align-top">
                                                    <td>Sejarah<span class="text-red-700"> *</span></td>
                                                    <td>:</td>
                                                    <td>
                                                        <textarea name="history" placeholder="Masukkan penjelasan sejarah dan keterangan pohon" id="historyT" required
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" rows="10"></textarea>
                                                    </td>
                                                </tr>
                                                <tr class="align-top">
                                                    <td>Morfologi<span class="text-red-700"> *</span></td>
                                                    <td>:</td>
                                                    <td>
                                                        <textarea name="morfologi" placeholder="Masukkan penjelasan morfologi pohon" id="morfologiT" required
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" rows="10"></textarea>
                                                    </td>
                                                </tr>
                                                <tr class="align-top">
                                                    <td>Manfaat<span class="text-red-700"> *</span></td>
                                                    <td>:</td>
                                                    <td>
                                                        <textarea name="benefit" placeholder="Masukkan penjelasan manfaat pohon" id="manfaatT" required
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" rows="10"></textarea>
                                                    </td>
                                                </tr>
                                                <tr class="align-top">
                                                    <td>Fakta Unik<span class="text-red-700"> *</span></td>
                                                    <td>:</td>
                                                    <td>
                                                        <textarea name="fact" placeholder="Masukkan penjelasan fakta pohon" id="faktaT" required
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" rows="10"></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="video" class="tabcontent p-5 hidden">
                                    <div class="overflow-auto">
                                        <table class="w-full max-w-5xl">
                                            <tbody>
                                                <tr>
                                                    <td> Link youtube<span class="text-red-700"> *</span></td>
                                                    <td>:</td>
                                                    <td>

                                                        <input type="text" placeholder="Masukkan link video youtube"
                                                            name="link_youtube" id="link_youtubeT" required
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                        <br>
                                                        <span class="text-red-600">
                                                            Contoh : https://www.youtube.com/watch?v=AAAAbbbbcCCCC
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center items-center gap-4">
                                <button type="submit"
                                    class="btn grow border border-transparent rounded-md text-white flex justify-center gap-3 bg-green-digitree">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                        <path fill="white"
                                            d="M21 7v12q0 .825-.587 1.413T19 21H5q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h12zm-9 11q1.25 0 2.125-.875T15 15t-.875-2.125T12 12t-2.125.875T9 15t.875 2.125T12 18m-6-8h9V6H6z" />
                                    </svg>
                                    <span>Simpan</span>
                                </button>
                                <button type="button"
                                    class="btn grow border border-transparent rounded-md text-dark bg-[#F2F3F6]"
                                    onclick="toggleTambah()">Tutup
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Tambah Data Modal --}}

    {{-- Lihat Detail Data Modal --}}
    <div x-data="modals">
        <div class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-[99999] hidden overflow-y-auto"
            id="modalDetail">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div
                    class="bg-white dark:bg-dark dark:border-gray/20 border-2 border-lightgray/10 rounded-lg overflow-hidden my-8 w-full max-w-5xl">
                    <div
                        class="flex bg-white dark:bg-dark items-center border-b border-lightgray/10 dark:border-gray/20 justify-between px-5 py-3">
                        <h5 class="font-semibold text-lg text-center" id="titleModalDetail"></h5>
                        <button type="button" class="text-lightgray hover:text-primary" onclick="toggleDetail()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                                <path
                                    d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"
                                    fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('POST') --}}
                        <div class="p-5 space-y-4">
                            <div class="flex justify-center">
                                <div
                                    class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                    <div class="text-center">
                                        {{-- <svg id="imageNullD" class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                clip-rule="evenodd" />
                                        </svg> --}}
                                        <img id="previewImgD" :src="previewImgD"
                                            class="mx-auto w-full max-h-48 object-cover">
                                        <div class="text-center mt-4 flex justify-center text-sm leading-6 text-gray-600"
                                            x-data="{ selectedFile: null }">
                                            <label for="file-uploadD"
                                                class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <span>Preview Image</span>
                                                <input id="file-uploadD" name="file-uploadD" type="file"
                                                    class="sr-only" x-on:change="handleFileChangeD" disabled>
                                            </label>
                                            {{-- <p class="pl-1">or drag and drop</p> --}}
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, JPEG, and WEBP Extensions</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white border-2 border-lightgray/10 p-5 rounded-lg">
                                <div id="tabs">
                                    <ul
                                        class="sm:flex w-full md:overflow-scroll lg:overflow-hidden text-sm text-center border-b border-lightgray/10">
                                        <li class="w-full">
                                            <a href="#" onclick="openTabD(event, 'informasi-umum-detail')"
                                                class="tablinkD flex w-full justify-center items-center gap-2 px-5 py-3 border-b-2">
                                                Informasi Umum
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a href="#" onclick="openTabD(event, 'video-detail')"
                                                class="tablinkD flex w-full justify-center items-center gap-2 px-5 py-3 border-b-2">
                                                Video
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div id="informasi-umum-detail" class="tabcontentD p-5">
                                    <div class="overflow-auto">
                                        <table class="w-full max-w-5xl">
                                            <tbody>
                                                <tr>
                                                    <td>Nama Umum<span class="text-red-700"> *</span></td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="text" placeholder="Masukkan nama umum pohon"
                                                            name="name_pohon" id="nama_pohonD" disabled
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Taksonomi</td>
                                                    <td>:</td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>Kingdom</td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text"
                                                                        placeholder="Masukkan nama Kingdom" name="kingdom"
                                                                        id="kingdomD" disabled
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Divisi</td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text"
                                                                        placeholder="Masukkan nama Divisi" name="divisi"
                                                                        id="divisiD" disabled
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kelas</td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text"
                                                                        placeholder="Masukkan nama Kelas" name="kelas"
                                                                        id="kelasD" disabled
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ordo</td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text" placeholder="Masukkan nama Ordo"
                                                                        name="ordo" id="ordoD" disabled
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Famili</td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text"
                                                                        placeholder="Masukkan nama Famili" name="famili"
                                                                        id="familiD" disabled
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Genus<span class="text-red-700"> *</span></td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text"
                                                                        placeholder="Masukkan nama Genus" name="genus"
                                                                        id="genusD" disabled
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Spesies<span class="text-red-700"> *</span></td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text"
                                                                        placeholder="Masukkan nama Spesies" name="spesies"
                                                                        id="spesiesD" disabled
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>

                                                </tr>
                                                <tr class="align-top">
                                                    <td>Sejarah<span class="text-red-700"> *</span></td>
                                                    <td>:</td>
                                                    <td>
                                                        <textarea name="history" placeholder="Masukkan penjelasan sejarah dan keterangan pohon" id="historyD" disabled
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" rows="10"></textarea>
                                                    </td>
                                                </tr>
                                                <tr class="align-top">
                                                    <td>Morfologi</td>
                                                    <td>:</td>
                                                    <td>
                                                        <textarea name="morfologi" placeholder="Masukkan penjelasan morfologi pohon" id="morfologiD" disabled
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" rows="10"></textarea>
                                                    </td>
                                                </tr>
                                                <tr class="align-top">
                                                    <td>Manfaat</td>
                                                    <td>:</td>
                                                    <td>
                                                        <textarea name="benefit" placeholder="Masukkan penjelasan manfaat pohon" id="manfaatD" disabled
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" rows="10"></textarea>
                                                    </td>
                                                </tr>
                                                <tr class="align-top">
                                                    <td>Fakta Unik</td>
                                                    <td>:</td>
                                                    <td>
                                                        <textarea name="fact" placeholder="Masukkan penjelasan fakta pohon" id="faktaD" disabled
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" rows="10"></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="video-detail" class="tabcontentD p-5 hidden">
                                    <div class="overflow-auto">
                                        <table class="w-full max-w-5xl">
                                            <tbody>
                                                <tr>
                                                    <td> Link youtube</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="text" placeholder="Masukkan link video youtube"
                                                            name="link_youtube" id="link_youtubeD" disabled
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center items-center gap-4">
                                <button type="button"
                                    class="btn grow border border-transparent rounded-md text-dark bg-[#F2F3F6]"
                                    onclick="toggleDetail()">Tutup
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Lihat Detail Data Modal --}}

    {{-- Edit Data Modal --}}
    <div x-data="modals">
        <div class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-[99999] hidden overflow-y-auto"
            id="modalEdit">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div
                    class="bg-white dark:bg-dark dark:border-gray/20 border-2 border-lightgray/10 rounded-lg overflow-hidden my-8 w-full max-w-5xl">
                    <div
                        class="flex bg-white dark:bg-dark items-center border-b border-lightgray/10 dark:border-gray/20 justify-between px-5 py-3">
                        <h5 class="font-semibold text-lg text-center" id="titleModal"></h5>
                        <button type="button" class="text-lightgray hover:text-primary" onclick="toggleEdit()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                                <path
                                    d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"
                                    fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="{{ route('updateAllDataIndexContent') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('PUT'); --}}
                        <div class="p-5 space-y-4">
                            <div class="flex justify-center">
                                <div
                                    class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                    <div class="text-center">
                                        <p class="pl-1">Preview Image New</p>
                                        {{-- <svg id="imageNullE" class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                clip-rule="evenodd" />
                                        </svg> --}}
                                        <br>
                                        <img id="previewImgE" class="mx-auto w-full max-h-48 object-cover">
                                        <div class="text-center mt-4 flex justify-center text-sm leading-6 text-gray-600"
                                            x-data="{ selectedFile: null }">
                                            <label for="file-uploadE"
                                                class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <span>Preview Image</span>
                                                <input id="file-uploadE" name="file-uploadE" type="file"
                                                    class="sr-only" x-on:change="handleFileChangeE">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, JPEG, and WEBP Extensions</p>
                                    </div>
                                </div>

                                {{-- <img src="{{ asset('assets/img/frontend/image-tree.png') }}"
                            class="object-scale-down w-60 h-60 rounded-lg" alt="image pohon"> --}}
                            </div>
                            <div class="bg-white border-2 border-lightgray/10 p-5 rounded-lg">
                                <div id="tabs">
                                    <ul
                                        class="sm:flex w-full md:overflow-scroll lg:overflow-hidden text-sm text-center border-b border-lightgray/10">
                                        <li class="w-full">
                                            <a href="#" onclick="openTabE(event, 'informasi-umum-edit')"
                                                class="tablinkE flex w-full justify-center items-center gap-2 px-5 py-3 border-b-2">
                                                Informasi Umum
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a href="#" onclick="openTabE(event, 'video-edit')"
                                                class="tablinkE flex w-full justify-center items-center gap-2 px-5 py-3 border-b-2">
                                                Video
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div id="informasi-umum-edit" class="tabcontentE p-5">
                                    <div class="overflow-auto">
                                        <table class="w-full max-w-5xl">
                                            <tbody>
                                                <input type="hidden" name="id_index" id="id_index" />
                                                <tr>
                                                    <td>Nama Umum<span class="text-red-700"> *</span></td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="text" placeholder="Masukkan nama umum pohon"
                                                            name="name_pohon" id="nama_pohonE" required
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Taksonomi</td>
                                                    <td>:</td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>Kingdom</td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text"
                                                                        placeholder="Masukkan nama Kingdom" name="kingdom"
                                                                        id="kingdomE"
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Divisi</td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text"
                                                                        placeholder="Masukkan nama Divisi" name="divisi"
                                                                        id="divisiE"
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kelas</td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text"
                                                                        placeholder="Masukkan nama Kelas" name="kelas"
                                                                        id="kelasE"
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ordo</td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text" placeholder="Masukkan nama Ordo"
                                                                        name="ordo" id="ordoE"
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Famili</td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text"
                                                                        placeholder="Masukkan nama Famili" name="famili"
                                                                        id="familiE"
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Genus<span class="text-red-700"> *</span></td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text"
                                                                        placeholder="Masukkan nama Genus" name="genus"
                                                                        id="genusE" required
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Spesies<span class="text-red-700"> *</span></td>
                                                                {{-- <td></td> --}}
                                                                <td>
                                                                    <input type="text"
                                                                        placeholder="Masukkan nama Spesies" name="spesies"
                                                                        id="spesiesE" required
                                                                        class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>

                                                </tr>
                                                <tr class="align-top">
                                                    <td>Sejarah<span class="text-red-700"> *</span></td>
                                                    <td>:</td>
                                                    <td>
                                                        <textarea name="history" placeholder="Masukkan penjelasan sejarah dan keterangan pohon" id="historyE" required
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" rows="10"></textarea>
                                                    </td>
                                                </tr>
                                                <tr class="align-top">
                                                    <td>Morfologi</td>
                                                    <td>:</td>
                                                    <td>
                                                        <textarea name="morfologi" placeholder="Masukkan penjelasan morfologi pohon" id="morfologiE"
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" rows="10"></textarea>
                                                    </td>
                                                </tr>
                                                <tr class="align-top">
                                                    <td>Manfaat</td>
                                                    <td>:</td>
                                                    <td>
                                                        <textarea name="benefit" placeholder="Masukkan penjelasan manfaat pohon" id="manfaatE"
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" rows="10"></textarea>
                                                    </td>
                                                </tr>
                                                <tr class="align-top">
                                                    <td>Fakta Unik</td>
                                                    <td>:</td>
                                                    <td>
                                                        <textarea name="fact" placeholder="Masukkan penjelasan fakta pohon" id="faktaE"
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]" rows="10"></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="video-edit" class="tabcontentE p-5 hidden">
                                    <div class="overflow-auto">
                                        <table class="w-full max-w-5xl">
                                            <tbody>
                                                <tr>
                                                    <td> Link youtube</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="text" placeholder="Masukkan link video youtube"
                                                            name="link_youtube" id="link_youtubeE"
                                                            class="w-full rounded-lg p-2 text-gray-800 bg-[#F2F3F6]">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center items-center gap-4">
                                <button type="submit"
                                    class="btn grow border border-transparent rounded-md text-white flex justify-center gap-3 bg-green-digitree">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                        <path fill="white"
                                            d="M21 7v12q0 .825-.587 1.413T19 21H5q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h12zm-9 11q1.25 0 2.125-.875T15 15t-.875-2.125T12 12t-2.125.875T9 15t.875 2.125T12 18m-6-8h9V6H6z" />
                                    </svg>
                                    <span>Simpan</span>
                                </button>
                                <button type="button"
                                    class="btn grow border border-transparent rounded-md text-dark bg-[#F2F3F6]"
                                    onclick="toggleEdit()">Tutup
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit Data Modal --}}

    {{-- Modal Delete --}}
    <div x-data="modals">
        <div class="fixed inset-0 bg-dark/90 dark:bg-white/5 backdrop-blur-sm z-[99999] hidden overflow-y-auto"
            id="modalDelete">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div
                    class="bg-white dark:bg-dark dark:border-gray/20 border-2 border-lightgray/10 rounded-lg overflow-hidden my-8 w-full max-w-xl">
                    <div
                        class="flex bg-white dark:bg-dark items-center border-b border-lightgray/10 dark:border-gray/20 justify-end px-5 py-3">
                        {{-- <h5 class="font-semibold text-lg text-center" id="titleModal"></h5> --}}
                        <button type="button" class="text-lightgray hover:text-primary" onclick="toggleDelete()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                                <path
                                    d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"
                                    fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-5 space-y-4">
                        <form action="{{ route('deleteAllDataIndexContent') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="w-full space-y-4">
                                <h5 class="font-bold text-lg text-center">Apakah Anda Yakin?</h5>
                                <p class="text-center">Apakah Anda yakin ingin menghapus konten data Pohon "<strong><span
                                            id="name_del_pohon"></span></strong>"
                                    ?
                                </p>
                                <input type="hidden" name="id_konten_delete" id="id_del">
                                {{-- <input type="hidden" name="" id=""> --}}
                            </div>
                            <div class="flex justify-center items-center gap-4 mt-6">
                                <button type="submit"
                                    class="btn grow border border-transparent rounded-md text-white flex justify-center items-center gap-3 bg-[#DD2A56]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                        <path fill="white"
                                            d="M9.808 17h1V8h-1zm3.384 0h1V8h-1zM6 20V6H5V5h4v-.77h6V5h4v1h-1v14z" />
                                    </svg>
                                    <span>Ya, Hapus</span>
                                </button>
                                <button type="button"
                                    class="btn grow border border-transparent rounded-md text-dark bg-[#F2F3F6]"
                                    onclick="toggleDelete()">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Delete --}}

    {{-- DataTable List --}}
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
                    <li>Database Pohon</li>
                </ul>
            </div>
        </div>
        <div class="flex items-start justify-start">
            <button type="button"
                class="transition-all duration-300 py-3 px-5 rounded-lg bg-green-digitree text-white inline-block max-w-fit cursor-pointer"
                onclick="toggleTambah('Tambah')">
                <div class="flex items-center gap-2">
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.6562 6.875C12.6562 7.40234 12.2168 7.8418 11.7188 7.8418H7.5V12.0605C7.5 12.5586 7.06055 12.9688 6.5625 12.9688C6.03516 12.9688 5.625 12.5586 5.625 12.0605V7.8418H1.40625C0.878906 7.8418 0.46875 7.40234 0.46875 6.875C0.46875 6.37695 0.878906 5.9668 1.40625 5.9668H5.625V1.74805C5.625 1.2207 6.03516 0.78125 6.5625 0.78125C7.06055 0.78125 7.5 1.2207 7.5 1.74805V5.9668H11.7188C12.2168 5.9375 12.6562 6.37695 12.6562 6.875Z"
                            fill="white" />
                    </svg>
                    <span>Tambah Database Pohon</span>
                </div>
            </button>
        </div>


        @if (session('error'))
            <div class="my-4 rounded p-3 bg-red-500/10 text-red-500 border border-red-500/60">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class=" rounded p-3 bg-red-500/10 text-red-500 border border-red-500/60 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="my-4 rounded p-3 bg-green-digitree/10 text-green-digitree border border-green-digitree/60">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 gap-5">
            <div class="bg-white border-2 border-lightgray/10 p-5 rounded-lg">
                <div class="overflow-auto space-y-4" x-data="dataTable()" x-init="initData()
                $watch('searchInput', value => {
                    search(value)
                })">
                    <div class="flex justify-between items-center gap-3">
                        <div class="flex space-x-2 items-center">
                            <p>Tampilkan</p>
                            <select id="filter" class="form-select !w-20" x-model="view" @change="changeView()">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div>
                            <input id="search" x-model="searchInput" type="text" class="form-input"
                                placeholder="Search...">
                        </div>
                    </div>
                    <div class="overflow-auto">
                        <table class="min-w-[640px] w-full display" id="table">
                            <thead>
                                <th width="3%" class="dark:bg-white bg-white text-dark dark:text-dark">
                                    <div class="flex items-center justify-between gap-2">
                                        <p>No</p>
                                        <div class="flex flex-col">
                                            <svg @click="sort('name', 'asc')" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'name' && sorted
                                                        .rule === 'asc'
                                                }">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg @click="sort('name', 'desc')" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                class="h-3 w-3 cursor-pointer text-muted fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'name' && sorted
                                                        .rule === 'desc'
                                                }">
                                                <path d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="">Nama Pohon</p>
                                        <div class="flex flex-col">
                                            <svg @click="sort('job', 'asc')" fill="none" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                viewBox="0 0 24 24" stroke="currentColor"
                                                class="text-muted h-3 w-3 cursor-pointer fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'job' && sorted
                                                        .rule === 'asc'
                                                }">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg @click="sort('job', 'desc')" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                class="text-muted h-3 w-3 cursor-pointer fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'job' && sorted
                                                        .rule === 'desc'
                                                }">
                                                <path d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <span>
                                            Nama Latin
                                        </span>
                                        <div class="flex flex-col">
                                            <svg @click="sort('year', 'asc')" fill="none" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                viewBox="0 0 24 24" stroke="currentColor"
                                                class="text-muted h-3 w-3 cursor-pointer fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'year' && sorted
                                                        .rule === 'asc'
                                                }">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg @click="sort('year', 'desc')" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                class="text-muted h-3 w-3 cursor-pointer fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'year' && sorted
                                                        .rule === 'desc'
                                                }">
                                                <path d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th>
                                {{-- <th width="10%">
                                    <div class="flex items-center justify-between gap-2">
                                        <span>
                                            Penjelasan
                                        </span>
                                        <div class="flex flex-col">
                                            <svg @click="sort('year', 'asc')" fill="none" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                viewBox="0 0 24 24" stroke="currentColor"
                                                class="text-muted h-3 w-3 cursor-pointer fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'year' && sorted
                                                        .rule === 'asc'
                                                }">
                                                <path d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <svg @click="sort('year', 'desc')" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                class="text-muted h-3 w-3 cursor-pointer fill-current"
                                                x-bind:class="{
                                                    '!text-black': sorted.field === 'year' && sorted
                                                        .rule === 'desc'
                                                }">
                                                <path d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </th> --}}
                                <th width="15%">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="">
                                            Aksi
                                        </span>
                                    </div>
                                </th>
                            </thead>
                            <tbody>
                                <template x-for="(item, index) in items" :key="index">
                                    <tr x-show="checkView(index + 1)" class="">
                                        <td>
                                            <span x-text="item.no"></span>
                                        </td>
                                        <td>
                                            <span x-text="item.name"></span>
                                        </td>
                                        <td>
                                            <span x-text="item.latin_name"></span>
                                        </td>
                                        <td>
                                            <div class="flex gap-2">

                                                <a x-on:click="toggleDetail('Lihat Detail', {{ 'item.id' }})"
                                                    class="py-2 px-3 text-white bg-green-digitree rounded-lg cursor-pointer">Lihat
                                                    Detail
                                                </a>
                                                <a x-on:click="toggleEdit('Edit', {{ 'item.id' }})"
                                                    class="py-2 px-3 text-white bg-blue-btn rounded-lg cursor-pointer">Edit
                                                </a>

                                                {{-- <a x-on:click="toggleDelete({{ 'item.name' }}, {{ 'item.id' }})"
                                                    class="py-2 px-3 text-white bg-red-btn rounded-lg cursor-pointer">Hapus
                                                </a> --}}

                                            </div>
                                        </td>
                                    </tr>
                                </template>
                                <tr x-show="isEmpty()">
                                    <td colspan="5" class="text-center py-3 text-black">No matching records found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <ul class="inline-flex items-center gap-1">
                        <li><button type="button" @click.prevent="changePage(1)"
                                class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">First</button>
                        </li>
                        <li><button type="button" @click="changePage(currentPage - 1)"
                                class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Prev</button>
                        </li>
                        <template x-for="item in pages">
                            <li><button @click="changePage(item)" type="button"
                                    class="flex justify-center h-9 w-9 items-center rounded transition border border-gray/20 hover:border-gray/60"
                                    x-bind:class="{ 'border-primary text-primary': currentPage === item }"><span
                                        x-text="item"></span></button></li>
                        </template>
                        <li><button @click="changePage(currentPage + 1)" type="button"
                                class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Next</button>
                        </li>
                        <li><button @click.prevent="changePage(pagination.lastPage)" type="button"
                                class="flex justify-center px-2 h-9 items-center rounded transition border border-gray/20 hover:border-gray/60">Last</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- DataTable List --}}
@endsection

@section('script')
    <!-- Datatables Js -->
    {{-- <script>
        // $('#table').DataTable({
        //     dom: 'Bfrtip',
        //     });
        let table = new DataTable('#table');
    </script> --}}
    <script src="{{ asset('assets/js/datatable.js') }}"></script>
    <script src="{{ asset('assets/js/data-search.js') }}"></script>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;

            // Hide all tabcontent
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.add("hidden");
            }

            // Remove active class from all tablinks
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("bg-[#E6F7EF]", "text-green-digitree", "rounded-t-lg");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabName).classList.remove("hidden");
            evt.currentTarget.classList.add("bg-[#E6F7EF]", "text-green-digitree", "rounded-t-lg");
        }

        function openTabD(evt, tabName) {
            var i, tabcontent, tablinks;

            // Hide all tabcontent
            tabcontent = document.getElementsByClassName("tabcontentD");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.add("hidden");
            }

            // Remove active class from all tablinks
            tablinks = document.getElementsByClassName("tablinkD");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("bg-[#E6F7EF]", "text-green-digitree", "rounded-t-lg");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabName).classList.remove("hidden");
            evt.currentTarget.classList.add("bg-[#E6F7EF]", "text-green-digitree", "rounded-t-lg");
        }

        function openTabE(evt, tabName) {
            var i, tabcontent, tablinks;

            // Hide all tabcontent
            tabcontent = document.getElementsByClassName("tabcontentE");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.add("hidden");
            }

            // Remove active class from all tablinks
            tablinks = document.getElementsByClassName("tablinkE");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("bg-[#E6F7EF]", "text-green-digitree", "rounded-t-lg");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabName).classList.remove("hidden");
            evt.currentTarget.classList.add("bg-[#E6F7EF]", "text-green-digitree", "rounded-t-lg");
        }

        // Set the default open tab
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".tablink")[0].click();
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".tablinkD")[0].click();
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".tablinkE")[0].click();
        });

        var toggleModalTambah = false
        var toggleModalDetail = false
        var toggleModalEdit = false
        var toggleModalDelete = false

        const modalTambah = document.getElementById("modalTambah");
        const modalDetail = document.getElementById("modalDetail");
        const modalEdit = document.getElementById("modalEdit");
        const modalDelete = document.getElementById("modalDelete");

        const titleModal = document.getElementById("titleModal")
        const titleModalDetail = document.getElementById("titleModalDetail")
        const titleModalEdit = document.getElementById("titleModalEdit")
        const titleModalDelete = document.getElementById("titleModalDelete")

        function toggleTambah(params) {
            toggleModalTambah = !toggleModalTambah
            if (params) {
                titleModal.textContent = params + " Pohon"
            }
            modalTambah.classList.toggle("hidden");
        }

        function toggleDetail(params, id) {
            toggleModalDetail = !toggleModalDetail
            if (params) {
                titleModalDetail.textContent = params + " Pohon"
            }

            //Taksonomi
            let nama_pohon = document.getElementById("nama_pohonD");
            let genus = document.getElementById("genusD");
            let spesies = document.getElementById("spesiesD");
            let kingdom = document.getElementById("kingdomD");
            let divisi = document.getElementById("divisiD");
            let kelas = document.getElementById("kelasD");
            let famili = document.getElementById("familiD");
            let ordo = document.getElementById("ordoD");

            //Content
            let history = document.getElementById("historyD");
            let morfologi = document.getElementById("morfologiD");
            let benefit = document.getElementById("manfaatD");
            let fact = document.getElementById("faktaD");
            let previewImg = document.getElementById('previewImgD');
            let link = document.getElementById("link_youtubeD")

            fetch("/get-content/" + id) // Replace with your actual data URL
                .then((response) => response.json())
                .then((data) => {
                    // console.log(data);
                    nama_pohon.value = data.name || '-';
                    genus.value = data.genus || '-';
                    spesies.value = data.spesies || '-';
                    kingdom.value = data.kingdom || '-';
                    divisi.value = data.divisi || '-';
                    kelas.value = data.kelas || '-';
                    ordo.value = data.ordo || '-';
                    famili.value = data.famili || '-';
                    history.value = data.history || '-';
                    morfologi.value = data.morfologi || '-';
                    benefit.value = data.benefit || '-';
                    fact.value = data.fact || '-';
                    link.value = data.videos || '-';
                    // previewImg.src = data.image|| '-';
                    previewImg.src = data.image ? `/storage/${data.image}` : '-';
                    // console.log(previewImg.src);
                })
                .catch((error) => {

                    console.error("Error fetching data:", error); // Handle error appropriately
                    // alert('Error Data');
                    // Refresh the page if all retries failed
                    // window.location.reload();
                });

            modalDetail.classList.toggle("hidden");
        }

        function toggleEdit(params, idE) {

            toggleModalEdit = !toggleModalEdit
            if (params) {
                titleModal.textContent = params + " Pohon"
            }

            //Taksonomi
            let id_index = document.getElementById("id_index");
            let nama_pohon = document.getElementById("nama_pohonE");
            let genus = document.getElementById("genusE");
            let spesies = document.getElementById("spesiesE");
            let kingdom = document.getElementById("kingdomE");
            let divisi = document.getElementById("divisiE");
            let kelas = document.getElementById("kelasE");
            let famili = document.getElementById("familiE");
            let ordo = document.getElementById("ordoE");

            //Content
            let history = document.getElementById("historyE");
            let morfologi = document.getElementById("morfologiE");
            let benefit = document.getElementById("manfaatE");
            let fact = document.getElementById("faktaE");
            let previewImg = document.getElementById('previewImgE');
            let link = document.getElementById("link_youtubeE")

            fetch("/get-content/" + idE) // Replace with your actual data URL
                .then((response) => response.json())
                .then((data) => {
                    // console.log(data);
                    id_index.value = idE;
                    nama_pohon.value = data.name;
                    genus.value = data.genus;
                    spesies.value = data.spesies;
                    kingdom.value = data.kingdom;
                    divisi.value = data.divisi;
                    kelas.value = data.kelas;
                    ordo.value = data.ordo;
                    famili.value = data.famili;
                    history.value = data.history;
                    morfologi.value = data.morfologi;
                    benefit.value = data.benefit;
                    fact.value = data.fact;
                    link.value = data.videos;
                    previewImgE.src = data.image ? `/storage/${data.image}` : '-';
                    console.log(previewImg.src);
                })
                .catch((error) => {
                    console.error("Error fetching data:", error); // Handle error appropriately
                    // Refresh the page if all retries failed
                    // window.location.reload();
                });
            modalEdit.classList.toggle("hidden");

        }

        function toggleDelete(name, id) {
            toggleModalDelete = !toggleModalDelete
            let nama_pohon = document.getElementById("name_del_pohon");
            let id_del = document.getElementById("id_del");

            id_del.value = id;
            nama_pohon.textContent = name;
            modalDelete.classList.toggle("hidden");
        }
        
        // // Live Preview Selected Image
        function handleFileChangeT(event) {
            // const fileInput = document.getElementById('file-uploadT');
            console.log(event);
            const previewImg = document.getElementById('previewImgT');
            if (event.target.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const imageNull = document.getElementById('imageNullT')
                    if (previewImg) { // Check if element exists
                        imageNull.classList.add('hidden')
                        previewImg.classList.remove('hidden')
                        previewImg.classList.add('block')
                        previewImg.src = e.target.result;
                    }
                };
                reader.readAsDataURL(event.target.files[0]);
            }

        }

        function handleFileChangeD(event) {
            console.log(event);
            const previewImg = document.getElementById('previewImgD');
            if (event.target.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const imageNull = document.getElementById('imageNullD')
                    // console.log(previewImg);
                    if (previewImg) { // Check if element exists
                        imageNull.classList.add('hidden')
                        previewImg.classList.remove('hidden')
                        previewImg.classList.add('block')
                        previewImg.src = e.target.result;
                    }
                };
                reader.readAsDataURL(event.target.files[0]);
            }

        }

        function handleFileChangeE(event) {
            const file = event.target.files[0];
            if (file) {
                this.imageSelected = true;
                const reader = new FileReader();
                reader.onload = (e) => {
                    const previewImgE = document.getElementById('previewImgE');
                    const imageNullE = document.getElementById('imageNullE');
                    const fileInput = document.getElementById('file-uploadE');

                    console.log(previewImgE);
                    if (fileInput.files && fileInput.files[0]) { // Check if element exists
                        imageNullE.classList.add('hidden')
                        previewImgE.classList.remove('hidden')
                        previewImgE.classList.add('block')
                        previewImgE.src = e.target.result;
                    }
                };
                reader.readAsDataURL(event.target.files[0]);
            }

        }
    </script>
@endsection
