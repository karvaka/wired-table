<div class="relative md:w-1/3">
    <input type="search"
           wire:model.debounce.{{ $searchDebounce }}ms="search"
           class="w-full pl-10 pr-4 py-2 border-0 rounded-lg shadow text-gray-600 text-sm font-medium focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
           placeholder="{{ __('Search...') }}">
    <div class="absolute top-0 left-0 inline-flex items-center p-2">
        <x-heroicon-o-search class="w-5 h-5 text-gray-400" />
    </div>
</div>
