@extends('layout.layout2')

@section('content')

<div class="min-h-[calc(100vh-192px)] p-7 flex justify-center items-center">
  <div class="text-center flex flex-col items-center">
    <p class="text-5xl leading-snug font-extrabold">
      Sistem dalam proses maintenance migrasi database
    </p>
    <p class="mt-6 sm:text-2xl text-xl text-gray">
      Lapor/Butuh bantuan hubungi?
      <a href="http://digitree.or.id/">
        <span class="text-success block mt-2 font-semibold">
          digitree.or.id
        </span>
      </a>
    </p>
    <!-- Logo Digitree -->
    <img
      src="{{ asset('assets/img/logo-digitree.png') }}"
      alt="Logo Digitree"
      class="mt-10 mx-auto max-w-xs"
    />
    <!-- Maintenance Illustration -->
    <img
      src="{{ asset('assets/images/maintenance-light.png') }}"
      alt="Maintenance"
      class="mt-10 mx-auto max-w-md"
    />
  </div>
</div>

<footer class="py-7 px-3">
  <p class="text-center font-semibold">
    &copy;
    <script>
      document.write(new Date().getFullYear());
    </script>
    Digitree
  </p>
</footer>

@endsection
