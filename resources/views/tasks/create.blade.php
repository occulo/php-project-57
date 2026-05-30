<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('New task') }}
      </h2>
      <a href="{{ route('tasks.index') }}" class="px-4 py-2 rounded-md border border-gray-400 dark:border-gray-600 text-gray-800 dark:text-gray-300 text-xs font-semibold uppercase tracking-widest hover:text-gray-900 dark:hover:text-white hover:bg-gray-200 dark:hover:bg-gray-600 transition">
        {{ __('Back') }}
      </a>
    </div>
  </x-slot>

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="p-6 overflow-hidden rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
      <form action="{{ route('tasks.store') }}" method="post">
        @csrf
        <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
          <div class="sm:col-span-2">
            <label for="name" class="block mb-2 font-medium text-gray-700 dark:text-gray-300">
              {{ __('Title') }}
            </label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="p-4 text-gray-700 dark:text-gray-300 rounded-lg bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 block w-full placeholder-gray-400 dark:placeholder-gray-500 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 dark:text-white transition" placeholder="{{ __('What needs to be done?') }}" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
          </div>
          <div class="w-full">
            <label for="status_id" class="block mb-2 font-medium text-gray-700 dark:text-gray-300">
              {{ __('Select status') }}
            </label>
            <select id="status_id" name="status_id" class="p-4 text-gray-700 dark:text-gray-300 rounded-lg bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 block w-full focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 dark:text-white transition" >
              @foreach ($taskStatuses as $status)
              <option value="{{ $status->id }}" @selected(old('status_id') == $status->id)>
                {{ $status->name }}
              </option>
              @endforeach
            </select>
            <x-input-error :messages="$errors->get('status_id')" class="mt-2" />
          </div>
          <div class="w-full">
            <label for="assigned_to_id" class="block mb-2 font-medium text-gray-700 dark:text-gray-300">
              {{ __('Assign to user') }}
            </label>
            <select id="assigned_to_id" name="assigned_to_id" class="p-4 text-gray-700 dark:text-gray-300 rounded-lg bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 block w-full focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 dark:text-white transition" >
              <option value="">{{ __('Unassigned') }}</option>
              @foreach ($users as $user)
              <option value="{{ $user->id }}" @selected(old('assigned_to_id') == $user->id)>
                {{ $user->name }}
              </option>
              @endforeach
            </select>
            <x-input-error :messages="$errors->get('assigned_to_id')" class="mt-2" />
          </div>
          <div class="sm:col-span-2">
            <label for="description" class="block mb-2 font-medium text-gray-700 dark:text-gray-300">
              {{ __('Description') }}
            </label>
            <textarea id="description" name="description" rows="6" class="p-4 text-gray-700 dark:text-gray-300 rounded-lg bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 block w-full placeholder-gray-400 dark:placeholder-gray-500 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 dark:text-white transition" placeholder="{{ __('Provide additional context, steps, or notes for completing this task.') }}">{{ old('description') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
          </div>
        </div>
        <button type="submit" class="px-4 py-2 rounded-md text-xs font-semibold uppercase tracking-widest text-indigo-600 hover:text-white border border-indigo-700 hover:bg-indigo-800 transition">
          {{ __('Create task') }}
        </button>
      </form>
    </div>
  </div>
</x-app-layout>