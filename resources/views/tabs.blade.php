<div class="flex justify-between h-12 bg-white px-4">
    <div class="flex">
        <div class="space-x-8 flex -my-px">
            @foreach($tabs as $tab)
                <x-jet-nav-link wire:click="gotoTab('{{ $tab->getAttribute() }}')"
                                :active="$this->isTabActive($tab)"
                                class="cursor-pointer">
                    {{ $tab->getLabel() }}
                </x-jet-nav-link>
            @endforeach
        </div>
    </div>
</div>
