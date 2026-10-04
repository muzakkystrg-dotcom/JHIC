import '../css/ppdb.css';

/* ==========================================================
   PPDB 2026/2027 - SMK Telkom Sidoarjo
   Script khusus halaman PPDB (dipisah dari ppdb.html)
   ========================================================== */

// Render semua ikon Lucide (<i data-lucide="...">) setelah DOM siap
document.addEventListener('DOMContentLoaded', function () {
  if (window.lucide) lucide.createIcons();
});

// Buka / tutup jawaban FAQ
// Dijalankan sebagai ES module (di-bundle Vite), jadi fungsi ini TIDAK lagi
// otomatis global seperti versi <script> lama. Markup tombol FAQ memanggil
// `onclick="toggleFaq(this)"`, sehingga harus diekspos manual ke window.
function toggleFaq(button) {
  var answer = button.nextElementSibling;              // div.faq-answer
  var icon = button.querySelector('svg');              // ikon chevron hasil render lucide

  answer.classList.toggle('hidden');
  var isOpen = !answer.classList.contains('hidden');
  if (icon) icon.style.transform = isOpen ? 'rotate(90deg)' : '';
}

window.toggleFaq = toggleFaq;
