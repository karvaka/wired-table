<div class="flex items-center justify-end space-x-3">
    @foreach($actions->filter(fn ($action) => $action->isInline() && $action->canPerform($model)) as $action)
        <button wire:click="runInlineAction('{{ $model->getRouteKey() }}', '{{ addslashes($action->getName()) }}')" title="{{ $action->getTitle() }}" class="cursor-pointer {{ $action->isDestructive() ? 'text-red-500 hover:text-red-600' : 'text-gray-400 hover:text-gray-500'}}">
            @if($action->getComponent())
                <x-dynamic-component :component="$action->getComponent()" class="w-5 h-5" />
            @else
                {{ $action->getTitle() }}
            @endif
        </button>
    @endforeach
</div>
