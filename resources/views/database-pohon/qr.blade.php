@extends('layouts.main')

@push('styles')
@endpush

@section('content')
<div class="w-full px-6 py-6 mx-auto h-screen max-h-full bg-white">
    <!-- cards row 4 -->
    <div class="flex flex-wrap my-6 -mx-3">
        <!-- card 1 -->
        <div class="w-full max-w-full px-3 mt-0 mb-6 md:mb-0 md:flex-none lg:flex-none">
            <div class="flex flex-row text-end justify-end text-dark px-6">
                <ul class="flex flex-row gap-3 text-base">
                    <li><a href="/data-pohon" class="text-primary">Home</a></li>
                    <li>/</li>
                    <li><a href="#">Qr Code Database Pohon</a></li>
                </ul>
            </div>
            <div class="py-10">
                {!! $qr_code !!}
            </div>
            <a href="{{ $download_url }}" download class="mt-10 py-2 px-3 text-white bg-primary rounded-lg">Download QR
                Code</a>
        </div>
    </div>
</div>
</div>
</div>
@endsection


@push('scripts')
@endpush