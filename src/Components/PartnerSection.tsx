import { PARTNERS } from '../data/mockData';

export default function PartnerSection() {
  return (
    <section id="partner" className="py-16 sm:py-20 bg-white border-y border-gray-100 overflow-hidden">
      <div className="max-w-7xl mx-auto px-4 mb-10 text-center">
        <h3 className="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
          13+ Partner Industri
        </h3>
        <p className="text-xs text-gray-500 mt-1.5 font-medium">
          Kerjasama magang industri, kurikulum berbasis industri, dan rekrutmen lulusan
        </p>
      </div>

      {/* Marquee Container */}
      <div className="relative w-full overflow-hidden py-2 select-none">
        
        {/* Soft gradient edge masks */}
        <div className="absolute left-0 top-0 bottom-0 w-16 sm:w-32 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
        <div className="absolute right-0 top-0 bottom-0 w-16 sm:w-32 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>

        {/* Animated Marquee Flex Track */}
        <div className="flex w-max gap-5 sm:gap-6 animate-marquee">
          
          {/* First loop of items */}
          {PARTNERS.map((partner, idx) => (
            <div
              key={`partner-1-${idx}`}
              className="px-6 py-3.5 sm:px-8 sm:py-4 bg-white border border-gray-200 rounded-2xl flex items-center justify-center min-w-[170px] sm:min-w-[200px] h-16 sm:h-20 shadow-xs hover:shadow-md hover:border-red-300 transition-all cursor-pointer group"
            >
              <div className="text-center">
                <span className={`text-sm sm:text-base font-black tracking-wider ${partner.color || 'text-gray-800'} uppercase group-hover:scale-105 transition-transform inline-block`}>
                  {partner.name}
                </span>
                <span className="block text-[10px] text-gray-400 font-semibold tracking-normal mt-0.5">
                  {partner.category}
                </span>
              </div>
            </div>
          ))}

          {/* Duplicate loop for infinite seamless scroll */}
          {PARTNERS.map((partner, idx) => (
            <div
              key={`partner-2-${idx}`}
              className="px-6 py-3.5 sm:px-8 sm:py-4 bg-white border border-gray-200 rounded-2xl flex items-center justify-center min-w-[170px] sm:min-w-[200px] h-16 sm:h-20 shadow-xs hover:shadow-md hover:border-red-300 transition-all cursor-pointer group"
            >
              <div className="text-center">
                <span className={`text-sm sm:text-base font-black tracking-wider ${partner.color || 'text-gray-800'} uppercase group-hover:scale-105 transition-transform inline-block`}>
                  {partner.name}
                </span>
                <span className="block text-[10px] text-gray-400 font-semibold tracking-normal mt-0.5">
                  {partner.category}
                </span>
              </div>
            </div>
          ))}

        </div>
      </div>
    </section>
  );
}
