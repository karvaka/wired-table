<div class="flex items-center justify-end space-x-3">
    @foreach($actions->where('inline', '=', true) as $action)
        <button wire:click="runInlineAction('{{ $model->getRouteKey() }}', '{{ addslashes($action->getName()) }}')" class="cursor-pointer {{ $action->destructive ? 'text-red-500 hover:text-red-600' : 'text-gray-400 hover:text-gray-500'}}">
            <x-dynamic-component :component="$action->inlineComponent" class="w-5 h-5" />
        </button>
    @endforeach
</div>
