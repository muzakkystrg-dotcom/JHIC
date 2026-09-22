import { ArrowRight, CheckSquare2 } from 'lucide-react';

interface ProgramSectionProps {
  onSelectProgram: (programId: 'SIJA' | 'TJAT') => void;
  onOpenJurufind: () => void;
}

export default function ProgramSection({ onSelectProgram, onOpenJurufind }: ProgramSectionProps) {
  return (
    <section id="jurusan" className="py-20 lg:py-28 bg-white relative">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Title */}
        <div className="text-center max-w-2xl mx-auto mb-14 lg:mb-20">
          <h2 className="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">
            Program Keahlian <br />
            <span className="text-red-700">di SMK TELKOM SIDOARJO</span>
          </h2>
          <p className="text-gray-500 text-xs sm:text-sm mt-3 font-medium">
            Kurikulum berbasis industri masa depan yang teruji dan diakui secara nasional &amp; internasional
          </p>
        </div>

        {/* 3 Pillars Grid */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          
          {/* Pilar 1: SIJA (Kiri - 4 Kolom) */}
          <div className="lg:col-span-4 bg-gray-50/90 hover:bg-gray-50 p-6 sm:p-8 rounded-3xl border border-gray-200/80 transition-all duration-300 hover:shadow-lg space-y-6">
            <div>
              <div className="inline-block px-3 py-1 bg-red-100 text-red-700 font-bold text-[11px] rounded-full mb-2">
                Program 4 Tahun
              </div>
              <h3 className="text-xl sm:text-2xl font-extrabold text-red-700 tracking-tight leading-snug">
                Sistem Informasi <br />
                Jaringan Aplikasi
              </h3>
              <p className="text-xs text-gray-500 mt-2 leading-relaxed">
                Belajar merancang dan mengembangkan aplikasi, website, arsitektur cloud, yang digunakan di industri digital.
              </p>
            </div>

            {/* Cocok untuk */}
            <div className="space-y-3 pt-2">
              <p className="text-xs font-bold text-gray-800 uppercase tracking-wide">
                Cocok untuk:
              </p>
              
              <div className="flex items-center justify-between p-3 rounded-xl bg-white border border-gray-100 shadow-xs">
                <span className="text-xs font-medium text-gray-700">Suka coding &amp; membuat aplikasi</span>
                <span className="w-6 h-6 rounded-lg bg-red-100 text-red-700 flex items-center justify-center shrink-0">
                  <CheckSquare2 className="w-4 h-4" />
                </span>
              </div>

              <div className="flex items-center justify-between p-3 rounded-xl bg-white border border-gray-100 shadow-xs">
                <span className="text-xs font-medium text-gray-700">Senang berpikir logis dan memecahkan masalah.</span>
                <span className="w-6 h-6 rounded-lg bg-red-100 text-red-700 flex items-center justify-center shrink-0">
                  <CheckSquare2 className="w-4 h-4" />
                </span>
              </div>
            </div>

            {/* Prospek Kerja */}
            <div className="pt-4 border-t border-gray-200">
              <p className="text-xs font-bold text-gray-800 uppercase tracking-wide">
                Prospek Kerja:
              </p>
              <p className="text-xs text-slate-900 font-semibold mt-1.5 leading-relaxed">
                Software Engineer • Web Developer • UI/UX Designer
              </p>
            </div>

            {/* Button */}
            <div className="pt-2">
              <button
                onClick={() => onSelectProgram('SIJA')}
                className="w-full py-2.5 px-4 rounded-xl bg-white hover:bg-red-50 text-red-700 border border-red-200 font-bold text-xs transition duration-200 flex items-center justify-center gap-1.5"
              >
                <span>Detail Kurikulum SIJA</span>
                <ArrowRight className="w-3.5 h-3.5" />
              </button>
            </div>
          </div>

          {/* Pilar 2: Foto Siswi & CTA (Tengah - 4 Kolom) */}
          <div className="lg:col-span-4 flex flex-col items-center text-center">
            
            {/* Signature Tall Arch Frame matching Home page.png */}
            <div className="relative w-64 sm:w-72 h-80 sm:h-96 rounded-t-[120px] rounded-b-3xl bg-red-700 overflow-hidden shadow-2xl border-4 border-white group">
              <img 
                src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=700&auto=format&fit=crop&q=80" 
                alt="Siswi SMK Telkom Sidoarjo dengan Laptop" 
                className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
              />
              <div className="absolute inset-0 bg-gradient-to-t from-red-950/40 via-transparent to-transparent opacity-30"></div>
            </div>

            {/* Central CTA Button matching Home page.png */}
            <button
              onClick={() => onSelectProgram('SIJA')}
              className="mt-6 px-8 py-3 text-xs sm:text-sm font-bold text-white bg-red-700 hover:bg-red-800 rounded-full shadow-md hover:shadow-lg transition-all duration-200 flex items-center gap-2 group active:scale-95"
            >
              <span>Lihat Lengkapnya</span>
              <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
            </button>

            {/* JURUFIND recommendation helper */}
            <button
              onClick={onOpenJurufind}
              className="mt-3 text-[11px] font-semibold text-gray-500 hover:text-red-700 transition"
            >
              Bingung pilih mana? Ikuti <span className="underline font-bold text-red-700">Kuis JURUFIND</span>
            </button>
          </div>

          {/* Pilar 3: TJAT (Kanan - 4 Kolom) */}
          <div className="lg:col-span-4 bg-gray-50/90 hover:bg-gray-50 p-6 sm:p-8 rounded-3xl border border-gray-200/80 transition-all duration-300 hover:shadow-lg space-y-6">
            <div>
              <div className="inline-block px-3 py-1 bg-red-100 text-red-700 font-bold text-[11px] rounded-full mb-2">
                Program 3 Tahun
              </div>
              <h3 className="text-xl sm:text-2xl font-extrabold text-red-700 tracking-tight leading-snug">
                Teknik Jaringan <br />
                Akses Telekomunikasi
              </h3>
              <p className="text-xs text-gray-500 mt-2 leading-relaxed">
                Belajar membangun jaringan komputer, infrastruktur telekomunikasi fiber optik, dan perangkat modern.
              </p>
            </div>

            {/* Cocok untuk */}
            <div className="space-y-3 pt-2">
              <p className="text-xs font-bold text-gray-800 uppercase tracking-wide">
                Cocok untuk:
              </p>

              <div className="flex items-center justify-between p-3 rounded-xl bg-white border border-gray-100 shadow-xs">
                <span className="text-xs font-medium text-gray-700">Tertarik jaringan &amp; internet</span>
                <span className="w-6 h-6 rounded-lg bg-red-100 text-red-700 flex items-center justify-center shrink-0">
                  <CheckSquare2 className="w-4 h-4" />
                </span>
              </div>

              <div className="flex items-center justify-between p-3 rounded-xl bg-white border border-gray-100 shadow-xs">
                <span className="text-xs font-medium text-gray-700">Suka praktik perangkat jaringan</span>
                <span className="w-6 h-6 rounded-lg bg-red-100 text-red-700 flex items-center justify-center shrink-0">
                  <CheckSquare2 className="w-4 h-4" />
                </span>
              </div>
            </div>

            {/* Prospek Kerja */}
            <div className="pt-4 border-t border-gray-200">
              <p className="text-xs font-bold text-gray-800 uppercase tracking-wide">
                Prospek Kerja:
              </p>
              <p className="text-xs text-slate-900 font-semibold mt-1.5 leading-relaxed">
                Network Engineer • IT Support • Fiber Optic Technician
              </p>
            </div>

            {/* Button */}
            <div className="pt-2">
              <button
                onClick={() => onSelectProgram('TJAT')}
                className="w-full py-2.5 px-4 rounded-xl bg-white hover:bg-red-50 text-red-700 border border-red-200 font-bold text-xs transition duration-200 flex items-center justify-center gap-1.5"
              >
                <span>Detail Kurikulum TJAT</span>
                <ArrowRight className="w-3.5 h-3.5" />
              </button>
            </div>
          </div>

        </div>
      </div>
    </section>
  );
}
