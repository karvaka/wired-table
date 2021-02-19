<select class="text-sm font-medium border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full" wire:model="filter.{{ $filter->getAttribute() }}">
    <option value=""></option>
    @foreach($filter->getOptions() as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>
