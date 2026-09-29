/* ==========================================================
   JURUFIND - Tes Minat Bakat (dipisah dari jurufind.html)
   ========================================================== */

// Render semua ikon Lucide setelah DOM siap
document.addEventListener('DOMContentLoaded', function () {
  if (window.lucide) lucide.createIcons();
});

// Tombol "Ke Bagian Tes!" & "Mulai Tes" sudah diarahkan ke route jurufind.test.
// Tombol "Baca Panduan" belum difungsikan — akan diatur manual nanti.
