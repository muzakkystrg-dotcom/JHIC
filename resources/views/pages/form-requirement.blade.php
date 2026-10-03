@extends('layouts.app')

@section('title', $isSuccess ? 'Apply Karier Mu Berhasil! - SMK Telkom Sidoarjo' : 'Registration Form - SMK Telkom Sidoarjo')

@section('content')
<div class="bg-[#990000] min-h-screen text-white font-sans">

@if($isSuccess)
    {{-- =========================================================================
         TAMPILAN SUKSES SUBMIT (DESAIN MASTER FIGMA: Form Requirement(3).png)
         ========================================================================= --}}
    <section class="w-full min-h-[75vh] lg:min-h-[80vh] flex flex-col items-center justify-center text-center px-4 sm:px-6 lg:px-8 pt-36 pb-24" data-aos="zoom-in">
        <div class="max-w-3xl mx-auto space-y-4">
            
            <!-- Headline Utama Sukses -->
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
                Apply Karier Mu Berhasil!
            </h1>

            <!-- Panduan Kembali ke Career Center -->
            <p class="text-sm sm:text-base lg:text-lg text-white/90 font-normal leading-relaxed">
                Kamu bisa kembali ke halaman awal. 
                <a href="{{ route('career-center.index') }}" 
                   class="font-bold text-white underline decoration-white decoration-2 underline-offset-4 hover:text-white/80 transition duration-200 ml-1 inline-block">
                    Kembali Ke Career Center
                </a>
            </p>

        </div>
    </section>

