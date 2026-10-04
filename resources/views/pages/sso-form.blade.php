@extends('layouts.app')

@section('title', 'SSO Form - SMK Telkom Sidoarjo')

@section('content')
<div class="bg-[#990000] min-h-screen pt-32 sm:pt-36 pb-16 sm:pb-20 px-4 sm:px-6 lg:px-8 flex flex-col justify-center">
    <div class="max-w-4xl mx-auto w-full">
        
        <!-- Judul Halaman Utama -->
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white text-center mb-8 sm:mb-10 tracking-tight">
            SSO Form
        </h1>

        <!-- Kartu Utama "Daftar dengan SSO" -->
        <div class="max-w-xl mx-auto bg-white rounded-3xl p-6 sm:p-10 shadow-2xl border border-white/20">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">Daftar dengan SSO</h2>
            <p class="text-gray-400 text-sm mb-6 font-normal">SSO bisa didapatkan dari data siswa</p>

            <!-- Form Check SSO -->
            <form id="ssoFormElement" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-2">
                @csrf
                <div class="flex-1 relative">
                    <input type="text" id="ssoInput" name="sso" required placeholder="Ketik SSO..." 
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#C8102E] focus:border-transparent transition bg-white">
                </div>
                <button type="submit" id="checkSsoBtn" class="px-6 py-3 bg-[#8B0000] hover:bg-[#6b0000] active:scale-95 text-white font-semibold text-sm rounded-xl shadow-md transition duration-200 whitespace-nowrap w-full sm:w-auto">
                    Check SSO
                </button>
            </form>

            <!-- Pesan Error / Validasi Inline -->
            <div id="ssoErrorMsg" class="text-xs text-red-600 font-medium mb-4 hidden"></div>

            <!-- Container Hasil Profil Siswa (Muncul setelah Check SSO) -->
            <div id="resultContainer" class="hidden">
                <hr class="border-gray-200 my-6">
                
                <!-- Student Profile Card (Klik untuk Memilih Profil Siswa) -->
                <div id="studentProfileCard" class="border-2 border-gray-200 rounded-2xl p-5 bg-white hover:border-gray-300 transition-all duration-200 cursor-pointer select-none relative">
                    <!-- Badge Centang Terpilih -->
                    <div id="selectedIndicator" class="absolute top-4 right-4 hidden w-6 h-6 bg-[#C8102E] text-white rounded-full flex items-center justify-center text-xs font-bold shadow">
                        ✓
                    </div>

                    <div class="flex items-center gap-5">
                        <!-- Kotak Foto / Avatar Kotak Abu-Abu Sesuai Figma -->
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gray-300 flex items-center justify-center flex-shrink-0 text-gray-400 overflow-hidden">
                            <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 id="cardName" class="font-bold text-gray-900 text-base">Nama...</h4>
                            <p id="cardMajor" class="text-xs text-gray-500 font-medium mt-1">Jurusan...</p>
                            <p id="cardDtp" class="text-xs text-gray-500 font-medium">Dtp...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Note / Lapor Kesalahan -->
            <p class="text-xs text-gray-700 mt-6 text-left">
                Terjadi Kesalahan? <a href="#" class="text-[#C8102E] font-bold underline hover:text-red-800">Lapor Disini!</a>
            </p>
        </div>

        <!-- Tombol Aksi Bawah: Kembali & Lanjut -->
        <div class="max-w-xl mx-auto flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mt-8">
            <a href="{{ route('career-center.index') }}" class="border border-white/80 bg-[#8B0000]/40 hover:bg-white hover:text-[#C8102E] text-white px-6 py-2.5 rounded-xl font-semibold text-sm transition-all duration-200 inline-flex items-center justify-center gap-2 shadow-sm w-full sm:w-auto">
                ↰ Kembali
            </a>

            <!-- Tombol Lanjut (Aktif otomatis setelah profil siswa diklik) -->
            <button id="nextBtn" disabled class="bg-gray-400/50 text-white/60 cursor-not-allowed px-8 py-2.5 rounded-xl font-semibold text-sm transition-all duration-200 inline-flex items-center justify-center gap-2 shadow-sm w-full sm:w-auto">
                Lanjut ➔
            </button>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('ssoFormElement');
    const ssoInput = document.getElementById('ssoInput');
    const checkBtn = document.getElementById('checkSsoBtn');
    const resultContainer = document.getElementById('resultContainer');
    const errorMsg = document.getElementById('ssoErrorMsg');
    
    const cardName = document.getElementById('cardName');
    const cardMajor = document.getElementById('cardMajor');
    const cardDtp = document.getElementById('cardDtp');
    const studentProfileCard = document.getElementById('studentProfileCard');
    const selectedIndicator = document.getElementById('selectedIndicator');
    const nextBtn = document.getElementById('nextBtn');

    let verifiedSsoValue = '';
    let isProfileSelected = false;

    // 1. Submit Form Check SSO (fail-closed: error TIDAK pernah dianggap terverifikasi)
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const ssoVal = ssoInput.value.trim();

        if (!ssoVal) {
            errorMsg.textContent = 'Nomor SSO tidak boleh kosong!';
            errorMsg.classList.remove('hidden');
            return;
        }

        errorMsg.classList.add('hidden');
        checkBtn.textContent = 'Memeriksa...';
        checkBtn.disabled = true;

        resetSelection();

        fetch("{{ route('career-center.sso.check') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ sso: ssoVal })
        })
        .then(response => response.json().then(data => ({ ok: response.ok, data: data })))
        .then(result => {
            const data = result.data || null;

            if (result.ok && data && data.status === 'success') {
                checkBtn.textContent = 'Check SSO';
                checkBtn.disabled = false;

                verifiedSsoValue = data.data.sso;
                cardName.textContent = data.data.name;
                cardMajor.textContent = data.data.major;
                cardDtp.textContent = 'Dtp: ' + data.data.dtp;
                resultContainer.classList.remove('hidden');
            } else {
                failVerification((data && data.message) || 'SSO tidak valid atau tidak ditemukan.');
            }
        })
        .catch(() => {
            // Fail-closed: error jaringan/parse TIDAK dianggap terverifikasi.
            // (Fallback mock lama dihapus — jangan tandai sukses saat gagal.)
            failVerification('Gagal memverifikasi SSO. Periksa koneksi lalu coba lagi.');
        });
    });

    // 2. Klik Card Profil untuk Memilih
    studentProfileCard.addEventListener('click', function() {
        if (!verifiedSsoValue) return;

        isProfileSelected = !isProfileSelected;

        if (isProfileSelected) {
            studentProfileCard.classList.remove('border-gray-200');
            studentProfileCard.classList.add('border-[#C8102E]', 'bg-red-50/20', 'shadow-sm');
            selectedIndicator.classList.remove('hidden');

            nextBtn.disabled = false;
            nextBtn.classList.remove('bg-gray-400/50', 'text-white/60', 'cursor-not-allowed');
            nextBtn.classList.add('bg-white', 'text-[#C8102E]', 'hover:bg-gray-100', 'cursor-pointer', 'shadow-md');
        } else {
            resetSelection();
        }
    });

    function resetSelection() {
        isProfileSelected = false;
        studentProfileCard.classList.add('border-gray-200');
        studentProfileCard.classList.remove('border-[#C8102E]', 'bg-red-50/20', 'shadow-sm');
        selectedIndicator.classList.add('hidden');

        nextBtn.disabled = true;
        nextBtn.classList.add('bg-gray-400/50', 'text-white/60', 'cursor-not-allowed');
        nextBtn.classList.remove('bg-white', 'text-[#C8102E]', 'hover:bg-gray-100', 'cursor-pointer', 'shadow-md');
    }

    // Fail-closed: bersihkan status verifikasi & jangan izinkan lanjut saat gagal.
    function failVerification(message) {
        checkBtn.textContent = 'Check SSO';
        checkBtn.disabled = false;
        verifiedSsoValue = '';
        resetSelection();
        resultContainer.classList.add('hidden');
        errorMsg.textContent = message;
        errorMsg.classList.remove('hidden');
    }

    // 3. Klik Tombol Lanjut -> Buka Halaman Registration Form
    nextBtn.addEventListener('click', function() {
        if (isProfileSelected && verifiedSsoValue) {
            window.location.href = "{{ route('career-center.register') }}?sso=" + encodeURIComponent(verifiedSsoValue);
        }
    });
});
</script>
@endpush