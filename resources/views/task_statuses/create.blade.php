<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Status Management') }}
      </h2>
      <x-link-button.secondary href="{{ route('task_statuses.index') }}">
        {{ __('Back') }}
      </x-link-button.secondary>
    </div>
  </x-slot>

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Create status') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Add a new status for tasks.') }}
        </p>
    </header>
      <form action="{{ route('task_statuses.store') }}" method="post">
        @csrf
        <div class="mt-6 space-y-6">
          <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                :value="old('name')"
                class="w-full mt-2"
                placeholder="{{ __('e.g. In Progress, Completed') }}"
                required
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
          </div>
          <x-primary-button>
            {{ __('Save') }}
          </x-primary-button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>