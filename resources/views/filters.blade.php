<div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        <button class="inline-flex items-center space-x-2 px-4 py-2 bg-white border-0 rounded-lg shadow font-semibold text-gray-400 text-sm focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-25 transition ease-in-out duration-150">
            <x-heroicon-o-filter class="w-5 h-5" />
            @if(count($filter))
                <span class="font-semibold">{{ count($filter) }}</span>
            @endif
            <div class="ml-1">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </button>
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute z-50 mt-2 w-72 rounded-md shadow-lg origin-top-right right-0"
         style="display: none;">
        <div class="rounded-md shadow-xs py-1 bg-white">
            <div class="p-4">
                @foreach($filters as $filter)
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Account') }}
                    </div>

                    <x-dynamic-component :components="'wired-table.filters.' . $filter->component" />
                @endforeach
            </div>
        </div>
    </div>
</div>
