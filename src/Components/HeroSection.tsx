import { ArrowRight, Sparkles } from 'lucide-react';

interface HeroSectionProps {
  onOpenPpdb: () => void;
  onOpenJurufind: () => void;
}

export default function HeroSection({ onOpenPpdb, onOpenJurufind }: HeroSectionProps) {
  return (
    <section 
      id="beranda" 
      className="pt-28 pb-16 sm:pt-36 sm:pb-24 lg:pt-40 lg:pb-28 bg-gradient-to-b from-gray-50/80 via-white to-gray-50/40 relative overflow-hidden"
    >
      {/* Decorative dashed lines in background matching design */}
      <div className="absolute inset-0 pointer-events-none opacity-40">
        <svg className="w-full h-full" xmlns="http://www.w3.org/2000/svg">
          <circle cx="85%" cy="35%" r="280" fill="none" stroke="#E2E8F0" strokeWidth="1.5" strokeDasharray="6 6" />
          <path d="M 600,0 Q 800,200 800,600" fill="none" stroke="#E2E8F0" strokeWidth="1.5" strokeDasharray="6 6" />
        </svg>
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center min-h-[540px]">
          
          {/* Text Column (Left) */}
          <div className="lg:col-span-5 space-y-6 text-center lg:text-left">
            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 text-xs font-semibold text-red-700 border border-red-100">
              <Sparkles className="w-3.5 h-3.5 text-red-600" />
              <span>Penerimaan Siswa Baru 2026/2027 Telah Dibuka!</span>
            </div>

            <p className="text-xs sm:text-sm font-bold text-gray-500 uppercase tracking-wider">
              Selamat datang, di <span className="text-red-700 font-extrabold tracking-normal">SMK TELKOM SIDOARJO!</span>
            </p>

            <h1 className="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-900 leading-[1.18] tracking-tight">
              Sekolah Tangguh, <br />
              Berakhlak, <br />
              <span className="text-red-700">&amp; Berwawasan Digital</span>
            </h1>

            <p className="text-sm sm:text-base text-gray-600 max-w-lg mx-auto lg:mx-0 leading-relaxed font-normal">
              Mempersiapkan talenta teknologi unggul bidang Sistem Informasi &amp; Telekomunikasi dengan kurikulum industri Telkom Indonesia dan sertifikasi internasional.
            </p>
            
            {/* CTA Row */}
            <div className="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
              <span className="text-sm font-semibold text-gray-700">Udah siap Bergabung?</span>
              <button
                onClick={onOpenPpdb}
                className="px-7 py-3 text-sm font-bold text-white bg-red-700 hover:bg-red-800 rounded-full shadow-md hover:shadow-lg hover:-translate-y-0.5 transition duration-200 flex items-center gap-2 active:scale-95 group"
              >
                <span>Daftar ke skomda!</span>
                <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
              </button>
            </div>

            {/* Quick Helper */}
            <div className="pt-2 text-xs text-gray-500 flex items-center justify-center lg:justify-start gap-2">
              <span>Bingung memilih jurusan?</span>
              <button
                onClick={onOpenJurufind}
                className="text-red-700 hover:text-red-800 font-bold underline underline-offset-2 flex items-center gap-1"
              >
                Coba JURUFIND sekarang →
              </button>
            </div>
          </div>

          {/* Collage & Floating Stats (Right) */}
          <div className="lg:col-span-7 relative flex justify-center items-center py-6 select-none">
            
            {/* Background Decorative Dashed Arch Outline */}
            <div className="absolute w-[360px] sm:w-[460px] h-[360px] sm:h-[460px] border-2 border-dashed border-gray-300 rounded-[100px] pointer-events-none -rotate-3"></div>

            {/* 4-Image Grid with Signature Telkom Red Arches */}
            <div className="grid grid-cols-2 gap-4 max-w-sm sm:max-w-md w-full relative z-10 p-2">
              
              {/* Photo 1: Top-Left (Student with tablet) - Arch top-left */}
              <div className="relative group bg-red-700 rounded-tl-[80px] rounded-br-2xl rounded-tr-2xl rounded-bl-2xl overflow-hidden aspect-square shadow-lg border-4 border-white transition-transform duration-300 hover:scale-[1.02]">
                <img 
                  src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600&auto=format&fit=crop&q=80" 
                  alt="Siswa Skomda Belajar Digital" 
                  className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                  loading="eager"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-red-950/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
              </div>

              {/* Photo 2: Top-Right (Student with Megaphone) - Arch top-right */}
              <div className="relative group bg-red-700 rounded-tr-[80px] rounded-bl-2xl rounded-tl-2xl rounded-br-2xl overflow-hidden aspect-square shadow-lg border-4 border-white transition-transform duration-300 hover:scale-[1.02]">
                <img 
                  src="https://images.unsplash.com/photo-1577896851231-70ef18881754?w=600&auto=format&fit=crop&q=80" 
                  alt="Siswa Skomda Antusias" 
                  className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                  loading="eager"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-red-950/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
              </div>

              {/* Photo 3: Bottom-Left (Student smiling gesture) - Arch bottom-left */}
              <div className="relative group bg-red-700 rounded-bl-[80px] rounded-tr-2xl rounded-tl-2xl rounded-br-2xl overflow-hidden aspect-square shadow-lg border-4 border-white transition-transform duration-300 hover:scale-[1.02]">
                <img 
                  src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&auto=format&fit=crop&q=80" 
                  alt="Siswa Prestasi Skomda" 
                  className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                  loading="eager"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-red-950/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
              </div>

              {/* Photo 4: Bottom-Right (Student with hijab pointing up) - Arch bottom-right */}
              <div className="relative group bg-red-700 rounded-br-[80px] rounded-tl-2xl rounded-tr-2xl rounded-bl-2xl overflow-hidden aspect-square shadow-lg border-4 border-white transition-transform duration-300 hover:scale-[1.02]">
                <img 
                  src="https://images.unsplash.com/photo-1544717305-2782549b5136?w=600&auto=format&fit=crop&q=80" 
                  alt="Siswi Kreatif Skomda" 
                  className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                  loading="eager"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-red-950/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
              </div>

            </div>

            {/* Floating Stat 1: 840+ Siswa Aktif (Top-Left) */}
            <div className="absolute -top-2 left-2 sm:left-6 md:left-8 bg-white rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.12)] p-3 sm:p-4 flex flex-col items-center justify-center border border-gray-100 z-20 w-24 sm:w-28 text-center hover:scale-105 transition-transform">
              <span className="text-xl sm:text-2xl font-black text-red-700 leading-none">840+</span>
              <span className="text-[10px] sm:text-xs font-semibold text-gray-600 mt-1">Siswa Aktif</span>
            </div>

            {/* Floating Stat 2: 1327+ Alumni (Top-Right) */}
            <div className="absolute top-4 right-1 sm:right-6 md:right-8 bg-red-700 text-white rounded-2xl shadow-[0_12px_30px_rgba(185,28,28,0.35)] p-3 sm:p-4 flex flex-col items-center justify-center z-20 w-24 sm:w-28 text-center hover:scale-105 transition-transform">
              <span className="text-xl sm:text-2xl font-black text-white leading-none">1327+</span>
              <span className="text-[10px] sm:text-xs font-semibold text-red-100 mt-1">Alumni</span>
            </div>

            {/* Floating Stat 3: 2 Jurusan (Bottom-Left) */}
            <div className="absolute bottom-4 left-1 sm:left-6 md:left-8 bg-red-700 text-white rounded-2xl shadow-[0_12px_30px_rgba(185,28,28,0.35)] p-3 sm:p-4 flex flex-col items-center justify-center z-20 w-24 sm:w-28 text-center hover:scale-105 transition-transform">
              <span className="text-xl sm:text-2xl font-black text-white leading-none">2</span>
              <span className="text-[10px] sm:text-xs font-semibold text-red-100 mt-1">Jurusan</span>
            </div>

            {/* Floating Stat 4: 50+ Partner (Bottom-Right) */}
            <div className="absolute -bottom-3 right-2 sm:right-8 md:right-10 bg-white rounded-2xl shadow-[0_12px_30px_rgba(0,0,0,0.12)] p-3 sm:p-4 flex flex-col items-center justify-center border border-gray-100 z-20 w-24 sm:w-28 text-center hover:scale-105 transition-transform">
              <span className="text-xl sm:text-2xl font-black text-red-700 leading-none">50+</span>
              <span className="text-[10px] sm:text-xs font-semibold text-gray-600 mt-1 leading-tight">Partner Industri</span>
            </div>

          </div>

        </div>
      </div>
    </section>
  );
}
