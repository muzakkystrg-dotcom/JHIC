@props(['name' => 'Kelompok Mata Pelajaran Nasional'])

<div class="border border-dashed border-gray-300 rounded-xl p-3 sm:p-3.5 flex items-center gap-3 bg-white hover:border-[#C8102E] hover:shadow-sm transition-all duration-200 h-full">
    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg bg-red-100/80 flex items-center justify-center shrink-0 text-[#C8102E]">
        <i data-lucide="book-open" class="w-4 h-4"></i>
    </div>
    <span class="flex-1 min-w-0 text-[11px] sm:text-xs font-semibold text-gray-800 leading-snug line-clamp-2">
        {{ $name }}
    </span>
</div>
