@props(['id', 'action', 'entity'])

<x-danger-button x-data x-on:click.prevent="$dispatch('open-modal', '{{ $id }}')">
    {{ __('app.buttons.common.delete') }}
</x-danger-button>
<x-modal :name="$id" focusable>
    {{ html()->form('DELETE', $action)->class('p-6 text-left')->open() }}
    @csrf
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __("app.pages.$entity.destroy.title") }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("app.pages.$entity.destroy.subtitle") }}
        </p>
        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('app.buttons.common.back') }}
            </x-secondary-button>
            <x-danger-button class="ms-3">
                {{ __('app.buttons.common.continue') }}
            </x-danger-button>
        </div>
    {{ html()->form()->close() }}
</x-modal>
