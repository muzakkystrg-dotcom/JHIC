import { useState } from 'react';
import { ChevronLeft, ChevronRight, Calendar, ArrowRight } from 'lucide-react';
import { NEWS_ITEMS } from '../data/mockData';
import { NewsItem } from '../types';

interface BeritaSectionProps {
  onSelectNews: (news: NewsItem) => void;
}

const CATEGORIES = [
  'Semua',
  'Kegiatan Sekolah',
  'Prestasi',
  'Karya & Inovasi',
  'Kemitraan & Kerjasama',
  'Alumni',
  'Artikel Edukasi'
];

export default function BeritaSection({ onSelectNews }: BeritaSectionProps) {
  const [selectedCategory, setSelectedCategory] = useState('Semua');
  const [startIndex, setStartIndex] = useState(0);

  const filteredNews = selectedCategory === 'Semua' 
    ? NEWS_ITEMS 
    : NEWS_ITEMS.filter(item => item.category.toLowerCase().includes(selectedCategory.toLowerCase()));

  const itemsPerPage = 3;
  const maxStartIndex = Math.max(0, filteredNews.length - itemsPerPage);

  const handlePrev = () => {
    setStartIndex((prev) => Math.max(0, prev - 1));
  };

  const handleNext = () => {
    setStartIndex((prev) => Math.min(maxStartIndex, prev + 1));
  };

  const visibleNews = filteredNews.slice(startIndex, startIndex + itemsPerPage);

  return (
    <section id="berita" className="py-20 lg:py-28 bg-[#F8F9FA] relative">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Title matching Home page.png */}
        <div className="text-center mb-8">
          <h2 className="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">
            Berita &amp; Informasi Terkini <br />
            <span className="text-red-700 text-lg sm:text-xl font-bold">SMK TELKOM SIDOARJO</span>
          </h2>
          <p className="text-xs sm:text-sm text-gray-500 mt-2 font-medium">
            Kabar prestasi, kegiatan akademik, inovasi siswa, dan agenda resmi sekolah
          </p>
        </div>

        {/* Category Filter Tabs matching Home page.png */}
        <div className="flex items-center justify-start sm:justify-center gap-2 overflow-x-auto pb-4 mb-10 text-xs font-semibold text-gray-500 whitespace-nowrap scrollbar-none">
          <span className="text-xs font-bold text-gray-700 mr-2 hidden sm:inline">Kategori Berita:</span>
          {CATEGORIES.map((cat) => {
            const isActive = selectedCategory === cat;
            return (
              <button
                key={cat}
                onClick={() => {
                  setSelectedCategory(cat);
                  setStartIndex(0);
                }}
                className={`px-4 py-2 rounded-full transition-all duration-200 text-xs font-bold ${
                  isActive 
                    ? 'bg-red-700 text-white shadow-sm' 
                    : 'bg-white text-gray-600 hover:text-red-700 hover:bg-gray-100 border border-gray-200'
                }`}
              >
                {cat}
              </button>
            );
          })}
        </div>

        {/* Slider & Cards Layout with Red Arrow Buttons */}
        <div className="relative flex items-center">
          
          {/* Nav Arrow Left */}
          <button
            onClick={handlePrev}
            disabled={startIndex === 0}
            aria-label="Previous News"
            className="hidden lg:flex absolute -left-6 z-20 w-11 h-11 rounded-xl bg-red-700 text-white items-center justify-center shadow-lg hover:bg-red-800 disabled:opacity-40 disabled:cursor-not-allowed transition duration-200 active:scale-95"
          >
            <ChevronLeft className="w-5 h-5" />
          </button>

          {/* News Cards Grid */}
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
            {visibleNews.map((news) => (
              <article
                key={news.id}
                onClick={() => onSelectNews(news)}
                className="bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-xs hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col cursor-pointer group"
              >
                {/* Image Container with Badges */}
                <div className="relative aspect-video overflow-hidden bg-slate-100">
                  <img
                    src={news.image}
                    alt={news.title}
                    className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent"></div>

                  {/* Program Badges (SIJA, TJAT) matching Home page.png */}
                  <div className="absolute top-3 left-3 flex gap-1.5">
                    {news.badges.map((badge) => (
                      <span
                        key={badge}
                        className={`px-2.5 py-1 text-[10px] font-extrabold rounded-md shadow-xs ${
                          badge === 'SIJA' 
                            ? 'bg-red-700 text-white' 
                            : 'bg-slate-900/90 text-white'
                        }`}
                      >
                        {badge}
                      </span>
                    ))}
                  </div>

                  <div className="absolute bottom-2.5 right-3 text-[11px] text-white/90 font-medium flex items-center gap-1 drop-shadow-sm">
                    <Calendar className="w-3.5 h-3.5" />
                    <span>{news.date}</span>
                  </div>
                </div>

                {/* Content */}
                <div className="p-5 sm:p-6 flex flex-col flex-1 justify-between">
                  <div>
                    <h3 className="text-sm sm:text-base font-bold text-gray-900 group-hover:text-red-700 transition-colors line-clamp-2 leading-snug">
                      {news.title}
                    </h3>
                    <p className="text-xs text-gray-500 mt-2 line-clamp-2 leading-relaxed">
                      {news.summary}
                    </p>
                  </div>

                  <div className="flex items-center justify-between mt-5 pt-3.5 border-t border-gray-100 text-xs">
                    <span className="text-red-700 font-bold">
                      {news.category}
                    </span>
                    <span className="text-gray-400 group-hover:text-red-700 font-semibold flex items-center gap-1 transition-colors">
                      Baca selengkapnya
                      <ArrowRight className="w-3 h-3 group-hover:translate-x-0.5 transition-transform" />
                    </span>
                  </div>
                </div>
              </article>
            ))}
          </div>

          {/* Nav Arrow Right */}
          <button
            onClick={handleNext}
            disabled={startIndex >= maxStartIndex}
            aria-label="Next News"
            className="hidden lg:flex absolute -right-6 z-20 w-11 h-11 rounded-xl bg-red-700 text-white items-center justify-center shadow-lg hover:bg-red-800 disabled:opacity-40 disabled:cursor-not-allowed transition duration-200 active:scale-95"
          >
            <ChevronRight className="w-5 h-5" />
          </button>

        </div>

        {/* Carousel indicator dots */}
        <div className="flex items-center justify-center gap-2 mt-8">
          {Array.from({ length: Math.max(1, filteredNews.length - itemsPerPage + 1) }).map((_, idx) => (
            <button
              key={idx}
              onClick={() => setStartIndex(idx)}
              aria-label={`Go to page ${idx + 1}`}
              className={`transition-all duration-300 rounded-full h-1.5 ${
                idx === startIndex ? 'w-6 bg-red-700' : 'w-2 bg-gray-300'
              }`}
            />
          ))}
        </div>

      </div>
    </section>
  );
}
