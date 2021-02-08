<div class="flex items-center justify-between sm:space-x-2 sm:mr-6">
    <p class="text-sm text-gray-700 leading-5 whitespace-nowrap hidden sm:block">{{ __('Per page') }}</p>
    <select wire:model="perPage"
            class="w-20 text-sm font-medium rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @foreach($perPageOptions as $perPageOption)
            <option value="{{ $perPageOption }}">{{ $perPageOption }}</option>
        @endforeach
    </select>
</div>