@else
    {{-- =========================================================================
         TAMPILAN FORM REGISTRATION (DESAIN MASTER FIGMA: Form Requirement.png)
         ========================================================================= --}}
    <div class="pt-32 sm:pt-36 pb-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto space-y-8">
            
            <!-- Header Judul -->
            <h1 class="text-4xl sm:text-5xl font-extrabold text-white text-center tracking-tight mb-8">
                Registration Form
            </h1>

            <!-- CARD 1: READY TO GET HIRED? -->
            <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-2xl border border-white/20">
                <h2 class="text-2xl sm:text-3xl font-bold text-red-600 mb-3 tracking-tight">Ready to Get Hired?</h2>
                <p class="text-gray-800 text-sm sm:text-base leading-relaxed font-normal">
                    Complete your profile and upload your best CV. Our AI will rank your skills automatically to match you with top industry partners.
                </p>
            </div>

            <!-- FORM UTAMA -->
            <form action="{{ route('career-center.register.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <input type="hidden" name="sso" value="{{ $sso ?? '' }}">

                @if ($errors->any())
                    <div class="bg-white border-l-4 border-red-600 rounded-2xl p-6 shadow-lg">
                        <p class="font-bold text-red-600 mb-2">Periksa kembali data berikut:</p>
                        <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- CARD 2: PERSONAL INFORMATION -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-2xl border border-white/20">
                    <h3 class="text-xl sm:text-2xl font-bold text-red-600 mb-1">Personal Information</h3>
                    <p class="text-gray-600 text-xs sm:text-sm mb-6 font-normal">Ensure your contact details are up to date.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-gray-800 mb-2">Full Name</label>
                            <input type="text" name="full_name" value="Ahmad Dwi Santoso" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-100 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-800 mb-2">Email Address</label>
                            <input type="email" name="email" value="ahmaddwi@student.telkomsda.sch.id" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-100 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-800 mb-2">Phone Number</label>
                            <input type="text" name="phone" placeholder="081234567890" value="081234567890" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-100 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-800 mb-2">LinkedIn Profile (Optional)</label>
                            <input type="url" name="linkedin" placeholder="https://linkedin.com/in/username"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-100 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                        </div>
                    </div>
                </div>

                <!-- CARD 3: PROFESSIONAL RESUME (CV) & PORTOFOLIO DROPZONE -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-2xl border border-white/20 space-y-8">
                    
                    <!-- Resume (CV) -->
                    <div>
                        <h3 class="text-xl sm:text-2xl font-bold text-red-600 mb-1">Professional Resume (CV)</h3>
                        <p class="text-gray-600 text-xs sm:text-sm mb-4 font-normal">AI will analyze this to determine your industry ranking.</p>

                        <label class="border-2 border-dashed border-gray-400 hover:border-red-600 rounded-3xl p-8 flex flex-col items-center justify-center cursor-pointer bg-gray-50/50 hover:bg-red-50/20 transition-all duration-200">
                            <input type="file" name="resume" accept=".pdf,.doc,.docx" class="hidden" onchange="updateFileName(this, 'resumeLabel')">
                            <span id="resumeLabel" class="text-sm font-semibold text-gray-800 text-center">
                                Click to upload or drag and drop<br>
                                <span class="text-xs text-gray-400 font-normal">PDF, DOC, or DOCX (Max 5MB)</span>
                            </span>
                            <span class="mt-3 px-3 py-1 rounded-full bg-red-100 text-red-700 text-[10px] font-bold tracking-wide uppercase">
                                AI Analysis Enabled
                            </span>
                        </label>
                    </div>

                    <!-- Portofolio -->
                    <div>
                        <h3 class="text-xl sm:text-2xl font-bold text-red-600 mb-1">Professional Portofolio</h3>
                        <p class="text-gray-600 text-xs sm:text-sm mb-4 font-normal">AI will analyze this to determine your industry ranking.</p>

                        <label class="border-2 border-dashed border-gray-400 hover:border-red-600 rounded-3xl p-8 flex flex-col items-center justify-center cursor-pointer bg-gray-50/50 hover:bg-red-50/20 transition-all duration-200">
                            <input type="file" name="portfolio" accept=".pdf,.doc,.docx" class="hidden" onchange="updateFileName(this, 'portfolioLabel')">
                            <span id="portfolioLabel" class="text-sm font-semibold text-gray-800 text-center">
                                Click to upload or drag and drop<br>
                                <span class="text-xs text-gray-400 font-normal">PDF, DOC, or DOCX (Max 5MB)</span>
                            </span>
                            <span class="mt-3 px-3 py-1 rounded-full bg-red-100 text-red-700 text-[10px] font-bold tracking-wide uppercase">
                                AI Analysis Enabled
                            </span>
                        </label>
                    </div>

                </div>

                <!-- CARD 4: HARDSKILL CATEGORIES (CHECKBOX BUTTONS) -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-2xl border border-white/20">
                    <h3 class="text-xl sm:text-2xl font-bold text-red-600 mb-1">HardSkill Categories</h3>
                    <p class="text-gray-600 text-xs sm:text-sm mb-6 font-normal">Select the technical domains where you excel the most.</p>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @for($i = 1; $i <= 8; $i++)
                            <label class="border border-gray-300 rounded-2xl p-3 flex items-center gap-3 cursor-pointer hover:border-red-600 bg-white transition select-none">
                                <input type="checkbox" name="skills[]" value="Web Development {{ $i }}" 
                                    class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                <span class="text-xs font-semibold text-gray-800">Web Development</span>
                            </label>
                        @endfor
                    </div>
                </div>

                <!-- CARD 5: CAREER PREFERENCES & AVAILABILITY -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-2xl border border-white/20 space-y-6">
                    <div>
                        <h3 class="text-xl sm:text-2xl font-bold text-red-600 mb-1">Career Preferences & Availability</h3>
                        <p class="text-gray-600 text-xs sm:text-sm font-normal">Help us match you with the right opportunities.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-800 mb-2">Minat Posisi Kerja (Job Interest)</label>
                        <input type="text" name="job_interest" placeholder="e.g. Senior Frontend Developer, Product Manager..." 
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-gray-800 mb-2">Work Preference</label>
                            <div class="grid grid-cols-3 gap-2">
                                <button type="button" onclick="selectWorkPreference(this, 'Remote')" class="work-pref-btn py-2.5 px-3 border border-gray-300 rounded-xl text-xs font-semibold text-gray-700 hover:border-red-600 transition bg-white">Remote</button>
                                <button type="button" onclick="selectWorkPreference(this, 'On-Site')" class="work-pref-btn py-2.5 px-3 border border-gray-300 rounded-xl text-xs font-semibold text-gray-700 hover:border-red-600 transition bg-white">On-Site</button>
                                <button type="button" onclick="selectWorkPreference(this, 'Hybrid')" class="work-pref-btn py-2.5 px-3 border border-gray-300 rounded-xl text-xs font-semibold text-gray-700 hover:border-red-600 transition bg-white">Hybrid</button>
                            </div>
                            <input type="hidden" name="work_preference" id="selectedWorkPreference" value="On-Site">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-800 mb-2">DTP (Date to Start / Availability)</label>
                            <input type="date" name="start_date" 
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
                        </div>
                    </div>
                </div>

                <!-- FOOTER AKSI BAWAH: INFO & TOMBOL SUBMIT -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                    <p class="text-xs text-white/90 italic text-center sm:text-left">
                        Your data is protected and will be used for AI ranking only.
                    </p>

                    <div class="flex items-center gap-4 w-full sm:w-auto">
                        <button type="button" class="w-1/2 sm:w-auto px-6 py-3 bg-white hover:bg-gray-100 text-gray-800 rounded-xl font-bold text-sm shadow transition duration-200">
                            Save Draft
                        </button>
                        <!-- Tombol Submit Information Menuju Halaman Sukses -->
                        <button type="submit" class="w-1/2 sm:w-auto px-8 py-3 bg-[#8B0000] hover:bg-[#6b0000] active:scale-95 text-white rounded-xl font-bold text-sm shadow-lg transition duration-200">
                            Submit Information
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endif

</div>
@endsection

@push('scripts')
<script>
function updateFileName(input, labelId) {
    if (input.files && input.files[0]) {
        document.getElementById(labelId).innerHTML = '<span class="text-red-700 font-bold">' + input.files[0].name + '</span><br><span class="text-[11px] text-gray-400">File berhasil dipilih</span>';
    }
}

function selectWorkPreference(btn, value) {
    document.querySelectorAll('.work-pref-btn').forEach(b => {
        b.classList.remove('bg-red-50', 'border-red-600', 'text-red-700');
        b.classList.add('bg-white', 'border-gray-300', 'text-gray-700');
    });
    btn.classList.add('bg-red-50', 'border-red-600', 'text-red-700');
    btn.classList.remove('bg-white', 'border-gray-300', 'text-gray-700');
    document.getElementById('selectedWorkPreference').value = value;
}
</script>
@endpush