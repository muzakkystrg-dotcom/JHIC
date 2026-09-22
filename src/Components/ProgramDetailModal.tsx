import { useState } from 'react';
import { 
  X, 
  CheckCircle2, 
  Briefcase, 
  BookOpen, 
  Award, 
  Layers, 
  ArrowRight,
  Sparkles
} from 'lucide-react';
import { JURUSAN_DATA } from '../data/mockData';

interface ProgramDetailModalProps {
  isOpen: boolean;
  onClose: () => void;
  initialProgramId: 'SIJA' | 'TJAT';
  onOpenPpdbWithProgram: (programId: 'SIJA' | 'TJAT') => void;
}

export default function ProgramDetailModal({
  isOpen,
  onClose,
  initialProgramId,
  onOpenPpdbWithProgram
}: ProgramDetailModalProps) {
  const [selectedId, setSelectedId] = useState<'SIJA' | 'TJAT'>(initialProgramId);

  if (!isOpen) return null;

  const current = JURUSAN_DATA[selectedId];

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-slate-950/70 backdrop-blur-xs animate-in fade-in duration-200">
      <div className="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl relative max-h-[92vh] overflow-y-auto">
        
        {/* Close Button */}
        <button
          onClick={onClose}
          className="absolute top-5 right-5 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 hover:text-gray-900 transition"
          aria-label="Tutup Detail Jurusan"
        >
          <X className="w-4 h-4" />
        </button>

        {/* Tab switch between SIJA & TJAT */}
        <div className="flex gap-2 p-1.5 bg-gray-100 rounded-2xl mb-6 max-w-md">
          <button
            onClick={() => setSelectedId('SIJA')}
            className={`flex-1 py-2.5 rounded-xl font-bold text-xs transition-all flex items-center justify-center gap-1.5 ${
              selectedId === 'SIJA'
                ? 'bg-red-700 text-white shadow-md'
                : 'text-gray-600 hover:text-gray-900'
            }`}
          >
            <span>SIJA (4 Tahun)</span>
          </button>
          <button
            onClick={() => setSelectedId('TJAT')}
            className={`flex-1 py-2.5 rounded-xl font-bold text-xs transition-all flex items-center justify-center gap-1.5 ${
              selectedId === 'TJAT'
                ? 'bg-red-700 text-white shadow-md'
                : 'text-gray-600 hover:text-gray-900'
            }`}
          >
            <span>TJAT (3 Tahun)</span>
          </button>
        </div>

        {/* Header */}
        <div className="mb-6">
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-bold mb-2">
            <Sparkles className="w-3.5 h-3.5" />
            <span>{current.duration}</span>
          </div>
          <h3 className="text-2xl font-black text-slate-900 leading-tight">
            {current.fullName} ({current.name})
          </h3>
          <p className="text-xs sm:text-sm text-gray-600 mt-2 leading-relaxed">
            {current.description}
          </p>
        </div>

        {/* 2-Column Specs */}
        <div className="space-y-6 text-xs">
          
          {/* Key Subjects */}
          <div className="bg-gray-50 p-4 sm:p-5 rounded-2xl border border-gray-100">
            <h4 className="font-bold text-gray-900 text-xs uppercase tracking-wider mb-3 flex items-center gap-2">
              <BookOpen className="w-4 h-4 text-red-700" />
              Mata Pelajaran &amp; Kompetensi Keahlian Utama:
            </h4>
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-2">
              {current.keySubjects.map((subject, idx) => (
                <div key={idx} className="flex items-start gap-2 text-gray-700 bg-white p-2.5 rounded-xl border border-gray-100">
                  <CheckCircle2 className="w-3.5 h-3.5 text-emerald-600 shrink-0 mt-0.5" />
                  <span className="font-medium">{subject}</span>
                </div>
              ))}
            </div>
          </div>

          {/* Certifications & Labs */}
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
            
            {/* Certifications */}
            <div className="p-4 rounded-2xl bg-red-50/70 border border-red-100">
              <h4 className="font-bold text-red-950 text-xs uppercase tracking-wider mb-2.5 flex items-center gap-1.5">
                <Award className="w-4 h-4 text-red-700" />
                Sertifikasi Industri:
              </h4>
              <ul className="space-y-1.5 text-red-900 font-medium">
                {current.certifications.map((cert, idx) => (
                  <li key={idx} className="flex items-center gap-2">
                    <span className="w-1.5 h-1.5 rounded-full bg-red-700"></span>
                    {cert}
                  </li>
                ))}
              </ul>
            </div>

            {/* Labs */}
            <div className="p-4 rounded-2xl bg-gray-50 border border-gray-100">
              <h4 className="font-bold text-gray-900 text-xs uppercase tracking-wider mb-2.5 flex items-center gap-1.5">
                <Layers className="w-4 h-4 text-red-700" />
                Fasilitas Laboratorium:
              </h4>
              <ul className="space-y-1.5 text-gray-700 font-medium">
                {current.labs.map((lab, idx) => (
                  <li key={idx} className="flex items-center gap-2">
                    <span className="w-1.5 h-1.5 rounded-full bg-slate-700"></span>
                    {lab}
                  </li>
                ))}
              </ul>
            </div>

          </div>

          {/* Career Prospects */}
          <div>
            <h4 className="font-bold text-gray-900 text-xs uppercase tracking-wider mb-2 flex items-center gap-1.5">
              <Briefcase className="w-4 h-4 text-red-700" />
              Peluang Karir &amp; Pekerjaan Lulusan:
            </h4>
            <div className="flex flex-wrap gap-2">
              {current.careerProspects.map((prospect, idx) => (
                <span
                  key={idx}
                  className="px-3 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-800 font-bold text-xs shadow-xs"
                >
                  {prospect}
                </span>
              ))}
            </div>
          </div>

        </div>

        {/* Footer actions */}
        <div className="mt-8 pt-4 border-t border-gray-100 flex flex-col sm:flex-row justify-end gap-3">
          <button
            onClick={onClose}
            className="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-bold transition"
          >
            Tutup
          </button>
          <button
            onClick={() => {
              onClose();
              onOpenPpdbWithProgram(selectedId);
            }}
            className="px-7 py-2.5 rounded-xl bg-red-700 hover:bg-red-800 text-white text-xs font-bold shadow-md hover:shadow-lg transition flex items-center justify-center gap-2"
          >
            <span>Daftar Jurusan {selectedId} di PPDB 2026/2027</span>
            <ArrowRight className="w-4 h-4" />
          </button>
        </div>

      </div>
    </div>
  );
}
