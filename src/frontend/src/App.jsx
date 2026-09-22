import { useState } from 'react';
import Navbar from './components/Navbar';
import HeroSection from './components/HeroSection';
import SambutanSection from './components/SambutanSection';
import KeunggulanSection from './components/KeunggulanSection';
import ProgramSection from './components/ProgramSection';
import AlumniSection from './components/AlumniSection';
import PartnerSection from './components/PartnerSection';
import BeritaSection from './components/BeritaSection';
import Footer from './components/Footer';
import JurufindModal from './components/JurufindModal';
import PpdbModal from './components/PpdbModal';
import ProgramDetailModal from './components/ProgramDetailModal';
import NewsModal from './components/NewsModal';
import { NewsItem } from './types';

export default function App() {
  const [jurufindOpen, setJurufindOpen] = useState(false);
  const [ppdbOpen, setPpdbOpen] = useState(false);
  const [programModalOpen, setProgramModalOpen] = useState(false);
  const [selectedProgram, setSelectedProgram] = useState<'SIJA' | 'TJAT'>('SIJA');
  const [selectedNews, setSelectedNews] = useState<NewsItem | null>(null);

  const handleOpenProgram = (programId: 'SIJA' | 'TJAT') => {
    setSelectedProgram(programId);
    setProgramModalOpen(true);
  };

  const handleOpenPpdbWithProgram = (programId: 'SIJA' | 'TJAT') => {
    setSelectedProgram(programId);
    setPpdbOpen(true);
  };

  return (
    <div className="min-h-screen bg-[#FBFBFB] text-slate-800 flex flex-col antialiased selection:bg-red-700 selection:text-white">
      {/* 1. Navbar Floating */}
      <Navbar
        onOpenJurufind={() => setJurufindOpen(true)}
        onOpenPpdb={() => setPpdbOpen(true)}
        onSelectProgram={handleOpenProgram}
      />

      <main className="flex-1">
        {/* 2. Hero Section: 4 foto arch + 4 floating stat badges */}
        <HeroSection
          onOpenPpdb={() => setPpdbOpen(true)}
          onOpenJurufind={() => setJurufindOpen(true)}
        />

        {/* 3. Sambutan Kepala Sekolah */}
        <SambutanSection />

        {/* 4. Kenapa harus pilih Skomda? (6 cards keunggulan) */}
        <KeunggulanSection />

        {/* 5. Program Keahlian (SIJA 4 Tahun & TJAT 3 Tahun) */}
        <ProgramSection
          onSelectProgram={handleOpenProgram}
          onOpenJurufind={() => setJurufindOpen(true)}
        />

        {/* 6. Apa Kata Alumni? (Testimonial carousel) */}
        <AlumniSection />

        {/* 7. 13+ Partner Industri (Infinite Marquee) */}
        <PartnerSection />

        {/* 8. Berita & Informasi Terkini (Tabs category & slider) */}
        <BeritaSection
          onSelectNews={(news) => setSelectedNews(news)}
        />
      </main>

      {/* 9. Footer Lengkap 4 Kolom, Google Maps, Aplikasi & Visitor Stats */}
      <Footer
        onOpenJurufind={() => setJurufindOpen(true)}
        onOpenPpdb={() => setPpdbOpen(true)}
        onSelectProgram={handleOpenProgram}
      />

      {/* Interactive Modals */}
      <JurufindModal
        isOpen={jurufindOpen}
        onClose={() => setJurufindOpen(false)}
        onSelectProgramAndPpdb={handleOpenPpdbWithProgram}
      />

      <PpdbModal
        isOpen={ppdbOpen}
        onClose={() => setPpdbOpen(false)}
        preselectedProgram={selectedProgram}
      />

      <ProgramDetailModal
        isOpen={programModalOpen}
        onClose={() => setProgramModalOpen(false)}
        initialProgramId={selectedProgram}
        onOpenPpdbWithProgram={handleOpenPpdbWithProgram}
      />

      <NewsModal
        news={selectedNews}
        onClose={() => setSelectedNews(null)}
      />
    </div>
  );
}