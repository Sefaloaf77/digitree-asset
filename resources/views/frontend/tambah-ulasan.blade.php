@extends('frontend.index')

@push('style-frontend')
@endpush

@section('konten-frontend')
    <section class="py-8 px-5">
        <div class="back-btn">
            <a class="flex items-center gap-3 cursor-pointer" href="javascript:history.back()">
                <img src="{{ asset('assets/img/icon/icon-back.svg') }}" class="w-4 h-4 fill-dark-2" alt="">
                <span class="text-sm font-medium">Kembali
                </span>
            </a>
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
        <div class="text-center my-8">
            <h1 class="font-bold text-dark text-2xl">Pohon {{ $ulasan['name_pohon'] }}</h1>
            <p class="text-base text-primary py-2">{{ $ulasan['spesies'] }} ({{ $ulasan['id'] }})</p>
        </div>

        <form action="{{ route('plant.store') }}" method="POST">
            @csrf
            {{-- @method('PUT') --}}
            <div id="tambah-ulasan" class="my-8">
                <h2 class="font-bold text-dark text-xl my-2">Tambahkan Ulasan</h2>
                <input type="hidden" name="code_plant" value="{{ $ulasan['id'] }}">
                <div class="my-4 flex flex-col">
                    <label for="nama" class="py-2 font-medium">Nama Lengkap</label>
                    <input type="text" placeholder="Andi Hermandyah" name="name" id="nama"
                        class="border-2 p-3 rounded-md">
                </div>
                <div class="my-4 flex flex-col">
                    <label for="nomor" class="py-2 font-medium">Nomor Telepon</label>
                    <input type="number" placeholder="081234567890" name="phone" id="nomor"
                        class="border-2 p-3 rounded-md">
                </div>
                <div class="my-4 flex flex-col">
                    <label for="rating" class="py-2 font-medium">Rating</label>
                    <!-- Rating -->
                    <div class="flex flex-row-reverse justify-end items-center">
                        <input id="rating-1" type="radio"
                            class="peer -ms-5 size-8 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="rating" value="5">
                        <label for="rating-1" class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none">
                            <svg class="flex-shrink-0 size-8" xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                </path>
                            </svg>
                        </label>
                        <input id="rating-2" type="radio"
                            class="peer -ms-5 size-8 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="rating" value="4">
                        <label for="rating-2" class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none">
                            <svg class="flex-shrink-0 size-8" xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                </path>
                            </svg>
                        </label>
                        <input id="rating-3" type="radio"
                            class="peer -ms-5 size-8 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="rating" value="3">
                        <label for="rating-3" class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none">
                            <svg class="flex-shrink-0 size-8" xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                </path>
                            </svg>
                        </label>
                        <input id="rating-4" type="radio"
                            class="peer -ms-5 size-8 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="rating" value="2">
                        <label for="rating-4" class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none">
                            <svg class="flex-shrink-0 size-8" xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                </path>
                            </svg>
                        </label>
                        <input id="rating-5" type="radio"
                            class="peer -ms-5 size-8 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="rating" value="1">
                        <label for="rating-5" class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none">
                            <svg class="flex-shrink-0 size-8" xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                </path>
                            </svg>
                        </label>
                    </div>
                    <!-- End Rating -->
                    {{-- <div class="rating">
                        <input type="radio" name="rating" value="1" class="mask mask-star-2 bg-orange-400" />
                        <input type="radio" name="rating" value="2" class="mask mask-star-2 bg-orange-400"
                            checked="checked" />
                        <input type="radio" name="rating" value="3" class="mask mask-star-2 bg-orange-400" />
                        <input type="radio" name="rating" value="4" class="mask mask-star-2 bg-orange-400" />
                        <input type="radio" name="rating" value="5" class="mask mask-star-2 bg-orange-400" />
                    </div> --}}
                </div>
                <div class="my-4 flex flex-col">
                    <label for="ulasan" class="py-2 font-medium">Masukkan Ulasan</label>
                    <textarea name="comment" class="border-2 p-3 rounded-md" id="ulasan" rows="4"
                        placeholder="Ketikkan ulasan anda disini..."></textarea>
                </div>

                <button class="bg-green-digitree text-white text-center p-3 inline-block w-full rounded-full mt-20">
                    Kirim
                    Ulasan
                </button>
            </div>
        </form>
    </section>
@endsection


@push('script-frontend')
@endpush
