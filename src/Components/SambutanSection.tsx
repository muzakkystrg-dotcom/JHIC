export default function SambutanSection() {
  return (
    <section id="sambutan" className="py-20 lg:py-28 bg-white relative overflow-hidden">
      
      {/* Concentric dashed rings radiating from the left photo matching Home page.png */}
      <div className="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1/4 pointer-events-none opacity-45">
        <svg width="900" height="900" viewBox="0 0 900 900" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="450" cy="450" r="240" stroke="#E2E8F0" strokeWidth="1.5" strokeDasharray="6 6" />
          <circle cx="450" cy="450" r="340" stroke="#CBD5E1" strokeWidth="1.5" strokeDasharray="6 6" />
          <circle cx="450" cy="450" r="440" stroke="#E2E8F0" strokeWidth="1.5" strokeDasharray="6 6" />
        </svg>
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
          
          {/* Foto Kepala Sekolah dalam Siluet Arch Merah (Kiri) */}
          <div className="lg:col-span-5 flex justify-center">
            <div className="relative w-64 sm:w-72 md:w-80 h-80 sm:h-96">
              
              {/* Backing Arch Telkom Red */}
              <div className="absolute inset-0 bg-red-700 rounded-t-full rounded-b-3xl transform -rotate-3 scale-95 opacity-90 transition-transform hover:rotate-0"></div>
              
              {/* Subtle secondary layer */}
              <div className="absolute inset-0 bg-red-100 rounded-t-full rounded-b-3xl transform rotate-2"></div>
              
              {/* Foto Kepala Sekolah */}
              <div className="relative z-10 w-full h-full rounded-t-full rounded-b-3xl overflow-hidden shadow-2xl border-4 border-white bg-slate-100">
                <img 
                  src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=700&auto=format&fit=crop&q=80" 
                  alt="Abror S.hum M.pd - Kepala SMK Telkom Sidoarjo" 
                  className="w-full h-full object-cover object-top hover:scale-105 transition-transform duration-500" 
                />
              </div>

              {/* Verified badge */}
              <div className="absolute -bottom-3 right-4 z-20 bg-white border border-gray-100 shadow-md rounded-full px-3 py-1 text-[11px] font-bold text-red-700 flex items-center gap-1.5">
                <span className="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                <span>Kepala Sekolah</span>
              </div>
            </div>
          </div>

          {/* Teks Sambutan (Kanan) */}
          <div className="lg:col-span-7 space-y-5 text-center lg:text-left">
            <div className="inline-block text-xs uppercase tracking-widest text-gray-400 font-bold">
              Sambutan
            </div>
            
            <h2 className="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">
              Kepala sekolah <br />
              <span className="text-red-700">SMK TELKOM SIDOARJO</span>
            </h2>

            <p className="text-gray-600 text-sm sm:text-base leading-relaxed pt-2">
              Selamat datang di website resmi SMK Telkom Sidoarjo. Sebagai institusi pendidikan vokasi yang berfokus pada bidang teknologi dan informatika, kami berkomitmen mencetak generasi yang tidak hanya unggul dalam kompetensi, tetapi juga berkarakter dan siap menghadapi tantangan era digital. Semoga kehadiran website ini menjadi jendela informasi yang bermanfaat bagi seluruh masyarakat.
            </p>

            <p className="text-gray-600 text-sm sm:text-base leading-relaxed">
              Dengan mengintegrasikan kurikulum industri Telkom Indonesia, fasilitas modern, serta budaya berakhlak mulia, kami terus berikhtiar mengantarkan peserta didik meraih cita-cita terbaik di dunia kerja, wirausaha, maupun perguruan tinggi impian.
            </p>

            {/* Author */}
            <div className="pt-4 border-t border-gray-100 flex flex-col items-center lg:items-start">
              <p className="font-extrabold text-gray-900 text-base sm:text-lg flex items-center gap-2">
                <span className="w-2.5 h-2.5 rounded-full bg-red-700"></span>
                Abror S.hum M.pd
              </p>
              <span className="text-xs text-gray-500 font-medium pl-4.5 mt-0.5">
                Kepala SMK Telkom Sidoarjo
              </span>
            </div>
          </div>

        </div>
      </div>
    </section>
  );
}
