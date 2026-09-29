@extends('layouts.app')

@section('title', 'Tes Minat Bakat (JURUFIND) - SMK Telkom Sidoarjo')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/jurufind.css') }}">
@endpush

@section('content')
    <main id="jurufind-app" class="jurufind-app" data-analyze-url="{{ route('jurufind.analyze') }}">

        {{-- Dekorasi zigzag merah pojok bawah --}}
        <div class="jf-deco jf-deco--left" aria-hidden="true"></div>
        <div class="jf-deco jf-deco--right" aria-hidden="true"></div>

        {{-- STATE 1: Kuis --}}
        <section id="jurufind-quiz-stage" class="jf-stage">
            <div class="jf-container">

                {{-- Header progress --}}
                <header class="jf-quiz__top">
                    <span class="jf-quiz__step" id="jf-progress-text">Pertanyaan 1&ndash;2 dari {{ count($questions) }}</span>
                    <span class="jf-quiz__pct">
                        Progres tercapai
                        <span class="jf-quiz__pct-box" id="jf-progress-pct">0%</span>
                    </span>
                </header>

                {{-- Track + dots --}}
                <div class="jf-track">
                    <div class="jf-track__fill" id="jf-track-fill"></div>
                </div>
                <div class="jf-dots" id="jf-progress-track"></div>

                <hr class="jf-divider">

                {{-- Nomor + tipe soal --}}
                <div class="jf-qhead">
                    <span class="jf-qhead__badge" id="jf-qnum">1</span>
                    <span class="jf-qhead__type" id="jf-qtype">Pertanyaan 1 - Pilih Tulisan</span>
                </div>

                {{-- Pertanyaan + sub --}}
                <h2 class="jf-question" id="jf-question-text"></h2>
                <p class="jf-qsub" id="jf-question-sub">Pilih jawaban yang paling menggambarkan minatmu saat ini.</p>

                {{-- Opsi jawaban --}}
                <div class="jf-options" id="jf-options-root"></div>

                {{-- Error --}}
                <div id="jf-error-root"></div>

                {{-- Navigasi bawah --}}
                <footer class="jf-quiz__foot">
                    <button type="button" id="jf-prev-btn" class="jf-btn jf-btn--undo" disabled>&#8634; Undo</button>
                    <div class="jf-foot__right">
                        <span class="jf-hint" id="jf-hint">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                            Pilih salah satu untuk melanjutkan
                        </span>
                        <button type="button" id="jf-next-btn" class="jf-btn jf-btn--next" disabled>Selanjutnya &rarr;</button>
                    </div>
                </footer>

            </div>
        </section>

        {{-- STATE 2: Hasil (diisi penuh oleh JS) --}}
        <section id="jurufind-result-stage" class="jf-stage" hidden>
            <div id="jf-result-root"></div>
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
