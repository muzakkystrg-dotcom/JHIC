import '../css/chatbot.css';

/* ==========================================================
   SKOMDA AI — widget chatbot global
   Riwayat percakapan cuma di memory (hilang kalau refresh).
   Tidak ada API key di sini — semua panggilan AI lewat /chatbot/ask.
   ========================================================== */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    const widget = document.getElementById('skomda-chat-widget');
    if (!widget) return;

    const toggleBtn = document.getElementById('skomda-chat-toggle');
    const closeBtn = document.getElementById('skomda-chat-close');
    const panel = document.getElementById('skomda-chat-panel');
    const messagesEl = document.getElementById('skomda-chat-messages');
    const form = document.getElementById('skomda-chat-form');
    const input = document.getElementById('skomda-chat-input');

    const history = []; // { role: 'user'|'assistant', content: string }
    let sending = false;
    let opened = false;

    function open() {
      panel.hidden = false;
      opened = true;
      if (!history.length) {
        addMessage('assistant', 'Hai! Aku Skomda AI 👋 Mau tanya apa soal SMK Telkom Sidoarjo — jurusan, PPDB, fasilitas, atau yang lain?');
      }
      input.focus();
    }

    function close() {
      panel.hidden = true;
    }

    function scrollToBottom() {
      // rAF memastikan layout bubble baru sudah dihitung sebelum scroll.
      requestAnimationFrame(function () {
        messagesEl.scrollTop = messagesEl.scrollHeight;
      });
    }

    function addMessage(role, content) {
      const bubble = document.createElement('div');
      bubble.className = 'skomda-msg skomda-msg--' + (role === 'user' ? 'user' : 'bot');
      bubble.textContent = content;
      messagesEl.appendChild(bubble);
      scrollToBottom();
    }

    function send(text) {
      if (sending || !text.trim()) return;
      sending = true;

      addMessage('user', text);
      history.push({ role: 'user', content: text });
      input.value = '';

      const typingBubble = document.createElement('div');
      typingBubble.className = 'skomda-msg skomda-msg--bot skomda-msg--typing';
      typingBubble.id = 'skomda-typing';
      typingBubble.textContent = 'Mengetik...';
      messagesEl.appendChild(typingBubble);
      scrollToBottom();

      const meta = document.querySelector('meta[name="csrf-token"]');
      const csrfToken = meta ? meta.getAttribute('content') : '';

      fetch(widget.dataset.askUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, Accept: 'application/json' },
        body: JSON.stringify({ messages: history }),
      })
        .then((res) => res.json())
        .then((data) => {
          document.getElementById('skomda-typing')?.remove();
          const reply = (data && data.reply) || 'Maaf, ada gangguan. Coba lagi ya.';
          addMessage('assistant', reply);
          history.push({ role: 'assistant', content: reply });
        })
        .catch(() => {
          document.getElementById('skomda-typing')?.remove();
          addMessage('assistant', 'Maaf, koneksi ke server gagal. Coba lagi beberapa saat.');
        })
        .finally(() => { sending = false; });
    }

    toggleBtn.addEventListener('click', function () {
      if (opened && !panel.hidden) { close(); } else { open(); }
    });
    closeBtn.addEventListener('click', close);

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      send(input.value);
    });

    // Dipanggil dari tombol "Mulai Bincang Dengan AI!" di ppdb.blade.php
    window.openSkomdaChat = open;

    if (window.lucide) lucide.createIcons();
  });
})();
