<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Task Management') }}
      </h2>
      <x-link-button.secondary href="{{ route('tasks.index') }}">
        {{ __('Back') }}
      </x-link-button.secondary>
    </div>
  </x-slot>

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Edit task') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Update the task information, status, and assignment.') }}
        </p>
    </header>
      <form action="{{ route('tasks.update', $task) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="mt-6 space-y-6">
          <div>
            <x-input-label for="name" :value="__('Title')" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                :value="old('name', $task->name)"
                class="w-full mt-1"
                placeholder="{{ __('What needs to be done?') }}"
                required autofocus
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
          </div>
          <div>
            <x-input-label for="status_id" :value="__('Status')" />
            <x-select-input id="status_id" name="status_id" class="w-full mt-1">
              @foreach ($taskStatuses as $status)
              <option
                value="{{ $status->id }}"
                @selected(old('status_id', $task->status_id) == $status->id)
              >
                  {{ $status->name }}
              </option>
              @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('status_id')" class="mt-2" />
          </div>
          <div>
            <x-input-label for="assigned_to_id" :value="__('Assigned to')" />
            <x-select-input id="assigned_to_id" name="assigned_to_id" class="w-full mt-1">
              <option value="">{{ __('Unassigned') }}</option>
              @foreach ($users as $user)
              <option
                value="{{ $user->id }}"
                @selected(old('assigned_to_id', $task->assigned_to_id) == $user->id)
              >
                  {{ $user->name }}
              </option>
              @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('assigned_to_id')" class="mt-2" />
          </div>
          <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea-input
                id="description"
                name="description"
                class="w-full mt-1"
                placeholder="{{ __('Provide additional context, steps, or notes for completing this task.') }}"
            >{{ old('description', $task->description) }}</x-textarea-input>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
          </div>
          <x-primary-button>
            {{ __('Save') }}
          </x-primary-button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>