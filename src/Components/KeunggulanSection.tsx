import { useState } from 'react';
import { 
  ArrowUpRight, 
  Trophy, 
  Building2, 
  Laptop, 
  Award, 
  Link as LinkIcon, 
  Cpu, 
  CheckCircle2, 
  X 
} from 'lucide-react';

export default function KeunggulanSection() {
  const [digitalentModalOpen, setDigitalentModalOpen] = useState(false);

  return (
    <section id="keunggulan" className="py-20 lg:py-28 bg-[#F8F9FA] relative">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
          
          {/* Grid 6 Kartu Keunggulan (Kiri - 7 Kolom) */}
          <div className="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-4">
            
            {/* Card 1: Program Digitalent (Featured Red Card) */}
            <div 
              onClick={() => setDigitalentModalOpen(true)}
              className="p-6 rounded-2xl bg-red-700 text-white shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group cursor-pointer"
            >
              <div className="flex items-center justify-between">
                <div className="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-white backdrop-blur-xs">
                  <Cpu className="w-5 h-5 text-white" />
                </div>
                <div className="w-8 h-8 rounded-full bg-white/10 group-hover:bg-white group-hover:text-red-700 text-white flex items-center justify-center transition-colors">
                  <ArrowUpRight className="w-4 h-4" />
                </div>
              </div>
              <h3 className="text-base sm:text-lg font-bold mt-5 tracking-tight flex items-center gap-1.5">
                Program Digitalent
              </h3>
              <p className="text-xs text-red-100 leading-relaxed mt-1.5 font-normal">
                Pembekalan skill digital yang sesuai kebutuhan industri dan startup terkini.
              </p>
              <div className="mt-4 pt-3 border-t border-red-600/60 flex items-center text-[11px] font-semibold text-red-200 group-hover:text-white">
                <span>Pelajari kurikulum digitalent →</span>
              </div>
            </div>

            {/* Card 2: Akreditasi A - Unggul */}
            <div className="p-6 rounded-2xl bg-white border border-gray-200/80 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300">
              <div className="w-10 h-10 rounded-xl bg-red-50 text-red-700 flex items-center justify-center">
                <Trophy className="w-5 h-5" />
              </div>
              <h3 className="text-base font-bold text-gray-900 mt-5 tracking-tight">
                Akreditasi A – Unggul
              </h3>
              <p className="text-xs text-gray-600 leading-relaxed mt-1.5 font-normal">
                Diakui secara nasional dengan standar kualitas terbaik oleh BAN-S/M.
              </p>
            </div>

            {/* Card 3: Yayasan Pendidikan Telkom */}
            <div className="p-6 rounded-2xl bg-white border border-gray-200/80 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300">
              <div className="w-10 h-10 rounded-xl bg-red-50 text-red-700 flex items-center justify-center">
                <Building2 className="w-5 h-5" />
              </div>
              <h3 className="text-base font-bold text-gray-900 mt-5 tracking-tight">
                Yayasan Pendidikan Telkom
              </h3>
              <p className="text-xs text-gray-600 leading-relaxed mt-1.5 font-normal">
                Bagian dari grup pendidikan terpercaya di bawah naungan Telkom Indonesia.
              </p>
            </div>

            {/* Card 4: School of Digital Era */}
            <div className="p-6 rounded-2xl bg-white border border-gray-200/80 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300">
              <div className="w-10 h-10 rounded-xl bg-red-50 text-red-700 flex items-center justify-center">
                <Laptop className="w-5 h-5" />
              </div>
              <h3 className="text-base font-bold text-gray-900 mt-5 tracking-tight">
                School of Digital Era
              </h3>
              <p className="text-xs text-gray-600 leading-relaxed mt-1.5 font-normal">
                Fokus pada kurikulum digital dan keterampilan teknologi masa depan.
              </p>
            </div>

            {/* Card 5: ISO 21001:2018 */}
            <div className="p-6 rounded-2xl bg-white border border-gray-200/80 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300">
              <div className="w-10 h-10 rounded-xl bg-red-50 text-red-700 flex items-center justify-center">
                <Award className="w-5 h-5" />
              </div>
              <h3 className="text-base font-bold text-gray-900 mt-5 tracking-tight">
                ISO 21001:2018
              </h3>
              <p className="text-xs text-gray-600 leading-relaxed mt-1.5 font-normal">
                Telah menerapkan standar manajemen pendidikan bertaraf internasional.
              </p>
            </div>

            {/* Card 6: Program OPES */}
            <div className="p-6 rounded-2xl bg-white border border-gray-200/80 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300">
              <div className="w-10 h-10 rounded-xl bg-red-50 text-red-700 flex items-center justify-center">
                <LinkIcon className="w-5 h-5" />
              </div>
              <h3 className="text-base font-bold text-gray-900 mt-5 tracking-tight">
                Program OPES
              </h3>
              <p className="text-xs text-gray-600 leading-relaxed mt-1.5 font-normal">
                Jalur pendidikan berkelanjutan dari SMK hingga perguruan tinggi Telkom.
              </p>
            </div>

          </div>

          {/* Heading & Foto Siswi dengan Laptop (Kanan - 5 Kolom) */}
          <div className="lg:col-span-5 flex flex-col items-center lg:items-start text-center lg:text-left space-y-6">
            <h2 className="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">
              Kenapa harus pilih <br />
              <span className="text-red-700">Skomda?</span>
            </h2>

            <p className="text-sm text-gray-600 max-w-md">
              Kami menggabungkan pembinaan akhlak mulia dengan ekosistem teknologi canggih Telkom Group untuk membentuk lulusan yang siap kerja, wirausaha, atau studi lanjut.
            </p>

            {/* Circular Arch Student Portrait matching Home page.png */}
            <div className="relative w-64 sm:w-72 md:w-80 h-64 sm:h-72 md:h-80 mt-2">
              {/* Outer decorative dashed circle */}
              <div className="absolute inset-0 border-2 border-dashed border-gray-300 rounded-full scale-110 pointer-events-none"></div>
              
              {/* Red backing circle */}
              <div className="absolute inset-0 bg-red-700 rounded-full scale-95 opacity-90"></div>
              
              {/* Image */}
              <img 
                src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=600&auto=format&fit=crop&q=80" 
                alt="Siswi Skomda Memegang Laptop" 
                className="relative z-10 w-full h-full object-cover rounded-full border-4 border-white shadow-xl hover:scale-105 transition-transform duration-500" 
              />

              {/* Tag pill */}
              <div className="absolute bottom-2 left-1/2 -translate-x-1/2 z-20 bg-white/95 backdrop-blur-xs rounded-full px-4 py-1.5 shadow-md border border-gray-100 text-xs font-bold text-gray-800 whitespace-nowrap">
                #GenerasiDigitalSkomda
              </div>
            </div>
          </div>

        </div>
      </div>

      {/* Modal Program Digitalent */}
      {digitalentModalOpen && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs animate-in fade-in duration-200">
          <div className="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative">
            <button
              onClick={() => setDigitalentModalOpen(false)}
              className="absolute top-5 right-5 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 hover:text-gray-900"
            >
              <X className="w-5 h-5" />
            </button>

            <div className="w-12 h-12 rounded-2xl bg-red-100 text-red-700 flex items-center justify-center mb-4">
              <Cpu className="w-6 h-6" />
            </div>

            <h3 className="text-xl font-bold text-gray-900">Program Unggulan: Digitalent Skomda</h3>
            <p className="text-xs text-red-700 font-semibold mt-1">Inkubasi Keterampilan Masa Depan Berbasis Industri</p>

            <div className="mt-5 space-y-3 text-xs sm:text-sm text-gray-600">
              <p>
                Program Digitalent merupakan kurikulum pengayaan intensif yang diinisiasi SMK Telkom Sidoarjo untuk mempersiapkan siswa menjadi talenta digital yang siap pakai:
              </p>
              
              <ul className="space-y-2 mt-3">
                <li className="flex items-start gap-2">
                  <CheckCircle2 className="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                  <span><strong>Fullstack Web &amp; Mobile:</strong> Pembelajaran React, Flutter, dan Node.js bersama mentor praktisi.</span>
                </li>
                <li className="flex items-start gap-2">
                  <CheckCircle2 className="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                  <span><strong>Cloud Computing &amp; Cybersecurity:</strong> Praktek langsung laboratorium arsitektur AWS dan MikroTik.</span>
                </li>
                <li className="flex items-start gap-2">
                  <CheckCircle2 className="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                  <span><strong>UI/UX Design Studio:</strong> Desain antarmuka produk digital dengan standar Figma &amp; Design Thinking.</span>
                </li>
                <li className="flex items-start gap-2">
                  <CheckCircle2 className="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                  <span><strong>Inkubasi Startup Mini:</strong> Siswa membuat prototype produk nyata yang dipamerkan di panggung tahunan Skomda Expo.</span>
                </li>
              </ul>
            </div>

            <div className="mt-6 pt-4 border-t border-gray-100 flex justify-end">
              <button
                onClick={() => setDigitalentModalOpen(false)}
                className="px-6 py-2 text-xs font-bold text-white bg-red-700 hover:bg-red-800 rounded-full transition"
              >
                Tutup Informasi
              </button>
            </div>
          </div>
        </div>
      )}
    </section>
  );
}
