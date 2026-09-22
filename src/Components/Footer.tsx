import { useState } from 'react';
import { Mail, Phone, MapPin, ExternalLink, Globe } from 'lucide-react';

interface FooterProps {
  onOpenJurufind: () => void;
  onOpenPpdb: () => void;
  onSelectProgram: (id: 'SIJA' | 'TJAT') => void;
}

export default function Footer({ onOpenJurufind, onOpenPpdb, onSelectProgram }: FooterProps) {
  const [appModal, setAppModal] = useState<string | null>(null);

  return (
    <footer id="kontak" className="bg-white border-t border-gray-200 pt-16 pb-10 text-gray-600 text-xs">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Main 4-Column Grid matching Home page.png */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10">
          
          {/* Kolom 1: Brand & Kontak (Span 4) */}
          <div className="lg:col-span-4 space-y-4">
            <div className="flex items-center gap-3">
              <div className="w-10 h-10 bg-red-700 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-md">
                TS
              </div>
              <div className="flex flex-col leading-tight">
                <span className="text-[10px] text-gray-500 font-semibold tracking-wider uppercase">SMK Telkom</span>
                <span className="text-base font-extrabold text-gray-900 tracking-tight">Sidoarjo</span>
              </div>
            </div>

            <p className="text-xs text-gray-500 leading-relaxed font-normal">
              Bersama SMK Telkom Sidoarjo, jadilah generasi tangguh, berakhlak, dan berwawasan digital.
            </p>

            <div className="space-y-2.5 text-xs text-gray-600 pt-1">
              <a 
                href="mailto:informasi@smktelkom-sda.sch.id"
                className="flex items-center gap-2.5 hover:text-red-700 transition"
              >
                <Mail className="w-4 h-4 text-red-700 shrink-0" />
                <span>informasi@smktelkom-sda.sch.id</span>
              </a>

              <a 
                href="https://wa.me/628113021919" 
                target="_blank" 
                rel="noopener noreferrer"
                className="flex items-center gap-2.5 hover:text-red-700 transition"
              >
                <Phone className="w-4 h-4 text-red-700 shrink-0" />
                <span>0811-3021-919 (Hotline PPDB)</span>
              </a>

              <div className="flex items-start gap-2.5">
                <MapPin className="w-4 h-4 text-red-700 shrink-0 mt-0.5" />
                <span className="leading-relaxed">
                  Jl. Raya Pecantingan Sekardangan, Kabupaten Sidoarjo, Jawa Timur 61215
                </span>
              </div>
            </div>

            {/* Mini partner badges matching bottom left */}
            <div className="pt-2 flex flex-wrap gap-2 items-center text-[10px] font-bold text-gray-400">
              <span className="px-2 py-0.5 rounded bg-gray-100 text-gray-600">Telkom Schools</span>
              <span className="px-2 py-0.5 rounded bg-gray-100 text-gray-600">YPT</span>
              <span className="px-2 py-0.5 rounded bg-gray-100 text-gray-600">BAN-S/M A</span>
            </div>
          </div>

          {/* Kolom 2: Menu Utama (Span 2) */}
          <div className="lg:col-span-2 space-y-3">
            <h4 className="text-xs font-bold text-gray-900 uppercase tracking-wider">
              Menu Utama
            </h4>
            <ul className="space-y-2 text-xs">
              <li>
                <a href="#beranda" className="hover:text-red-700 transition">Beranda</a>
              </li>
              <li>
                <a href="#sambutan" className="hover:text-red-700 transition">Profil Sekolah</a>
              </li>
              <li>
                <button onClick={() => onSelectProgram('SIJA')} className="hover:text-red-700 transition text-left">
                  Profil Jurusan SIJA
                </button>
              </li>
              <li>
                <button onClick={() => onSelectProgram('TJAT')} className="hover:text-red-700 transition text-left">
                  Profil Jurusan TJAT
                </button>
              </li>
              <li>
                <button onClick={onOpenJurufind} className="hover:text-red-700 transition text-left font-semibold text-gray-800">
                  Tes Minat Bakat (JURUFIND)
                </button>
              </li>
              <li>
                <button onClick={onOpenPpdb} className="hover:text-red-800 transition font-bold text-red-700 flex items-center gap-1">
                  <span>PPDB 2026/2027</span>
                  <ExternalLink className="w-3 h-3" />
                </button>
              </li>
            </ul>
          </div>

          {/* Kolom 3: Berita Sekolah (Span 3) */}
          <div className="lg:col-span-3 space-y-3">
            <h4 className="text-xs font-bold text-gray-900 uppercase tracking-wider">
              Berita Sekolah
            </h4>
            <ul className="space-y-2 text-xs">
              <li>
                <a href="#berita" className="hover:text-red-700 transition">Kegiatan Sekolah</a>
              </li>
              <li>
                <a href="#berita" className="hover:text-red-700 transition">Prestasi Siswa &amp; Guru</a>
              </li>
              <li>
                <a href="#berita" className="hover:text-red-700 transition">Karya &amp; Inovasi Digital</a>
              </li>
              <li>
                <a href="#alumni" className="hover:text-red-700 transition">Kiprah &amp; Ikatan Alumni</a>
              </li>
              <li>
                <a href="#partner" className="hover:text-red-700 transition">Kemitraan &amp; Kerjasama Industri</a>
              </li>
              <li>
                <a href="#partner" className="hover:text-red-700 transition">Career Center &amp; Bursa Kerja Khusus</a>
              </li>
            </ul>
          </div>

          {/* Kolom 4: Lokasi Sekolah Embed (Span 3) */}
          <div className="lg:col-span-3 space-y-3">
            <div className="flex items-center justify-between">
              <h4 className="text-xs font-bold text-gray-900 uppercase tracking-wider">
                Lokasi Sekolah
              </h4>
              <a 
                href="https://maps.google.com/?q=SMK+Telkom+Sidoarjo" 
                target="_blank" 
                rel="noopener noreferrer"
                className="text-[10px] text-red-700 hover:underline flex items-center gap-1 font-semibold"
              >
                <span>Buka Maps</span>
                <ExternalLink className="w-2.5 h-2.5" />
              </a>
            </div>

            <div className="rounded-2xl overflow-hidden border border-gray-200 h-40 bg-gray-100 shadow-xs relative">
              <iframe
                title="Peta Lokasi SMK Telkom Sidoarjo"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.3331718817345!2d112.72382461019685!3d-7.428315273142277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e6b528b97d2d%3A0xb35359a60e03cfec!2sSMK%20Telkom%20Sidoarjo!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                className="w-full h-full border-0"
                loading="lazy"
                referrerPolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
            <p className="text-[10px] text-gray-400">
              Kawasan Pendidikan Sekardangan, Sidoarjo (Akses mudah via Stasiun Sidoarjo)
            </p>
          </div>

        </div>

        {/* Sub-row: Aplikasi Siswa & Statistik Pengunjung matching Home page.png */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 pt-10 mt-10 border-t border-gray-100 text-xs">
          
          {/* Aplikasi Siswa */}
          <div>
            <h5 className="font-bold text-gray-900 mb-2">Aplikasi Siswa &amp; Sivitas:</h5>
            <div className="flex flex-wrap items-center gap-2.5 text-gray-500 font-medium">
              <button 
                onClick={() => setAppModal('DigiYouth - Portal Siswa Terpadu')}
                className="hover:text-red-700 underline underline-offset-2 transition"
              >
                DigiYouth
              </button>
              <span>•</span>
              <button 
                onClick={() => setAppModal('MyLMS - Learning Management System Skomda')}
                className="hover:text-red-700 underline underline-offset-2 transition"
              >
                MyLms
              </button>
              <span>•</span>
              <button 
                onClick={() => setAppModal('SIAkad - Sistem Informasi Akademik & Nilai')}
                className="hover:text-red-700 underline underline-offset-2 transition"
              >
                SIAkad
              </button>
              <span>•</span>
              <button 
                onClick={() => setAppModal('Invert - Inventarisasi Perangkat Lab & Aset')}
                className="hover:text-red-700 underline underline-offset-2 transition"
              >
                Invert
              </button>
            </div>
          </div>

          {/* Statistik Pengunjung */}
          <div>
            <h5 className="font-bold text-gray-900 mb-2">Statistik Pengunjung:</h5>
            <p className="text-gray-500">
              Pengunjung Hari Ini: <span className="font-bold text-gray-800">142</span> &nbsp;|&nbsp; 
              Bulan Ini: <span className="font-bold text-gray-800">3,890</span> &nbsp;|&nbsp; 
              Tahun Ini: <span className="font-bold text-gray-800">45,210</span>
            </p>
          </div>

        </div>

        {/* Copyright */}
        <div className="pt-8 mt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between text-gray-400 text-[11px] gap-2">
          <span>Copyright © 2025 All right reserved | SKOMDA</span>
          <span className="flex items-center gap-2">
            <Globe className="w-3.5 h-3.5 text-gray-400" />
            SMK Telkom Sidoarjo • Yayasan Pendidikan Telkom
          </span>
        </div>

      </div>

      {/* App Quick Info Modal */}
      {appModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
          <div className="bg-white rounded-2xl p-6 max-w-sm w-full shadow-2xl text-center space-y-3">
            <div className="w-10 h-10 rounded-xl bg-red-100 text-red-700 flex items-center justify-center mx-auto">
              <Globe className="w-5 h-5" />
            </div>
            <h4 className="font-bold text-gray-900 text-sm">{appModal}</h4>
            <p className="text-xs text-gray-500 leading-relaxed">
              Layanan digital internal siswa SMK Telkom Sidoarjo. Gunakan akun SSO (@smktelkom-sda.sch.id) untuk login.
            </p>
            <button
              onClick={() => setAppModal(null)}
              className="mt-2 w-full py-2 bg-red-700 text-white rounded-xl text-xs font-bold hover:bg-red-800"
            >
              Tutup
            </button>
          </div>
        </div>
      )}
    </footer>
  );
}
