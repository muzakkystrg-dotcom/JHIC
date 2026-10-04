@extends('layouts.app')

@section('title', 'Tes Minat Bakat (JURUFIND) - SMK Telkom Sidoarjo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/jurufind.css') }}">
@endpush

@section('content')
    <main id="jurufind-app" class="jurufind-app"
        data-analyze-url="{{ route('jurufind.analyze') }}"
        data-result-url="{{ route('jurufind.result') }}">

        {{-- Dekorasi zigzag merah pojok bawah --}}
        <div class="jf-deco jf-deco--left" aria-hidden="true"></div>
        <div class="jf-deco jf-deco--right" aria-hidden="true"></div>

        {{-- STATE 1: Kuis --}}
        <section id="jurufind-quiz-stage" class="jf-stage" @if($isResultPage) hidden @endif>
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
        <section id="jurufind-result-stage" class="jf-stage" @if(!$isResultPage) hidden @endif>
            <div id="jf-result-root"></div>
        </section>
    </main>

    {{-- Satukan data window di dalam 1 tag script sebelum @endsection --}}
    <script>
        window.JURUFIND_QUESTIONS = @json($questions);
        window.JURUFIND_MAJORS = @json($majors);

        // Hasil tes tersimpan (dari session). Null kalau user belum menyelesaikan tes.
        window.JURUFIND_SAVED_RESULT = @json($savedResult);
        window.JURUFIND_IS_RESULT_PAGE = @json($isResultPage);

        // URL halaman hasil: dipakai untuk update address bar + tombol kembali.
        window.JURUFIND_RESULT_URL = "{{ route('jurufind.result') }}";
        window.JURUFIND_TEST_URL = "{{ route('jurufind.test') }}";

        // URL SILABUS UNTUK DIBACA OLEH jurufind.js
        window.JURUFIND_SILABUS_URLS = {
            'SIJA': "{{ route('silabus.sija') }}",
            'TJAT': "{{ route('silabus.tjat') }}"
        };
    </script>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/jurufind.js') }}" defer></script>
@endpush
