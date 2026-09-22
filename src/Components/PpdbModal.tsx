import { useState } from 'react';
import { 
  X, 
  CheckCircle2, 
  Sparkles, 
  FileText, 
  HelpCircle, 
  Calendar, 
  Send, 
  Award,
  PhoneCall
} from 'lucide-react';

interface PpdbModalProps {
  isOpen: boolean;
  onClose: () => void;
  preselectedProgram?: 'SIJA' | 'TJAT';
}

export default function PpdbModal({ isOpen, onClose, preselectedProgram }: PpdbModalProps) {
  const [activeTab, setActiveTab] = useState<'form' | 'jalur' | 'syarat'>('form');
  const [formData, setFormData] = useState({
    fullName: '',
    schoolOrigin: '',
    whatsapp: '',
    program: preselectedProgram || 'SIJA',
    track: 'Jalur Prestasi Rapor',
    parentName: '',
  });

  const [submitted, setSubmitted] = useState(false);
  const [regCode, setRegCode] = useState('');

  if (!isOpen) return null;

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!formData.fullName || !formData.whatsapp) return;
    
    // Generate realistic registration code
    const randomCode = `SKOMDA-2026-${Math.floor(1000 + Math.random() * 9000)}`;
    setRegCode(randomCode);
    setSubmitted(true);
  };

  const handleReset = () => {
    setSubmitted(false);
    setFormData({
      fullName: '',
      schoolOrigin: '',
      whatsapp: '',
      program: 'SIJA',
      track: 'Jalur Prestasi Rapor',
      parentName: '',
    });
  };

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-slate-950/70 backdrop-blur-xs animate-in fade-in duration-200">
      <div className="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl relative max-h-[92vh] overflow-y-auto">
        
        {/* Close Button */}
        <button
          onClick={onClose}
          className="absolute top-5 right-5 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 hover:text-gray-900 transition"
          aria-label="Tutup PPDB"
        >
          <X className="w-4 h-4" />
        </button>

        {/* Modal Header */}
        <div className="flex items-center gap-3.5 mb-6">
          <div className="w-11 h-11 rounded-2xl bg-gradient-to-r from-red-600 to-red-800 text-white flex items-center justify-center shadow-lg">
            <Sparkles className="w-6 h-6" />
          </div>
          <div>
            <div className="flex items-center gap-2">
              <span className="text-xs font-black text-red-700 uppercase tracking-widest">PPDB Online</span>
              <span className="text-[10px] bg-red-100 text-red-700 font-bold px-2 py-0.5 rounded-full">T.A. 2026/2027</span>
            </div>
            <h3 className="text-lg sm:text-xl font-extrabold text-slate-900 leading-tight">
              Penerimaan Peserta Didik Baru SMK Telkom Sidoarjo
            </h3>
          </div>
        </div>

        {/* Sub-navigation tabs */}
        <div className="flex gap-2 p-1 bg-gray-100 rounded-xl mb-6 text-xs font-bold">
          <button
            onClick={() => setActiveTab('form')}
            className={`flex-1 py-2 rounded-lg transition-all ${
              activeTab === 'form' 
                ? 'bg-white text-red-700 shadow-xs' 
                : 'text-gray-600 hover:text-gray-900'
            }`}
          >
            Formulir Pendaftaran
          </button>
          <button
            onClick={() => setActiveTab('jalur')}
            className={`flex-1 py-2 rounded-lg transition-all ${
              activeTab === 'jalur' 
                ? 'bg-white text-red-700 shadow-xs' 
                : 'text-gray-600 hover:text-gray-900'
            }`}
          >
            Pilihan Jalur Masuk
          </button>
          <button
            onClick={() => setActiveTab('syarat')}
            className={`flex-1 py-2 rounded-lg transition-all ${
              activeTab === 'syarat' 
                ? 'bg-white text-red-700 shadow-xs' 
                : 'text-gray-600 hover:text-gray-900'
            }`}
          >
            Syarat &amp; Alur
          </button>
        </div>

        {/* Tab 1: Form Pendaftaran */}
        {activeTab === 'form' && (
          <div>
            {!submitted ? (
              <form onSubmit={handleSubmit} className="space-y-4">
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label className="block text-xs font-bold text-gray-700 mb-1">
                      Nama Lengkap Calon Siswa *
                    </label>
                    <input
                      type="text"
                      required
                      value={formData.fullName}
                      onChange={(e) => setFormData({ ...formData, fullName: e.target.value })}
                      placeholder="Contoh: Muhammad Rizky Pratama"
                      className="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-xs focus:ring-2 focus:ring-red-600 focus:outline-none"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-gray-700 mb-1">
                      Asal Sekolah (SMP / MTs) *
                    </label>
                    <input
                      type="text"
                      required
                      value={formData.schoolOrigin}
                      onChange={(e) => setFormData({ ...formData, schoolOrigin: e.target.value })}
                      placeholder="Contoh: SMPN 1 Sidoarjo"
                      className="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-xs focus:ring-2 focus:ring-red-600 focus:outline-none"
                    />
                  </div>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label className="block text-xs font-bold text-gray-700 mb-1">
                      Nomor WhatsApp Calon Siswa / Ortu *
                    </label>
                    <input
                      type="tel"
                      required
                      value={formData.whatsapp}
                      onChange={(e) => setFormData({ ...formData, whatsapp: e.target.value })}
                      placeholder="Contoh: 081234567890"
                      className="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-xs focus:ring-2 focus:ring-red-600 focus:outline-none"
                    />
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-gray-700 mb-1">
                      Nama Orang Tua / Wali
                    </label>
                    <input
                      type="text"
                      value={formData.parentName}
                      onChange={(e) => setFormData({ ...formData, parentName: e.target.value })}
                      placeholder="Nama ayah / ibu"
                      className="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-xs focus:ring-2 focus:ring-red-600 focus:outline-none"
                    />
                  </div>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                  <div>
                    <label className="block text-xs font-bold text-gray-700 mb-1">
                      Pilihan Program Keahlian *
                    </label>
                    <select
                      value={formData.program}
                      onChange={(e) => setFormData({ ...formData, program: e.target.value as 'SIJA' | 'TJAT' })}
                      className="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-xs bg-white focus:ring-2 focus:ring-red-600 focus:outline-none font-semibold text-gray-800"
                    >
                      <option value="SIJA">SIJA (Sistem Informasi Jaringan &amp; Aplikasi - 4 Thn)</option>
                      <option value="TJAT">TJAT (Teknik Jaringan Akses Telekomunikasi - 3 Thn)</option>
                    </select>
                  </div>

                  <div>
                    <label className="block text-xs font-bold text-gray-700 mb-1">
                      Jalur Pendaftaran *
                    </label>
                    <select
                      value={formData.track}
                      onChange={(e) => setFormData({ ...formData, track: e.target.value })}
                      className="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-xs bg-white focus:ring-2 focus:ring-red-600 focus:outline-none font-semibold text-gray-800"
                    >
                      <option value="Jalur Prestasi Rapor">Jalur Prestasi Rapor (Tanpa Tes Tulis)</option>
                      <option value="Jalur Minat Bakat (Portofolio)">Jalur Minat Bakat (Portofolio IT)</option>
                      <option value="Jalur Reguler CBT">Jalur Reguler CBT</option>
                      <option value="Jalur Beasiswa YPT">Jalur Beasiswa YPT (Yayasan Telkom)</option>
                    </select>
                  </div>
                </div>

                <div className="p-3 bg-red-50 rounded-xl border border-red-100 text-[11px] text-red-800 flex items-start gap-2">
                  <HelpCircle className="w-4 h-4 text-red-600 shrink-0 mt-0.5" />
                  <span>
                    Setelah formulir dikirim, Tim Panitia PPDB Skomda akan menghubungi nomor WhatsApp Anda dalam 1x24 jam untuk verifikasi berkas dan jadwal konsultasi jurusan.
                  </span>
                </div>

                <div className="pt-2 flex justify-end gap-3">
                  <button
                    type="button"
                    onClick={onClose}
                    className="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-bold transition"
                  >
                    Batal
                  </button>
                  <button
                    type="submit"
                    className="px-7 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-red-800 hover:from-red-700 hover:to-red-900 text-white text-xs font-bold shadow-md hover:shadow-lg transition flex items-center gap-2"
                  >
                    <Send className="w-3.5 h-3.5" />
                    <span>Kirim Formulir PPDB</span>
                  </button>
                </div>
              </form>
            ) : (
              /* Success confirmation */
              <div className="text-center py-6 space-y-4 animate-in zoom-in-95 duration-200">
                <div className="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto shadow-md">
                  <CheckCircle2 className="w-9 h-9" />
                </div>
                
                <h4 className="text-xl font-black text-slate-900">
                  Pendaftaran Berhasil Dikirim!
                </h4>

                <p className="text-xs text-gray-600 max-w-md mx-auto leading-relaxed">
                  Terima kasih, <strong>{formData.fullName}</strong>. Data calon siswa telah tercatat di basis data PPDB SMK Telkom Sidoarjo Tahun Ajaran 2026/2027.
                </p>

                {/* Registration Slip Box */}
                <div className="bg-gray-50 p-4 rounded-2xl border border-gray-200 max-w-md mx-auto text-left space-y-2 text-xs">
                  <div className="flex justify-between border-b border-gray-200 pb-2">
                    <span className="text-gray-500 font-semibold">Nomor Registrasi:</span>
                    <span className="font-mono font-black text-red-700">{regCode}</span>
                  </div>
                  <div className="flex justify-between">
                    <span className="text-gray-500">Pilihan Jurusan:</span>
                    <span className="font-bold text-gray-800">{formData.program}</span>
                  </div>
                  <div className="flex justify-between">
                    <span className="text-gray-500">Jalur Pendaftaran:</span>
                    <span className="font-semibold text-gray-800">{formData.track}</span>
                  </div>
                  <div className="flex justify-between">
                    <span className="text-gray-500">WhatsApp Terdaftar:</span>
                    <span className="font-semibold text-gray-800">{formData.whatsapp}</span>
                  </div>
                </div>

                <div className="pt-4 flex flex-col sm:flex-row justify-center gap-3">
                  <button
                    onClick={handleReset}
                    className="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold"
                  >
                    Daftar Siswa Lain
                  </button>

                  <a
                    href="https://wa.me/628113021919"
                    target="_blank"
                    rel="noopener noreferrer"
                    className="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md transition flex items-center justify-center gap-2"
                  >
                    <PhoneCall className="w-3.5 h-3.5" />
                    <span>Konfirmasi via WhatsApp Panitia</span>
                  </a>
                </div>
              </div>
            )}
          </div>
        )}

        {/* Tab 2: Pilihan Jalur Masuk */}
        {activeTab === 'jalur' && (
          <div className="space-y-3.5 text-xs">
            <div className="p-4 rounded-2xl bg-red-50 border border-red-200">
              <div className="flex items-center gap-2 text-red-700 font-bold mb-1">
                <Award className="w-4 h-4" />
                <span className="text-sm">1. Jalur Prestasi Rapor Unggulan</span>
              </div>
              <p className="text-gray-600 leading-relaxed">
                Bebas tes potensi akademik bagi siswa dengan nilai rata-rata Rapor SMP Semester 1-5 minimal 80.00 untuk mata pelajaran Matematika, IPA, dan Bahasa Inggris.
              </p>
            </div>

            <div className="p-4 rounded-2xl bg-gray-50 border border-gray-200">
              <div className="flex items-center gap-2 text-gray-900 font-bold mb-1">
                <Sparkles className="w-4 h-4 text-red-600" />
                <span className="text-sm">2. Jalur Minat &amp; Portofolio Digital</span>
              </div>
              <p className="text-gray-600 leading-relaxed">
                Bagi siswa yang memiliki sertifikat kejuaraan IT / coding / robotika, portofolio desain UI/UX, website, atau piagam lomba tingkat kabupaten/kota/provinsi.
              </p>
            </div>

            <div className="p-4 rounded-2xl bg-gray-50 border border-gray-200">
              <div className="flex items-center gap-2 text-gray-900 font-bold mb-1">
                <Calendar className="w-4 h-4 text-red-600" />
                <span className="text-sm">3. Jalur Reguler Computer Based Test (CBT)</span>
              </div>
              <p className="text-gray-600 leading-relaxed">
                Jalur umum melalui tes potensi akademik berbasis komputer (CBT) dan wawancara minat bakat daring/luring di kampus SMK Telkom Sidoarjo.
              </p>
            </div>

            <div className="p-4 rounded-2xl bg-gray-50 border border-gray-200">
              <div className="flex items-center gap-2 text-gray-900 font-bold mb-1">
                <FileText className="w-4 h-4 text-red-600" />
                <span className="text-sm">4. Beasiswa Yayasan Pendidikan Telkom</span>
              </div>
              <p className="text-gray-600 leading-relaxed">
                Potongan biaya pendidikan (UP3 &amp; SPP) hingga 100% bagi siswa berprestasi nasional atau putra/putri keluarga besar Telkom Group yang memenuhi kualifikasi.
              </p>
            </div>
          </div>
        )}

        {/* Tab 3: Persyaratan & Alur */}
        {activeTab === 'syarat' && (
          <div className="space-y-4 text-xs">
            <div className="bg-gray-50 p-4 rounded-2xl border border-gray-200">
              <h5 className="font-bold text-gray-900 text-sm mb-2">Dokumen Persyaratan PPDB:</h5>
              <ul className="space-y-1.5 text-gray-600">
                <li className="flex items-center gap-2">
                  <CheckCircle2 className="w-3.5 h-3.5 text-red-600" />
                  Fotokopi / Scan Rapor SMP/MTs (Semester 1 s.d. 5)
                </li>
                <li className="flex items-center gap-2">
                  <CheckCircle2 className="w-3.5 h-3.5 text-red-600" />
                  Fotokopi Kartu Keluarga (KK) &amp; Akta Kelahiran
                </li>
                <li className="flex items-center gap-2">
                  <CheckCircle2 className="w-3.5 h-3.5 text-red-600" />
                  Pas Foto Berwarna Terbaru 3x4 (Background Merah/Biru)
                </li>
                <li className="flex items-center gap-2">
                  <CheckCircle2 className="w-3.5 h-3.5 text-red-600" />
                  Surat Keterangan Bebas Buta Warna (Pemeriksaan Dokter/Puskesmas)
                </li>
              </ul>
            </div>

            <div className="bg-red-50 p-4 rounded-2xl border border-red-100">
              <h5 className="font-bold text-red-900 text-sm mb-2">Jadwal Gelombang Pendaftaran:</h5>
              <div className="space-y-2 text-red-800">
                <div className="flex justify-between">
                  <span className="font-semibold">• Gelombang Early Bird:</span>
                  <span>Januari – Maret 2026 (Diskon Khusus UP3)</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-semibold">• Gelombang 1 Reguler:</span>
                  <span>April – Mei 2026</span>
                </div>
                <div className="flex justify-between">
                  <span className="font-semibold">• Gelombang 2 (Jika Kuota Tersisa):</span>
                  <span>Juni – Juli 2026</span>
                </div>
              </div>
            </div>
          </div>
        )}

      </div>
    </div>
  );
}
