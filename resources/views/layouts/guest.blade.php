<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('partials.head')

<body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500">
    <div class="mt-0 transition-all duration-200 ease-soft-in-out">

        <div class="flex h-screen">
            <!-- Bagian Gambar -->
            <div class="w-full lg:w-1/2 h-screen">
                <img src="{{ asset('assets/img/cover-login-2.jpg') }}" alt="image cover" class="object-cover h-screen">
            </div>

            <!-- Bagian Form -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-8">
                <!-- Logo Probolinggo -->

                <img src="{{ asset('assets/img/logo-new.png') }}" alt="logo digitree" class="h-14 w-18">
                
                <!-- Logo Digitree -->
               
                    {{-- <img src="{{ asset('assets/img/logo-digitree.png') }}" style="" alt="logo digitree" class="h-10 w-30"> --}}
                
                <!-- Form -->
                <div class="w-full max-w-md bg-white p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>
<!-- All javascirpt -->
@include('partials.scripts')

</html>
