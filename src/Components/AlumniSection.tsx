import { useState } from 'react';
import { GraduationCap, Linkedin, ChevronLeft, ChevronRight, Quote } from 'lucide-react';
import { ALUMNI_TESTIMONIALS } from '../data/mockData';

export default function AlumniSection() {
  const [currentIndex, setCurrentIndex] = useState(0);

  const prevSlide = () => {
    setCurrentIndex((prev) => (prev === 0 ? ALUMNI_TESTIMONIALS.length - 1 : prev - 1));
  };

  const nextSlide = () => {
    setCurrentIndex((prev) => (prev === ALUMNI_TESTIMONIALS.length - 1 ? 0 : prev + 1));
  };

  const current = ALUMNI_TESTIMONIALS[currentIndex];

  return (
    <section id="alumni" className="py-20 lg:py-28 bg-gray-50/70 relative">
      <div className="max-w-4xl mx-auto px-4 sm:px-6">
        
        {/* Title */}
        <div className="text-center mb-12">
          <div className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-red-100 text-red-700 mb-3 shadow-xs">
            <GraduationCap className="w-5 h-5 text-red-700" />
          </div>
          
          <h2 className="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
            Apa Kata <span className="text-red-700">Alumni?</span>
          </h2>
          
          <p className="text-xs sm:text-sm text-gray-500 mt-2 font-medium">
            Lihat Perjalanan Para Alumni Berprestasi Setelah Lulus
          </p>
        </div>

        {/* Dashed Border Card Container matching Home page.png */}
        <div className="bg-white rounded-3xl border-2 border-dashed border-gray-300 p-6 sm:p-10 shadow-sm relative group">
          
          {/* Quick Prev / Next Navigation Arrows on hover */}
          <button
            onClick={prevSlide}
            aria-label="Previous Testimonial"
            className="absolute left-2 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white shadow-md border border-gray-100 flex items-center justify-center text-gray-400 hover:text-red-700 opacity-0 group-hover:opacity-100 transition-opacity hidden sm:flex"
          >
            <ChevronLeft className="w-4 h-4" />
          </button>
          
          <button
            onClick={nextSlide}
            aria-label="Next Testimonial"
            className="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white shadow-md border border-gray-100 flex items-center justify-center text-gray-400 hover:text-red-700 opacity-0 group-hover:opacity-100 transition-opacity hidden sm:flex"
          >
            <ChevronRight className="w-4 h-4" />
          </button>

          <div className="flex flex-col md:flex-row items-center gap-8 md:gap-10">
            
            {/* Alumni Photo with Diamond/Tilt Telkom Red Shape matching Home page.png */}
            <div className="relative w-32 h-32 sm:w-36 sm:h-36 shrink-0 flex items-center justify-center">
              {/* Tilted red square */}
              <div className="absolute inset-0 bg-red-700 rounded-3xl transform rotate-6 scale-90 shadow-md"></div>
              
              {/* Photo */}
              <img 
                src={current.image} 
                alt={current.name} 
                className="relative z-10 w-28 h-28 sm:w-32 sm:h-32 object-cover rounded-2xl shadow-md border-2 border-white"
              />
              
              {/* Jurusan tag */}
              <div className="absolute -bottom-2 z-20 bg-slate-900 text-white font-extrabold text-[10px] px-2.5 py-0.5 rounded-full shadow-xs">
                {current.jurusan}
              </div>
            </div>

            {/* Testimonial Content */}
            <div className="space-y-4 text-center md:text-left flex-1">
              <div className="flex justify-center md:justify-start">
                <Quote className="w-6 h-6 text-red-300" />
              </div>

              <p className="text-sm sm:text-base text-gray-700 italic leading-relaxed font-normal">
                "{current.quote}"
              </p>
              
              <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-3 border-t border-gray-100">
                <div>
                  <p className="text-xs sm:text-sm font-extrabold text-gray-900">
                    — {current.name}{' '}
                    <span className="text-red-700 font-bold">• {current.jurusan}</span>
                  </p>
                  <p className="text-[11px] sm:text-xs text-gray-500 font-medium">
                    {current.currentRole} • {current.institution} (Lulus {current.graduationYear})
                  </p>
                </div>

                <a 
                  href={current.linkedinUrl || "https://linkedin.com"} 
                  target="_blank" 
                  rel="noopener noreferrer" 
                  className="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-50 hover:bg-red-50 text-gray-700 hover:text-red-700 text-xs font-semibold transition border border-gray-200"
                >
                  <Linkedin className="w-3.5 h-3.5 text-blue-600" />
                  <span>Profil LinkedIn</span>
                </a>
              </div>
            </div>

          </div>

        </div>

        {/* Carousel Dots Indicator */}
        <div className="flex items-center justify-center gap-2 mt-8">
          {ALUMNI_TESTIMONIALS.map((_, idx) => (
            <button
              key={idx}
              onClick={() => setCurrentIndex(idx)}
              aria-label={`Go to testimonial ${idx + 1}`}
              className={`transition-all duration-300 rounded-full h-2 ${
                idx === currentIndex ? 'w-7 bg-red-700' : 'w-2 bg-gray-300 hover:bg-gray-400'
              }`}
            />
          ))}
        </div>

      </div>
    </section>
  );
}
