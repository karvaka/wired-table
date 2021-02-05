<div>
    @if($enableSearch)
        <div>
            <input type="search"
                   wire:model.debounce.{{ $searchDebounce }}ms="search"
                   placeholder="{{ __('Search...') }}">
        </div>
    @endif
    @if($models->isNotEmpty())
        <table>
            <thead>
                <tr>
                    @foreach($columns as $column)
                        <td>{{ $column->attribute }}</td>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($models as $model)
                    <tr>
                        @foreach($columns as $column)
                            <td>{{ $model->getAttribute($column->attribute) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($enablePagination && $models->hasPages())
            <div>
                {{ $models->links() }}
            </div>
        @endif
    @else
        <div>{{ 'No results.' }}</div>
    @endif
</div>
