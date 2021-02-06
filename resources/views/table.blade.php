<div>
    @if($enableSearch)
        <div class="relative md:w-1/3">
            <input type="search"
                   wire:model.debounce.{{ $searchDebounce }}ms="search"
                   placeholder="{{ __('Search...') }}">
        </div>
    @endif
    <div class="shadow border-b border-gray-200 sm:rounded-lg">
        @if($models->isNotEmpty())
            <div class="overflow-auto">
                <table class="table-auto min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            @foreach($columns as $column)
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $column->attribute }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($models as $model)
                            <tr>
                                @foreach($columns as $column)
                                    <td class="px-6 py-4 whitespace-nowrap">@include('wired-table::columns.' . $column->component)</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($enablePagination && $models->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $models->links() }}
                </div>
            @endif
        @else
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ 'No results.' }}
            </div>
        @endif
    </div>
</div>
