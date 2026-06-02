<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('app.status_management') }}
      </h2>
      <x-link-button.secondary href="{{ route('task_statuses.index') }}">
        {{ __('app.buttons.common.back') }}
      </x-link-button.secondary>
    </div>
  </x-slot>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
      <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
          {{ __('app.pages.task_statuses.create.title') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
          {{ __('app.pages.task_statuses.create.subtitle') }}
        </p>
      </header>
      {{ html()->form('POST', route('task_statuses.store'))->open() }}
        <div class="mt-6 space-y-6">
          <div>
            <x-input-label for="name" :value="__('app.fields.name')" />
            <x-text-input id="name" name="name" type="text" :value="old('name')" class="w-full mt-2" placeholder="{{ __('app.forms.task_statuses.name_placeholder') }}" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
          </div>
          {{ html()->button(__('app.buttons.common.create'))->type('submit') }}
        </div>
      {{ html()->form()->close() }}
    </div>
  </div>
</x-app-layout>