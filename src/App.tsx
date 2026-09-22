/**
 * @license
 * SPDX-License-Identifier: Apache-2.0
 */

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
      {/* Floating Header */}
      <Navbar
        onOpenJurufind={() => setJurufindOpen(true)}
        onOpenPpdb={() => setPpdbOpen(true)}
        onSelectProgram={handleOpenProgram}
      />

      <main className="flex-1">
        {/* Section 1: Hero Section with 4-photo arch collage and 4 floating stat badges */}
        <HeroSection
          onOpenPpdb={() => setPpdbOpen(true)}
          onOpenJurufind={() => setJurufindOpen(true)}
        />

        {/* Section 2: Sambutan Kepala Sekolah */}
        <SambutanSection />

        {/* Section 3: Kenapa harus pilih Skomda? (6 cards + circular student portrait) */}
        <KeunggulanSection />

        {/* Section 4: Program Keahlian SIJA & TJAT (3 Pillars) */}
        <ProgramSection
          onSelectProgram={handleOpenProgram}
          onOpenJurufind={() => setJurufindOpen(true)}
        />

        {/* Section 5: Apa Kata Alumni? (Dashed border testimonial carousel) */}
        <AlumniSection />

        {/* Section 6: 13+ Partner Industri (Infinite Marquee) */}
        <PartnerSection />

        {/* Section 7: Berita & Informasi Terkini (Filtered Category Tabs & Slider) */}
        <BeritaSection
          onSelectNews={(news) => setSelectedNews(news)}
        />
      </main>

      {/* Section 8: Footer (4 Columns, Interactive Map, Student Apps, Live Counter) */}
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
