<div class="flex items-center justify-end space-x-3">
    @foreach($links->filter(fn ($link) => $link->authorizedToSee($model)) as $link)
        <a href="{{ $link->getLinkFor($model) }}" @if($link->getEvent())wire:click.{{ $link->isDefaultPrevented() ? 'prevent' : '' }}="$emitUp('{{ $link->getEvent() }}', {{ $model->getRouteKey() }})"@endif class="text-gray-400 hover:text-gray-500">
            <x-dynamic-component :component="$link->getComponent()" class="w-5 h-5" />
        </a>
    @endforeach
    @foreach($actions->filter(fn ($action) => $action->isInline() && $action->canPerform($model) && $action->authorizedToSee($model)) as $action)
        <button wire:click="runInlineAction('{{ $model->getRouteKey() }}', '{{ addslashes($action->getName()) }}')" title="{{ $action->getLabel() }}" class="cursor-pointer {{ $action->isDestructive() ? 'text-red-500 hover:text-red-600' : 'text-gray-400 hover:text-gray-500'}}">
            @if($action->getComponent())
                <x-dynamic-component :component="$action->getComponent()" class="w-5 h-5" />
            @else
                {{ $action->getLabel() }}
            @endif
        </button>
    @endforeach
</div>
