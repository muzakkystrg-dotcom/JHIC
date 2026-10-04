// =====================================================================
// resources/js/app.js
// Semua aset pihak ketiga (Lucide, AOS, Chart.js) kini dibundel lewat Vite
// sehingga tidak lagi bergantung pada CDN eksternal yang memblokir render.
// =====================================================================
import { createIcons } from 'lucide';
import AOS from 'aos';
import 'aos/dist/aos.css';

// Hanya ikon yang benar-benar dipakai di view (mengurangi ukuran bundle).
import {
    ArrowRight, ArrowUpRight, Award, BookOpen, Bot, Briefcase, Calendar, Check,
    CheckSquare, ChevronDown, ChevronLeft, ChevronRight, Clock, Code2, Compass,
    Cpu, Download, Eye, FileText, FolderGit2, FolderOpen, GraduationCap, Image,
    Info, Instagram, Laptop, Layers, Link, Linkedin, ListChecks, Mail, MapPin,
    Menu, Monitor, Network, Newspaper, Phone, Plus, School, Search, SearchX, Send,
    ShieldCheck, Sparkles, ThumbsUp, Trophy, User, UserCheck, Users, UserX, Wallet, X,
} from 'lucide';

// Lucide mencari ikon berdasarkan PascalCase dari data-lucide,
// (mis. data-lucide="arrow-right" -> key "ArrowRight"), jadi key harus PascalCase.
const ICONS = {
    ArrowRight, ArrowUpRight, Award, BookOpen, Bot, Briefcase, Calendar, Check,
    CheckSquare, ChevronDown, ChevronLeft, ChevronRight, Clock, Code2, Compass,
    Cpu, Download, Eye, FileText, FolderGit2, FolderOpen, GraduationCap, Image,
    Info, Instagram, Laptop, Layers, Link, Linkedin, ListChecks, Mail, MapPin,
    Menu, Monitor, Network, Newspaper, Phone, Plus, School, Search, SearchX, Send,
    ShieldCheck, Sparkles, ThumbsUp, Trophy, User, UserCheck, Users, UserX, Wallet, X,
};

// Kompatibilitas: skrip lama (public/assets/js/ppdb.js, jurufind.js)
// masih memanggil window.lucide.createIcons().
window.lucide = {
    createIcons: () => createIcons({ icons: ICONS }),
};

// AOS diekspos agar inisialisasi inline di layout tetap bekerja.
window.AOS = AOS;

// Chart.js dimuat saat dibutuhkan saja (code-splitting) -> hanya halaman
// yang memanggilnya (prestasi) yang mengunduh tambahan ini.
window.jhicLoadChart = () => import('chart.js/auto').then((m) => m.default);

// ---------------------------------------------------------------------
// Deteksi preferensi pengguna & viewport (dipakai untuk keputusan responsif)
// ---------------------------------------------------------------------
// Pengguna yang mematikan animasi (motion sickness / hemat daya) tidak boleh
// dipaksa melihat animasi scroll AOS maupun scroll halus.
const prefersReducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

// Cocokkan breakpoint Tailwind (md = 768px) agar perilaku JS konsisten
// dengan class responsif di Blade.
const mobileQuery = window.matchMedia('(max-width: 767px)');

function renderIcons() {
    createIcons({ icons: ICONS });
}

// Aturan aktif/nonaktif AOS.
// - Layar HP kecil: dimatikan (performa & tidak mengganggu saat scroll).
// - Mode reduced-motion: dimatikan total.
function shouldDisableAos() {
    return prefersReducedMotionQuery.matches || mobileQuery.matches;
}

function initAos() {
    AOS.init({
        duration: 750,
        once: true,
        offset: 30,
        // AOS menerima fungsi; nilai dievaluasi saat init & refresh.
        disable: shouldDisableAos(),
    });
}

document.addEventListener('DOMContentLoaded', () => {
    // 1. Ikon Lucide
    renderIcons();
    window.jhicRenderIcons = renderIcons;

    // 2. Animasi AOS (responsif: off di HP & saat reduced-motion)
    initAos();

    // 3. Realtime Search / Filter untuk Mitra Industri
    const searchInput = document.getElementById('searchInput');
    const partnerGrid = document.getElementById('partnerGrid');

    if (searchInput && partnerGrid) {
        const cards = partnerGrid.querySelectorAll('.group');

        searchInput.addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();

            cards.forEach((card) => {
                const textContent = card.innerText.toLowerCase();

                if (textContent.includes(searchTerm)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // 4. Smooth Scroll untuk tombol navigasi internal.
    //    Offset header fixed ditangani lewat `scroll-padding-top` di app.css,
    //    jadi scrollIntoView otomatis berhenti di posisi yang benar.
    //    Saat reduced-motion aktif, lompat langsung tanpa animasi.
    const smoothLinks = document.querySelectorAll('a[href^="#"]');
    for (let link of smoothLinks) {
        link.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');

            if (targetId.startsWith('#') && targetId.length > 1) {
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: prefersReducedMotionQuery.matches ? 'auto' : 'smooth',
                        block: 'start',
                    });
                }
            }
        });
    }

    // 5. Responsif saat orientasi/ukuran viewport berubah
    //    (mis. HP di-rotate atau jendela desktop di-resize melewati
    //    breakpoint 768px). AOS di-refresh agar status disable dihitung ulang.
    let resizeTimer = null;
    const handleViewportChange = () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            initAos();
            AOS.refreshHard();
        }, 200);
    };

    window.addEventListener('resize', handleViewportChange);
    window.addEventListener('orientationchange', handleViewportChange);
});
