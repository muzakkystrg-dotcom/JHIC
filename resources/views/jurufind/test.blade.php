@extends('layouts.app')

@section('title', 'Tes Minat Bakat (JURUFIND) - SMK Telkom Sidoarjo')

@section('content')
    <section>
        <div class="flex justify-center items-center h-screen">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Selamat Datang di Tes Minat Bakat (JURUFIND)</h1>
                <p class="text-lg mb-8">Silakan klik tombol di bawah untuk memulai tes.</p>
            </div>
        </div>
    </section>


@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/jurufind.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/jurufind.js') }}"></script>
@endpush