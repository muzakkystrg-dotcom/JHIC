@props(['name' => 'Kelompok Mata Pelajaran Nasional'])

<div class="border border-dashed border-gray-300 rounded-xl p-3 flex items-center gap-3 bg-white hover:border-[#C8102E] transition-all duration-200">
    <div class="w-8 h-8 rounded-lg bg-red-100/80 flex items-center justify-center shrink-0 text-[#C8102E]">
        <i data-lucide="book-open" class="w-4 h-4"></i>
    </div>
    <span class="text-[11px] font-semibold text-gray-800 leading-snug line-clamp-2">
        {{ $name }}
    </span>
</div>