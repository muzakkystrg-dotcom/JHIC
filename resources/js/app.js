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

function renderIcons() {
    createIcons({ icons: ICONS });
}

function initAos() {
    AOS.init({
        duration: 750,
        once: true,
        offset: 30,
        disable: 'mobile',
    });
}

document.addEventListener('DOMContentLoaded', () => {
    // 1. Ikon Lucide
    renderIcons();
    window.jhicRenderIcons = renderIcons;

    // 2. Animasi AOS
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

    // 4. Smooth Scroll untuk tombol navigasi internal
    const smoothLinks = document.querySelectorAll('a[href^="#"]');
    for (let link of smoothLinks) {
        link.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');

            if (targetId.startsWith('#') && targetId.length > 1) {
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start',
                    });
                }
            }
        });
    }
});
