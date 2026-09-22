import { useState } from 'react';
import { X, Compass, CheckCircle2, RotateCcw, ArrowRight, Sparkles, Award } from 'lucide-react';
import { QUIZ_QUESTIONS, JURUSAN_DATA } from '../data/mockData';

interface JurufindModalProps {
  isOpen: boolean;
  onClose: () => void;
  onSelectProgramAndPpdb: (programId: 'SIJA' | 'TJAT') => void;
}

export default function JurufindModal({ isOpen, onClose, onSelectProgramAndPpdb }: JurufindModalProps) {
  const [currentStep, setCurrentStep] = useState(0);
  const [answers, setAnswers] = useState<Record<number, 'SIJA' | 'TJAT'>>({});
  const [showResult, setShowResult] = useState(false);

  if (!isOpen) return null;

  const currentQuestion = QUIZ_QUESTIONS[currentStep];

  const handleSelectOption = (target: 'SIJA' | 'TJAT') => {
    const updatedAnswers = { ...answers, [currentQuestion.id]: target };
    setAnswers(updatedAnswers);

    if (currentStep < QUIZ_QUESTIONS.length - 1) {
      setCurrentStep(currentStep + 1);
    } else {
      setShowResult(true);
    }
  };

  const resetQuiz = () => {
    setCurrentStep(0);
    setAnswers({});
    setShowResult(false);
  };

  // Calculate results
  const sijaCount = Object.values(answers).filter(val => val === 'SIJA').length;
  const tjatCount = Object.values(answers).filter(val => val === 'TJAT').length;
  const recommendedJurusanId: 'SIJA' | 'TJAT' = sijaCount >= tjatCount ? 'SIJA' : 'TJAT';
  const percentage = Math.round((Math.max(sijaCount, tjatCount) / QUIZ_QUESTIONS.length) * 100);
  const recommendedJurusan = JURUSAN_DATA[recommendedJurusanId];

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-xs animate-in fade-in duration-200">
      <div className="bg-white rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        
        {/* Close Button */}
        <button
          onClick={onClose}
          className="absolute top-5 right-5 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 hover:text-gray-900 transition"
          aria-label="Tutup JURUFIND"
        >
          <X className="w-4 h-4" />
        </button>

        {/* Modal Header */}
        <div className="flex items-center gap-3 mb-6">
          <div className="w-10 h-10 rounded-2xl bg-red-700 text-white flex items-center justify-center shadow-md">
            <Compass className="w-5 h-5" />
          </div>
          <div>
            <div className="flex items-center gap-2">
              <span className="text-sm font-extrabold text-red-700 tracking-wider">JURUFIND</span>
              <span className="text-[10px] bg-red-100 text-red-700 font-bold px-2 py-0.5 rounded-full">Tes Minat Bakat</span>
            </div>
            <h3 className="text-lg font-extrabold text-slate-900 leading-tight">
              Temukan Jurusan Impianmu di Skomda
            </h3>
          </div>
        </div>

        {!showResult ? (
          <div>
            {/* Progress bar */}
            <div className="mb-6">
              <div className="flex justify-between text-xs text-gray-500 font-semibold mb-1.5">
                <span>Pertanyaan {currentStep + 1} dari {QUIZ_QUESTIONS.length}</span>
                <span>{Math.round(((currentStep) / QUIZ_QUESTIONS.length) * 100)}% Selesai</span>
              </div>
              <div className="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                <div 
                  className="h-full bg-red-700 transition-all duration-300"
                  style={{ width: `${((currentStep + 1) / QUIZ_QUESTIONS.length) * 100}%` }}
                ></div>
              </div>
            </div>

            {/* Question Box */}
            <div className="mb-6">
              <h4 className="text-base sm:text-lg font-bold text-gray-900 leading-snug">
                {currentQuestion.question}
              </h4>
            </div>

            {/* Options */}
            <div className="space-y-3">
              <button
                onClick={() => handleSelectOption(currentQuestion.optionA.target)}
                className="w-full p-4 text-left rounded-2xl border-2 border-gray-200 hover:border-red-600 hover:bg-red-50/50 transition-all duration-200 group flex items-start gap-3"
              >
                <div className="w-6 h-6 rounded-full border-2 border-gray-300 group-hover:border-red-700 group-hover:bg-red-700 group-hover:text-white flex items-center justify-center shrink-0 mt-0.5 text-xs font-bold text-gray-500">
                  A
                </div>
                <div>
                  <p className="text-xs sm:text-sm font-semibold text-gray-800 group-hover:text-red-900 leading-relaxed">
                    {currentQuestion.optionA.text}
                  </p>
                  <span className="text-[11px] text-gray-400 mt-1 block">
                    Fokus: Software, Algoritma, Aplikasi &amp; Website
                  </span>
                </div>
              </button>

              <button
                onClick={() => handleSelectOption(currentQuestion.optionB.target)}
                className="w-full p-4 text-left rounded-2xl border-2 border-gray-200 hover:border-red-600 hover:bg-red-50/50 transition-all duration-200 group flex items-start gap-3"
              >
                <div className="w-6 h-6 rounded-full border-2 border-gray-300 group-hover:border-red-700 group-hover:bg-red-700 group-hover:text-white flex items-center justify-center shrink-0 mt-0.5 text-xs font-bold text-gray-500">
                  B
                </div>
                <div>
                  <p className="text-xs sm:text-sm font-semibold text-gray-800 group-hover:text-red-900 leading-relaxed">
                    {currentQuestion.optionB.text}
                  </p>
                  <span className="text-[11px] text-gray-400 mt-1 block">
                    Fokus: Jaringan Komputer, Kabel Fiber Optik &amp; Telekomunikasi
                  </span>
                </div>
              </button>
            </div>
          </div>
        ) : (
          /* Result View */
          <div className="space-y-6 animate-in zoom-in-95 duration-200">
            <div className="text-center p-6 rounded-2xl bg-gradient-to-b from-red-50 via-white to-red-50/40 border border-red-200">
              <div className="w-14 h-14 rounded-2xl bg-red-700 text-white flex items-center justify-center mx-auto mb-3 shadow-lg">
                <Award className="w-7 h-7" />
              </div>
              
              <span className="text-xs font-bold uppercase tracking-wider text-red-700">
                Rekomendasi Terbaik Untukmu
              </span>
              
              <h4 className="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">
                {recommendedJurusan.name} ({percentage}% Kecocokan)
              </h4>
              
              <p className="text-xs font-semibold text-gray-600 mt-1">
                {recommendedJurusan.fullName}
              </p>
              
              <div className="inline-block mt-3 px-3 py-1 bg-red-700 text-white text-xs font-bold rounded-full">
                {recommendedJurusan.duration}
              </div>
            </div>

            {/* Why it matches */}
            <div className="space-y-3">
              <h5 className="text-xs font-bold text-gray-900 uppercase tracking-wider flex items-center gap-1.5">
                <Sparkles className="w-3.5 h-3.5 text-red-600" />
                Mengapa jurusan ini paling pas untukmu?
              </h5>
              
              <div className="space-y-2">
                {recommendedJurusan.suitableFor.map((item, idx) => (
                  <div key={idx} className="flex items-start gap-2 text-xs text-gray-700 bg-gray-50 p-2.5 rounded-xl border border-gray-100">
                    <CheckCircle2 className="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                    <span>{item}</span>
                  </div>
                ))}
              </div>
            </div>

            {/* Career Prospects */}
            <div>
              <h5 className="text-xs font-bold text-gray-900 uppercase tracking-wider mb-2">
                Prospek Karir Masa Depan:
              </h5>
              <div className="flex flex-wrap gap-1.5">
                {recommendedJurusan.careerProspects.map((career, idx) => (
                  <span key={idx} className="px-2.5 py-1 bg-gray-100 text-gray-700 text-[11px] font-semibold rounded-lg">
                    {career}
                  </span>
                ))}
              </div>
            </div>

            {/* Actions */}
            <div className="pt-4 border-t border-gray-100 flex flex-col sm:flex-row gap-3">
              <button
                onClick={resetQuiz}
                className="py-2.5 px-4 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-bold transition flex items-center justify-center gap-1.5"
              >
                <RotateCcw className="w-3.5 h-3.5" />
                <span>Ulangi Tes</span>
              </button>

              <button
                onClick={() => {
                  onClose();
                  onSelectProgramAndPpdb(recommendedJurusanId);
                }}
                className="flex-1 py-3 px-6 rounded-xl bg-red-700 hover:bg-red-800 text-white text-xs font-bold shadow-md hover:shadow-lg transition flex items-center justify-center gap-2"
              >
                <span>Daftar {recommendedJurusan.name} di PPDB Sekarang</span>
                <ArrowRight className="w-4 h-4" />
              </button>
            </div>
          </div>
        )}

      </div>
    </div>
  );
}
