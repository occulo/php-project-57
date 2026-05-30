<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Tasks') }}
      </h2>
      @auth
      <a href="{{ route('tasks.create') }}" class="px-4 py-2 rounded-md text-xs font-semibold uppercase tracking-widest text-indigo-600 hover:text-white border border-indigo-700 hover:bg-indigo-800 transition">
        {{ __('Create task') }}
      </a>
      @endauth
    </div>
  </x-slot>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
      <table class="min-w-full table-fixed" data-test="tasks">
        <thead class="bg-gray-100 dark:bg-gray-900">
          <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <th class="w-16 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">ID</th>
            <th class="w-48 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">{{ __('Title') }}</th>
            <th class="w-48 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">{{ __('Status') }}</th>
            <th class="w-40 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">{{ __('Created by') }}</th>
            <th class="w-40 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">{{ __('Created at') }}</th>
            @auth
            <th class="w-64 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">{{ __('Actions') }}</th>
            @endauth
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
          @foreach($tasks as $task)
          <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <td class="px-6 py-4 text-center text-gray-900 dark:text-gray-100">{{ $task->id }}</td>
            <td class="px-6 py-4 text-left whitespace-normal break-words text-gray-900 dark:text-gray-100">{{ $task->name }}</td>
            <td class="px-6 py-4 text-left whitespace-normal break-words text-gray-900 dark:text-gray-100">{{ $task->status->name }}</td>
            <td class="px-6 py-4 text-left whitespace-normal break-words text-gray-900 dark:text-gray-100">{{ $task->created_by_id }}</td>
            <td class="px-6 py-4 text-center text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $task->created_at->format('d.m.Y H:i') }}</td>
            @auth
            <td class="px-6 py-4 text-center">
              <div class="flex justify-center gap-3">
                <a href="{{ route('tasks.show', $task) }}" class="px-4 py-2 rounded-md border border-gray-400 dark:border-gray-600 text-gray-800 dark:text-gray-300 text-xs font-semibold uppercase tracking-widest hover:text-gray-900 dark:hover:text-white hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                  {{ __('View') }}
                </a>
                <a href="{{ route('tasks.edit', $task) }}" class="px-4 py-2 rounded-md text-xs font-semibold uppercase tracking-widest text-indigo-600 hover:text-white border border-indigo-700 hover:bg-indigo-800 transition">
                  {{ __('Edit') }}
                </a>
                <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-md text-xs font-semibold uppercase tracking-widest text-red-600 border border-red-700 hover:bg-red-700 hover:text-white transition">
                    {{ __('Delete') }}
                  </button>
                </form>
              </div>
            </td>
            @endauth
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>