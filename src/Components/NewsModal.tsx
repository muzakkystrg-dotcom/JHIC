import { X, Calendar, Clock, User, Share2, ArrowLeft } from 'lucide-react';
import { NewsItem } from '../types';

interface NewsModalProps {
  news: NewsItem | null;
  onClose: () => void;
}

export default function NewsModal({ news, onClose }: NewsModalProps) {
  if (!news) return null;

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-slate-950/70 backdrop-blur-xs animate-in fade-in duration-200">
      <div className="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl relative max-h-[92vh] overflow-y-auto">
        
        {/* Close Button */}
        <button
          onClick={onClose}
          className="absolute top-5 right-5 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 hover:text-gray-900 transition"
          aria-label="Tutup Berita"
        >
          <X className="w-4 h-4" />
        </button>

        {/* Back Link */}
        <button
          onClick={onClose}
          className="inline-flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-red-700 mb-4 transition"
        >
          <ArrowLeft className="w-3.5 h-3.5" />
          <span>Kembali ke Berita</span>
        </button>

        {/* Badges & Meta */}
        <div className="flex flex-wrap items-center gap-2 mb-3">
          <span className="px-2.5 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-lg">
            {news.category}
          </span>
          {news.badges.map(b => (
            <span key={b} className="px-2 py-0.5 bg-gray-100 text-gray-700 text-[11px] font-bold rounded-md">
              {b}
            </span>
          ))}
        </div>

        {/* Title */}
        <h3 className="text-xl sm:text-2xl font-black text-slate-900 leading-tight">
          {news.title}
        </h3>

        {/* Meta Row */}
        <div className="flex flex-wrap items-center gap-4 text-xs text-gray-500 my-4 pb-4 border-b border-gray-100">
          <span className="flex items-center gap-1.5">
            <User className="w-3.5 h-3.5 text-red-700" />
            {news.author}
          </span>
          <span className="flex items-center gap-1.5">
            <Calendar className="w-3.5 h-3.5 text-red-700" />
            {news.date}
          </span>
          <span className="flex items-center gap-1.5">
            <Clock className="w-3.5 h-3.5 text-red-700" />
            {news.readTime}
          </span>
        </div>

        {/* Image */}
        <div className="aspect-video w-full rounded-2xl overflow-hidden mb-6 bg-slate-100 shadow-xs">
          <img
            src={news.image}
            alt={news.title}
            className="w-full h-full object-cover"
          />
        </div>

        {/* Content */}
        <div className="space-y-4 text-xs sm:text-sm text-gray-700 leading-relaxed">
          <p className="font-semibold text-gray-900 text-sm sm:text-base leading-relaxed">
            {news.summary}
          </p>
          <p>{news.content}</p>
          <p>
            Kegiatan dan capaian ini merupakan wujud nyata komitmen SMK Telkom Sidoarjo dalam memberikan atmosfer belajar berstandar tinggi yang menstimulasi potensi siswa di bidang rekayasa teknologi dan komunikasi.
          </p>
        </div>

        {/* Footer */}
        <div className="mt-8 pt-4 border-t border-gray-100 flex items-center justify-between">
          <button
            onClick={() => {
              if (navigator.share) {
                navigator.share({ title: news.title, url: window.location.href });
              }
            }}
            className="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-200 text-xs font-semibold text-gray-600 hover:text-red-700 hover:bg-red-50 transition"
          >
            <Share2 className="w-3.5 h-3.5" />
            <span>Bagikan Berita</span>
          </button>

          <button
            onClick={onClose}
            className="px-6 py-2 rounded-xl bg-red-700 hover:bg-red-800 text-white text-xs font-bold transition shadow-xs"
          >
            Tutup
          </button>
        </div>

      </div>
    </div>
  );
}
