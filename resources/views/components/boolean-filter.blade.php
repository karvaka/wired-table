<div class="flex flex-col">
    @foreach($filter->getOptions() as $value => $label)
        <label class="flex items-center">
            <input type="checkbox" value="{{ $value  }}" wire:model="filter.{{ $filter->getAttribute() }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <span class="ml-2">{{ $label }}</span>
        </label>
    @endforeach
</div>
