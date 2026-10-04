<div id="skomda-chat-widget" class="skomda-chat" data-ask-url="{{ route('chatbot.ask') }}">
    {{-- Tombol bubble pojok kanan bawah --}}
    <button id="skomda-chat-toggle" type="button" class="skomda-chat__bubble" aria-label="Buka Skomda AI">
        <div class="skomda-chat__bubble-icon">
            <i data-lucide="bot" class="w-7 h-7 text-telkom-700"></i>
        </div>
    </button>

    {{-- Panel chat (hidden sampai dibuka) --}}
    <div id="skomda-chat-panel" class="skomda-chat__panel" hidden>
        <div class="skomda-chat__header">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center">
                    <i data-lucide="bot" class="w-5 h-5 text-telkom-700"></i>
                </div>
                <div>
                    <p class="font-extrabold text-gray-900 leading-tight">Skomda AI</p>
                    <p class="text-xs text-gray-500">Tanya seputar SMK Telkom Sidoarjo</p>
                </div>
            </div>
            <button id="skomda-chat-close" type="button" aria-label="Tutup">
                <i data-lucide="x" class="w-5 h-5 text-gray-500"></i>
            </button>
        </div>

        <div id="skomda-chat-messages" class="skomda-chat__messages">
            {{-- pesan awal bot, diisi JS saat pertama dibuka --}}
        </div>

        <form id="skomda-chat-form" class="skomda-chat__form">
            <input
                id="skomda-chat-input"
                type="text"
                placeholder="Tanya soal jurusan, PPDB, fasilitas..."
                autocomplete="off"
                maxlength="500"
            />
            <button type="submit" aria-label="Kirim">
                <i data-lucide="send" class="w-4 h-4"></i>
            </button>
        </form>
    </div>
</div>
