<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('app.labels') }}
      </h2>
      @auth
      <x-link-button.primary href="{{ route('labels.create') }}">
        {{ __('app.buttons.labels.create') }}
      </x-link-button.primary>
      @endauth
    </div>
  </x-slot>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
      <table class="min-w-full table-fixed" data-test="tasks">
        <thead class="bg-gray-100 dark:bg-gray-900">
          <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <th class="w-16 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">ID</th>
            <th class="w-auto px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">{{ __('app.fields.name') }}</th>
            <th class="w-auto px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">{{ __('app.fields.description') }}</th>
            <th class="w-40 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">{{ __('app.fields.created_at') }}</th>
            @auth
            <th class="w-1 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">{{ __('app.fields.actions') }}</th>
            @endauth
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
          @foreach($labels as $label)
          <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <td class="px-6 py-4 text-center text-gray-900 dark:text-gray-100">{{ $label->id }}</td>
            <td class="px-6 py-4 text-left whitespace-normal break-words text-gray-900 dark:text-gray-100">{{ $label->name }}</td>
            <td class="px-6 py-4 text-left whitespace-normal break-words text-gray-900 dark:text-gray-100">
              @if ($label->description)
              {{ $label->description }}
              @else
              <span class="text-gray-400">
                  {{ __('app.fields.empty.description') }}
              </span>
              @endif
            </td>
            <td class="px-6 py-4 text-center text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $label->created_at->format('d.m.Y H:i') }}</td>
            @auth
            <td class="px-6 py-4 text-center">
              <div class="flex justify-center gap-3">
                <x-link-button.primary href="{{ route('labels.edit', $label) }}">
                  {{ __('app.buttons.common.edit') }}
                </x-link-button.primary>
                <x-confirm-delete
                  id="delete-label-{{ $label->id }}"
                  :action="route('labels.destroy', $label)"
                  entity="labels"
                />
              </div>
            </td>
            @endauth
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @if($labels->hasPages())
      {{ $labels->links() }}
    @endif
  </div>
</x-app-layout>