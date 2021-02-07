<div>
    @if($enableSearch)
        <div class="relative md:w-1/3 mb-4">
            <input type="search"
                   wire:model.debounce.{{ $searchDebounce }}ms="search"
                   class="w-full pl-10 pr-4 py-2 border-0 rounded-lg shadow text-gray-600 text-sm font-medium focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   placeholder="{{ __('Search...') }}">
            <div class="absolute top-0 left-0 inline-flex items-center p-2">
                <x-wired-table.icons.search class="w-5 h-5 text-gray-400" />
            </div>
        </div>
    @endif
    <div class="relative shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        @if($models->isNotEmpty())
            <div class="overflow-auto">
                <table class="table-auto min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            @foreach($columns as $column)
                                <th scope="col" class="px-6 py-3 text-{{ $column->alignment }} text-sm font-medium text-gray-500 tracking-wider">
                                    {{ $column->label }}
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
                                @foreach($columns as $column)
                                    <td class="px-6 py-4 text-{{ $column->alignment }} text-sm font-medium whitespace-nowrap">@include('wired-table::columns.' . $column->component)</td>
                                @endforeach
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="#" class="cursor-pointer text-gray-400 hover:text-gray-500">
                                            <x-wired-table.icons.eye class="w-5 h-5" />
                                        </a>
                                        <a href="#" class="cursor-pointer text-gray-400 hover:text-gray-500">
                                            <x-wired-table.icons.pencil class="w-5 h-5" />
                                        </a>
                                        <button class="cursor-pointer text-red-500 hover:text-red-600">
                                            <x-wired-table.icons.trash class="w-5 h-5" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($enablePagination && $models->hasPages())
                <div class="flex items-center justify-between bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    <div class="flex items-center justify-between sm:space-x-2 sm:mr-6">
                        <p class="text-sm text-gray-700 leading-5 whitespace-nowrap hidden sm:block">{{ __('Per page') }}</p>
                        <select wire:model="perPage"
                                class="w-20 text-sm font-medium rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @foreach($perPageOptions as $perPageOption)
                                <option value="{{ $perPageOption }}">{{ $perPageOption }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:w-full">
                        {{ $models->links() }}
                    </div>
                </div>
            @endif
        @else
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6 sm:rounded-lg">
                <p class="text-sm text-gray-700 leading-5">
                    {{ 'No results.' }}
                </p>
            </div>
        @endif
        <div class="absolute top-0 right-0 inline-flex items-center p-3 space-x-3">
            <x-wired-table.icons.status-offline wire:offline="" class="h-5 w-5 text-red-500 animate-pulse" />
            <x-wired-table.icons.refresh wire:loading.delay="100" class="h-5 w-5 text-gray-400 animate-spin" />
        </div>
    </div>
</div>
