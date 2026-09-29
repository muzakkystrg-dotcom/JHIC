@extends('layouts.app')

@section('title', 'Tes Minat Bakat (JURUFIND) - SMK Telkom Sidoarjo')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/jurufind.css') }}">
@endpush

@section('content')
<main id="jurufind-app" class="jurufind-app" data-analyze-url="{{ route('jurufind.analyze') }}">
    {{-- STATE 1: Kuis --}}
    <section id="jurufind-quiz-stage" class="jf-stage">
        <div class="jf-container">
            <div class="jf-progress">
                <div class="jf-progress__label">
                    <span id="jf-progress-text">Pertanyaan 1 dari {{ count($questions) }}</span>
                    <span id="jf-progress-pct">5%</span>
                </div>
                <div class="jf-progress__track" id="jf-progress-track"></div>
            </div>

            <div id="jf-question-root"></div>

            <div class="jf-nav">
                <button type="button" id="jf-prev-btn" class="jf-btn jf-btn--ghost" disabled>&larr; Sebelumnya</button>
                <button type="button" id="jf-next-btn" class="jf-btn jf-btn--primary" disabled>Berikutnya</button>
            </div>
        </div>
    </section>

    {{-- STATE 2: Hasil (hidden sampai kuis selesai) --}}
    <section id="jurufind-result-stage" class="jf-stage" hidden>
        <div class="jf-container" id="jf-result-root">
            {{-- diisi penuh oleh JS setelah fetch /jurufind/analyze sukses --}}
        </div>
    </section>
</main>

<script>
    window.JURUFIND_QUESTIONS = @json($questions);
    window.JURUFIND_MAJORS = @json($majors);
    window.JURUFIND_DIMENSION_LABELS = @json($dimensionLabels);
</script>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/jurufind.js') }}" defer></script>
@endpush
