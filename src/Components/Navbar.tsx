import { useState } from 'react';
import { ChevronDown, Menu, X, GraduationCap, Sparkles, BookOpen, Users, Compass, PhoneCall } from 'lucide-react';

interface NavbarProps {
  onOpenJurufind: () => void;
  onOpenPpdb: () => void;
  onSelectProgram: (programId: 'SIJA' | 'TJAT') => void;
}

export default function Navbar({ onOpenJurufind, onOpenPpdb, onSelectProgram }: NavbarProps) {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [activeDropdown, setActiveDropdown] = useState<string | null>(null);

  const toggleDropdown = (name: string) => {
    setActiveDropdown(activeDropdown === name ? null : name);
  };

  return (
    <header className="fixed top-3 sm:top-4 left-0 right-0 z-50 px-3 sm:px-6">
      <div className="max-w-7xl mx-auto bg-white/95 backdrop-blur-md rounded-2xl shadow-sm border border-gray-100 px-4 sm:px-8 py-3 sm:py-3.5 flex items-center justify-between transition-all">
        
        {/* Brand Logo */}
        <a href="#beranda" className="flex items-center gap-3 group">
          <div className="w-9 h-9 sm:w-10 sm:h-10 bg-red-700 rounded-xl flex items-center justify-center text-white font-black text-lg sm:text-xl shadow-md group-hover:bg-red-800 transition-colors">
            TS
          </div>
          <div className="flex flex-col leading-tight">
            <span className="text-[10px] sm:text-xs text-gray-500 font-semibold tracking-wider uppercase">SMK Telkom</span>
            <span className="text-xs sm:text-sm font-extrabold text-gray-900 tracking-tight">Sidoarjo</span>
          </div>
        </a>

        {/* Desktop Navigation Links */}
        <nav className="hidden lg:flex items-center gap-7 text-sm font-medium text-gray-600">
          <a href="#beranda" className="text-red-700 font-bold hover:text-red-800 transition">
            Beranda
          </a>

          {/* Dropdown: Tentang kami */}
          <div 
            className="relative"
            onMouseEnter={() => setActiveDropdown('tentang')}
            onMouseLeave={() => setActiveDropdown(null)}
          >
            <button
              onClick={() => toggleDropdown('tentang')}
              className="flex items-center gap-1.5 hover:text-red-700 py-1 transition font-medium text-gray-700"
            >
              Tentang kami
              <ChevronDown className={`w-3.5 h-3.5 transition-transform duration-200 ${activeDropdown === 'tentang' ? 'rotate-180 text-red-700' : ''}`} />
            </button>
            {activeDropdown === 'tentang' && (
              <div className="absolute top-full left-0 w-60 bg-white rounded-xl shadow-xl border border-gray-100 py-2.5 mt-1 z-50 animate-in fade-in slide-in-from-top-2 duration-150">
                <a href="#sambutan" className="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-xs font-semibold text-gray-700">
                  <Users className="w-4 h-4 text-red-600" />
                  Sambutan Kepala Sekolah
                </a>
                <a href="#keunggulan" className="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-xs font-semibold text-gray-700">
                  <Sparkles className="w-4 h-4 text-red-600" />
                  Kenapa Pilih Skomda?
                </a>
                <a href="#alumni" className="flex items-center gap-2.5 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-xs font-semibold text-gray-700">
                  <GraduationCap className="w-4 h-4 text-red-600" />
                  Profil & Kiprah Alumni
                </a>
              </div>
            )}
          </div>

          {/* Button: JURUFIND (Matches image.png position) */}
          <button
            onClick={onOpenJurufind}
            className="px-5 py-2 text-xs font-bold text-white bg-red-700 rounded-full hover:bg-red-800 transition shadow-sm flex items-center gap-1.5 active:scale-95"
            title="Tes Minat Bakat Jurusan SMK Telkom Sidoarjo"
          >
            <Compass className="w-3.5 h-3.5" />
            JURUFIND
          </button>

          {/* Dropdown: Program */}
          <div 
            className="relative"
            onMouseEnter={() => setActiveDropdown('program')}
            onMouseLeave={() => setActiveDropdown(null)}
          >
            <button
              onClick={() => toggleDropdown('program')}
              className="flex items-center gap-1.5 hover:text-red-700 py-1 transition font-medium text-gray-700"
            >
              Program
              <ChevronDown className={`w-3.5 h-3.5 transition-transform duration-200 ${activeDropdown === 'program' ? 'rotate-180 text-red-700' : ''}`} />
            </button>
            {activeDropdown === 'program' && (
              <div className="absolute top-full left-0 w-64 bg-white rounded-xl shadow-xl border border-gray-100 py-2 mt-1 z-50 animate-in fade-in slide-in-from-top-2 duration-150">
                <button
                  onClick={() => { onSelectProgram('SIJA'); setActiveDropdown(null); }}
                  className="w-full text-left px-4 py-2.5 hover:bg-red-50 hover:text-red-700 text-xs font-semibold text-gray-700 flex flex-col"
                >
                  <span className="font-bold text-gray-900">SIJA (4 Tahun)</span>
                  <span className="text-[11px] text-gray-500 font-normal">Sistem Informasi Jaringan & Aplikasi</span>
                </button>
                <button
                  onClick={() => { onSelectProgram('TJAT'); setActiveDropdown(null); }}
                  className="w-full text-left px-4 py-2.5 hover:bg-red-50 hover:text-red-700 text-xs font-semibold text-gray-700 flex flex-col border-t border-gray-50"
                >
                  <span className="font-bold text-gray-900">TJAT (3 Tahun)</span>
                  <span className="text-[11px] text-gray-500 font-normal">Teknik Jaringan Akses Telekomunikasi</span>
                </button>
                <div className="border-t border-gray-100 my-1"></div>
                <a href="#keunggulan" className="block px-4 py-2 hover:bg-red-50 hover:text-red-700 text-xs font-semibold text-gray-700">
                  Program Digital Talent
                </a>
                <a href="#partner" className="block px-4 py-2 hover:bg-red-50 hover:text-red-700 text-xs font-semibold text-gray-700">
                  Program Kemitraan & CCP
                </a>
              </div>
            )}
          </div>

          {/* Dropdown: Informasi */}
          <div 
            className="relative"
            onMouseEnter={() => setActiveDropdown('informasi')}
            onMouseLeave={() => setActiveDropdown(null)}
          >
            <button
              onClick={() => toggleDropdown('informasi')}
              className="flex items-center gap-1.5 hover:text-red-700 py-1 transition font-medium text-gray-700"
            >
              Informasi
              <ChevronDown className={`w-3.5 h-3.5 transition-transform duration-200 ${activeDropdown === 'informasi' ? 'rotate-180 text-red-700' : ''}`} />
            </button>
            {activeDropdown === 'informasi' && (
              <div className="absolute top-full left-0 w-52 bg-white rounded-xl shadow-xl border border-gray-100 py-2 mt-1 z-50 animate-in fade-in slide-in-from-top-2 duration-150">
                <a href="#berita" className="flex items-center gap-2 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-xs font-semibold text-gray-700">
                  <BookOpen className="w-3.5 h-3.5 text-red-600" />
                  Berita & Informasi Terkini
                </a>
                <a href="#partner" className="flex items-center gap-2 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-xs font-semibold text-gray-700">
                  <Users className="w-3.5 h-3.5 text-red-600" />
                  Mitra Industri Skomda
                </a>
                <a href="#kontak" className="flex items-center gap-2 px-4 py-2 hover:bg-red-50 hover:text-red-700 text-xs font-semibold text-gray-700">
                  <PhoneCall className="w-3.5 h-3.5 text-red-600" />
                  Kontak & Lokasi
                </a>
              </div>
            )}
          </div>
        </nav>

        {/* Right Action: Glowing PPDB Button & Mobile Toggle */}
        <div className="flex items-center gap-3">
          <button
            onClick={onOpenPpdb}
            className="px-6 py-2 sm:px-7 sm:py-2.5 text-xs font-bold text-white bg-gradient-to-r from-red-600 via-red-700 to-red-800 rounded-full shadow-[0_4px_22px_rgba(220,38,38,0.55)] hover:shadow-[0_6px_28px_rgba(220,38,38,0.7)] hover:brightness-110 transition duration-200 active:scale-95 animate-pulse-subtle"
            title="Penerimaan Peserta Didik Baru SMK Telkom Sidoarjo"
          >
            PPDB
          </button>

          {/* Mobile Menu Toggle Button */}
          <button
            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
            className="lg:hidden p-2 text-gray-700 hover:text-red-700 focus:outline-none rounded-lg"
            aria-label="Buka Menu"
          >
            {mobileMenuOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
          </button>
        </div>

      </div>

      {/* Mobile Drawer */}
      {mobileMenuOpen && (
        <div className="lg:hidden mt-2 max-w-7xl mx-auto bg-white rounded-2xl shadow-xl border border-gray-100 p-5 space-y-4 animate-in slide-in-from-top-3 duration-200">
          <div className="grid grid-cols-2 gap-2 pb-3 border-b border-gray-100">
            <button
              onClick={() => { onOpenJurufind(); setMobileMenuOpen(false); }}
              className="py-2.5 text-xs font-bold text-white bg-red-700 rounded-xl flex items-center justify-center gap-1.5"
            >
              <Compass className="w-3.5 h-3.5" />
              JURUFIND
            </button>
            <button
              onClick={() => { onOpenPpdb(); setMobileMenuOpen(false); }}
              className="py-2.5 text-xs font-bold text-white bg-gradient-to-r from-red-600 to-red-800 rounded-xl shadow-md"
            >
              Daftar PPDB
            </button>
          </div>

          <nav className="flex flex-col space-y-2 text-sm font-medium text-gray-700">
            <a 
              href="#beranda" 
              onClick={() => setMobileMenuOpen(false)}
              className="px-3 py-2 rounded-lg hover:bg-red-50 hover:text-red-700 font-bold text-red-700"
            >
              Beranda
            </a>
            <a 
              href="#sambutan" 
              onClick={() => setMobileMenuOpen(false)}
              className="px-3 py-2 rounded-lg hover:bg-red-50 hover:text-red-700"
            >
              Sambutan Kepala Sekolah
            </a>
            <a 
              href="#keunggulan" 
              onClick={() => setMobileMenuOpen(false)}
              className="px-3 py-2 rounded-lg hover:bg-red-50 hover:text-red-700"
            >
              Kenapa Harus Pilih Skomda?
            </a>
            <div className="pt-2 border-t border-gray-100">
              <span className="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Program Jurusan</span>
              <div className="grid grid-cols-2 gap-2 mt-2">
                <button
                  onClick={() => { onSelectProgram('SIJA'); setMobileMenuOpen(false); }}
                  className="p-2.5 text-left rounded-xl bg-gray-50 hover:bg-red-50 border border-gray-200"
                >
                  <p className="text-xs font-bold text-red-700">SIJA</p>
                  <p className="text-[10px] text-gray-500">Sistem Informasi</p>
                </button>
                <button
                  onClick={() => { onSelectProgram('TJAT'); setMobileMenuOpen(false); }}
                  className="p-2.5 text-left rounded-xl bg-gray-50 hover:bg-red-50 border border-gray-200"
                >
                  <p className="text-xs font-bold text-red-700">TJAT</p>
                  <p className="text-[10px] text-gray-500">Jaringan Telekomunikasi</p>
                </button>
              </div>
            </div>
            <a 
              href="#alumni" 
              onClick={() => setMobileMenuOpen(false)}
              className="px-3 py-2 rounded-lg hover:bg-red-50 hover:text-red-700"
            >
              Apa Kata Alumni?
            </a>
            <a 
              href="#berita" 
              onClick={() => setMobileMenuOpen(false)}
              className="px-3 py-2 rounded-lg hover:bg-red-50 hover:text-red-700"
            >
              Berita & Informasi
            </a>
            <a 
              href="#kontak" 
              onClick={() => setMobileMenuOpen(false)}
              className="px-3 py-2 rounded-lg hover:bg-red-50 hover:text-red-700"
            >
              Kontak & Lokasi
            </a>
          </nav>
        </div>
      )}
    </header>
  );
}
