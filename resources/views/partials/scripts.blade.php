<!-- All javascirpt -->
<!-- Alpine js -->
<script src="{{ asset('assets/js/alpine-collaspe.min.js') }}"></script>
<script src="{{ asset('assets/js/alpine-persist.min.js') }}"></script>
<script src="{{ asset('assets/js/alpine.min.js') }}" defer></script>

{{-- data table --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
{{-- <script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.tailwindcss.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('script')

<!-- Custom js -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

