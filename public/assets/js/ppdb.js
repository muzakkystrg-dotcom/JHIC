/* ==========================================================
   PPDB 2026/2027 - SMK Telkom Sidoarjo
   Script khusus halaman PPDB (dipisah dari ppdb.html)
   ========================================================== */

// Render semua ikon Lucide (<i data-lucide="...">) setelah DOM siap
document.addEventListener('DOMContentLoaded', function () {
  if (window.lucide) lucide.createIcons();
});

// Buka / tutup jawaban FAQ
function toggleFaq(button) {
  var answer = button.nextElementSibling;              // div.faq-answer
  var icon = button.querySelector('svg');              // ikon chevron hasil render lucide

  answer.classList.toggle('hidden');
  var isOpen = !answer.classList.contains('hidden');
  if (icon) icon.style.transform = isOpen ? 'rotate(90deg)' : '';
}
