<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industry Dashboard - Log In</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#ECEEF2] text-slate-800 font-sans antialiased min-h-screen overflow-x-hidden selection:bg-red-700 selection:text-white">

<div class="min-h-screen w-full grid grid-cols-1 lg:grid-cols-12 relative overflow-hidden">
    
    <!-- SISI KIRI: MOCKUP IMAC 24 INCH & SOCIAL PROOF -->
    <div class="lg:col-span-7 relative flex flex-col justify-between p-8 sm:p-12 lg:p-16 min-h-[500px] lg:min-h-screen overflow-hidden">
        
        <!-- Pola Kontur Garis Putus-putus Isometrik Figma -->
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-40 -translate-x-12">
            <svg class="w-[900px] h-[750px]" viewBox="0 0 900 750" fill="none">
                <ellipse cx="450" cy="375" rx="420" ry="240" stroke="#9CA3AF" stroke-width="1.8" stroke-dasharray="10 10"/>
                <ellipse cx="450" cy="375" rx="340" ry="190" stroke="#9CA3AF" stroke-width="1.8" stroke-dasharray="10 10"/>
                <ellipse cx="450" cy="375" rx="260" ry="140" stroke="#9CA3AF" stroke-width="1.8" stroke-dasharray="10 10"/>
            </svg>
        </div>

        <!-- Mockup iMac 24 Inch -->
        <div class="relative z-10 flex-1 flex items-center justify-center my-auto">
            <div class="w-full max-w-[540px] xl:max-w-[620px] transition-transform duration-500 hover:scale-102">
                <img src="{{ asset('images/home/favicon.webp') }}" 
                     alt="iMac 24 Inch" 
                     class="w-full h-auto object-contain select-none drop-shadow-2xl"
                     onerror="this.onerror=null; this.src='https://placehold.co/600x480?text=Mockup+iMac+24+Inch';">
            </div>
        </div>

        <!-- Social Proof Bawah Kiri -->
        <div class="relative z-10 pt-6">
            <p class="text-xs sm:text-sm font-semibold text-gray-800 tracking-tight mb-2">
                Dipercaya Oleh 5+ <span class="text-[#C8102E] font-bold">Mitra industri</span> Kami
            </p>
            <div class="flex items-center gap-6 text-[#C8102E] text-base sm:text-lg">
                <div class="flex items-center gap-1">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <div class="flex items-center gap-1">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
            </div>
        </div>

    </div>

    <!-- SISI KANAN: FORM LOGIN BERBINGKAI PUTIH -->
    <div class="lg:col-span-5 bg-white rounded-t-[3rem] lg:rounded-t-none lg:rounded-l-[3.5rem] p-8 sm:p-12 xl:p-16 flex flex-col justify-center shadow-2xl relative z-20 min-h-screen">
        
        <div class="max-w-md w-full mx-auto space-y-6">
            
            <!-- Logo Resmi Telkom Schools -->
            <div class="flex justify-center mb-2">
                <img src="{{ asset('images/home/favicon.webp') }}" 
                     alt="Telkom Schools" 
                     class="h-14 sm:h-16 w-auto object-contain select-none"
                     onerror="this.onerror=null; this.src='https://placehold.co/240x70?text=Telkom+Schools';">
            </div>

            <!-- Sub-headline -->
            <div class="text-center">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900 tracking-tight">
                    <span class="text-[#C8102E]">Industry</span> Dashboard
                </h2>
            </div>

            @if ($errors->any())
                <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-xs font-semibold text-red-700">
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif

            <form action="{{ route('industry.login.submit') }}" method="POST" class="space-y-4 pt-2">
                @csrf
                
                <!-- Input ID Industri (Background Cyan #EAF6FB) -->
                <div>
                    <input type="text" 
                           name="industry_id" 
                           value="{{ old('industry_id') }}"
                           required 
                           placeholder="Masukan ID Industri..."
                           class="w-full px-5 py-4 rounded-2xl bg-[#EAF6FB] border border-[#d8eef8] text-sm text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#C8102E] transition shadow-inner">
                </div>

                <!-- Input Password Industry -->
                <div>
                    <input type="password" 
                           name="password" 
                           required 
                           placeholder="Masukan Password Industry..."
                           class="w-full px-5 py-4 rounded-2xl bg-[#EAF6FB] border border-[#d8eef8] text-sm text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#C8102E] transition shadow-inner">
                </div>

                <!-- Tombol Log In Merah Telkom -->
                <div class="pt-2">
                    <button type="submit" 
                            style="background-color: #C8102E !important; color: #ffffff !important;"
                            class="w-full py-4 rounded-2xl font-bold text-sm sm:text-base hover:bg-red-800 transition-all duration-200 shadow-lg shadow-red-700/25 active:scale-[0.99] cursor-pointer">
                        Log In
                    </button>
                </div>
            </form>

            <hr class="border-t-2 border-gray-300 w-full mx-auto mt-8">

            <div class="text-center pt-2">
                <p class="text-[11px] text-gray-400 font-medium">
                    Demo ID: <span class="font-bold text-gray-600">IND-GARUDA-01</span> &bull; Password: <span class="font-bold text-gray-600">password123</span>
                </p>
            </div>

        </div>

    </div>

</div>

</body>
</html>