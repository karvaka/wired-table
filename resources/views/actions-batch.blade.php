<div class="flex items-center space-x-2 sm:mr-6">
    <select wire:model="batchAction"
            class="text-sm font-medium rounded-md border-0 shadow focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <option value="">{{ __('Select action') }}</option>
        @foreach($actions->filter(fn ($action) => $action->isBatch() && $action->canPerformBatch(get_class($this->getQuery()->getModel()))) as $action)
            <option value="{{ $action->getName() }}">{{ __($action->getTitle()) }}</option>
        @endforeach
    </select>
    <button type="button" wire:click="runBatchAction" class="inline-flex items-center px-4 py-2 bg-gray-50 shadow rounded-md font-semibold text-gray-400 hover:text-gray-500 focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-25 transition ease-in-out duration-150">
        <x-heroicon-o-chevron-right class="w-4 h-4" />
    </button>
</div>
