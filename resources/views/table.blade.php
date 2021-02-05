<div>
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
    @else
        <div>{{ 'No results.' }}</div>
    @endif
</div>
