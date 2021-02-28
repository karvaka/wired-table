<div>
    @if(!is_null($this->batchActionBeingPerformed()))
        <x-jet-confirmation-modal wire:model="confirmingBatchAction">
            <x-slot name="title">
                {{ __($this->batchActionBeingPerformed()->getLabel()) }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to perform this action?') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingBatchAction')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="performBatchAction" wire:loading.attr="disabled">
                    {{ __('Run') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>
    @endif

    @if(!is_null($this->inlineActionBeingPerformed()))
        <x-jet-confirmation-modal wire:model="confirmingInlineAction">
            <x-slot name="title">
                {{ __($this->inlineActionBeingPerformed()->getLabel()) }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to perform this action?') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingInlineAction')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-dynamic-component :component="$this->inlineActionBeingPerformed()->isDestructive() ? 'jet-danger-button' : 'jet-button'" class="ml-2" wire:click="performInlineAction" wire:loading.attr="disabled">
                    {{ __('Run') }}
                </x-dynamic-component>
            </x-slot>
        </x-jet-confirmation-modal>
    @endif
</div>
