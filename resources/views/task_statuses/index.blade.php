<x-app-layout>
  <div class="flex items-center justify-between">
    <h1 class="font-extrabold text-2xl text-gray-900 dark:text-gray-100">{{ __('Task Statuses') }}</h1>
    <a href="{{ route('task_statuses.create') }}" class="px-4 py-2 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
      {{ __('New status') }}
    </a>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full mt-2 border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg overflow-hidden" data-test="statuses">
      <thead class="bg-gray-50 dark:bg-gray-900">
        <tr>
          <th class="px-4 py-2 text-left border-b border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300">ID</th>
          <th class="px-4 py-2 text-left border-b border-gray-200 dark:border-gray-700 whitespace-nowrap text-gray-700 dark:text-gray-300">{{ __('Name') }}</th>
          <th class="px-4 py-2 text-left border-b border-gray-200 dark:border-gray-700 whitespace-nowrap text-gray-700 dark:text-gray-300">{{ __('Created at') }}</th>
          <th class="px-4 py-2 text-left border-b border-gray-200 dark:border-gray-700 whitespace-nowrap text-gray-700 dark:text-gray-300">{{ __('Actions') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($taskStatuses as $status)
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
          <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 text-gray-900 dark:text-gray-100">{{ $status->id }}</td>
          <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 text-gray-900 dark:text-gray-100">{{ $status->name }}</td>
          <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400">{{ $status->created_at->format('d.m.Y H:i') }}</td>
          <td class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 flex gap-2">
            <a href="{{ route('task_statuses.edit', $status) }}" class="px-3 py-1 rounded bg-blue-600 text-white hover:bg-blue-700 transition">
              {{ __('Edit') }}
            </a>
            <form method="POST" action="{{ route('task_statuses.destroy', $status) }}">
                @method('DELETE')
                @csrf
                <button type="submit" class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700 transition">
                {{ __('Delete') }}
              </button>
            </form>
          </td>
        </tr>
        @endforeach 
    </tbody>
    </table>
  </div>
</x-app-layout>