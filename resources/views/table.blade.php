<div>
    @if($enableSearch || $enableActions || $enableFilters)
        <div class="flex items-center justify-between mb-4">
            @includeWhen($enableSearch, 'wired-table::search')
            @includeWhen($enableActions && $actions->isNotEmpty(), 'wired-table::actions-batch')
            @includeWhen($enableFilters && $filters->isNotEmpty(), 'wired-table::filters')
        </div>
    @endif
    <div class="relative shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        @if($models->isNotEmpty())
            <div class="overflow-auto">
                <table class="table-auto min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            @if($enableActions)
                                <th scope="col" class="px-6 py-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:click="toggleSelectAll" {{ $this->isSelectedAll() ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    </label>
                                </th>
                            @endif
                            @foreach($columns as $column)
                                <th scope="col" class="px-6 py-3 text-{{ $column->alignment }} text-sm font-medium text-gray-500 tracking-wider">
                                    @if($enableSorting && $column->sortable)
                                        <span class="inline-flex items-center cursor-pointer space-x-1" wire:click="sortBy('{{ $column->attribute }}')">
                                            <span>{{ $column->label }}</span>
                                            @if($this->sortAttribute() === $column->attribute)
                                                @if($this->sortDirection() === 'asc')
                                                    <x-heroicon-o-chevron-up class="w-3 h-3" />
                                                @else
                                                    <x-heroicon-o-chevron-down class="w-3 h-3" />
                                                @endif
                                            @endif
                                        </span>
                                    @else
                                        {{ $column->label }}
                                    @endif
                                </th>
                            @endforeach
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">{{ __('Actions') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($models as $model)
                            <tr>
                                @if($enableActions)
                                    <th scope="col" class="px-6 py-4">
                                        <label class="flex items-center">
                                            <input type="checkbox" value="{{ $model->getRouteKey() }}" wire:model="selectedModels" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        </label>
                                    </th>
                                @endif
                                @foreach($columns as $column)
                                    <td class="px-6 py-4 text-{{ $column->alignment }} text-sm font-medium whitespace-nowrap">@include('wired-table::columns.' . $column->component, ['formatter' => $column->makeFormatter($model)])</td>
                                @endforeach
                                <td class="px-6 py-4">
                                    @includeWhen($actions->where('inline', '=', true)->isNotEmpty(), 'wired-table::actions-inline')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($enablePagination && $models->hasPages())
                <div class="flex items-center justify-between bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    @includeWhen($enablePerPage, 'wired-table::per-page-select')
                    <div class="sm:w-full">
                        {{ $models->links() }}
                    </div>
                </div>
            @endif
        @else
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6 sm:rounded-lg">
                <p class="text-sm text-gray-700 leading-5">
                    {{ __('No results.') }}
                </p>
            </div>
        @endif
        <div class="absolute top-0 right-0 inline-flex items-center p-3 space-x-3">
            <x-heroicon-o-status-offline wire:offline="" class="h-5 w-5 text-red-500 animate-pulse" />
            <x-heroicon-o-refresh wire:loading.delay="100" class="h-5 w-5 text-gray-400 animate-spin" />
        </div>
    </div>
    @includeWhen($enableActions && $actions->isNotEmpty(), 'wired-table::actions-modals')
</div>
