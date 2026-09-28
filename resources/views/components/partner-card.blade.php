@props(['partner'])

<div class="border-2 border-dashed border-gray-300 rounded-3xl p-6 bg-white relative hover:shadow-lg hover:border-red-700 hover:-translate-y-1 transition-all duration-300 flex flex-col h-full group">
    
    <!-- Logo & Link -->
    <div class="flex items-start justify-between mb-4">
        <div class="w-32 h-12 flex items-center justify-start">
            <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="max-h-full max-w-full object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
        </div>
    </div>

    <!-- Title & External Link -->
    <a href="{{ $partner['website'] }}" target="_blank" class="flex items-center gap-2 group-hover:text-red-700 transition-colors">
        <h3 class="font-bold text-md text-gray-900 group-hover:text-red-700">{{ $partner['name'] }}</h3>
        <i data-lucide="external-link" class="w-4 h-4 text-red-700"></i>
    </a>

    <!-- Location -->
    <div class="flex items-start gap-1 mt-2 text-xs text-gray-500">
        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-gray-400 mt-0.5 flex-shrink-0"></i>
        <span class="leading-tight">{{ $partner['location'] }}</span>
    </div>

    <!-- Description -->
    <p class="text-sm text-gray-600 mt-4 line-clamp-4 flex-grow leading-relaxed">
        {{ $partner['description'] }}
    </p>

    <!-- Button -->
    <div class="mt-6 flex justify-end">
        <a href="{{ $partner['website'] }}" class="bg-red-700 text-white text-xs px-4 py-1.5 rounded-full hover:bg-red-800 transition-colors flex items-center gap-1.5 shadow-sm font-medium">
            Selengkapnya 
            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
        </a>
    </div>
</div>