<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('app.task_management') }}
      </h2>
      <x-link-button.secondary href="{{ route('tasks.index') }}">
        {{ __('app.buttons.common.back') }}
      </x-link-button.secondary>
    </div>
  </x-slot>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
      <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
          {{ __('app.pages.tasks.edit.title') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
          {{ __('app.pages.tasks.edit.subtitle') }}
        </p>
      </header>
      {{ html()->form('PUT', route('tasks.update', $task))->open() }}
        <div class="mt-6 space-y-6">
          <div>
            <x-input-label for="name" :value="__('app.fields.title')" />
            <x-text-input id="name" name="name" type="text" :value="old('name', $task->name)" class="w-full mt-1" placeholder="{{ __('app.forms.tasks.title_placeholder') }}" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
          </div>
          <div>
            <x-input-label for="status_id" :value="__('app.fields.status')" />
            <x-select-input id="status_id" name="status_id" class="w-full mt-1"> 
              @foreach ($taskStatuses as $status)
              <option value="{{ $status->id }}" @selected(old('status_id', $task->status_id) == $status->id) >
                {{ $status->name }}
              </option>
              @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('status_id')" class="mt-2" />
          </div>
          <div>
            <x-input-label for="labels" :value="__('app.fields.labels')" />
            <div class="w-full max-h-16 mt-1 overflow-y-auto">
              <x-checkbox-group :items="$labels" :selected="old('labels', $task->labels->pluck('id')->toArray())" name="labels" class="cursor-pointer" />
            </div>
            <x-input-error :messages="$errors->get('labels')" class="mt-2" />
          </div>
          <div>
            <x-input-label for="assigned_to_id" :value="__('app.fields.assigned_to_id')" />
            <x-select-input id="assigned_to_id" name="assigned_to_id" class="w-full mt-1">
              <option value="">{{ __('app.fields.empty.assignee') }}</option>
              @foreach ($users as $user)
              <option value="{{ $user->id }}" @selected(old('assigned_to_id', $task->assigned_to_id) == $user->id) >
                {{ $user->name }}
              </option>
              @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('assigned_to_id')" class="mt-2" />
          </div>
          <div>
            <x-input-label for="description" :value="__('app.fields.description')" />
            <x-textarea-input id="description" name="description" class="w-full mt-1" placeholder="{{ __('app.forms.tasks.description_placeholder') }}">{{ old('description', $task->description) }}</x-textarea-input>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
          </div>
          <x-primary-button>
            {{ __('app.buttons.common.save') }}
          </x-primary-button>
        </div>
      {{ html()->form()->close() }}
    </div>
  </div>
</x-app-layout>
