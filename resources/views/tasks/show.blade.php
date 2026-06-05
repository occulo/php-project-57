<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('app.task_details') }}
            </h2>
            <x-link-button.secondary href="{{ route('tasks.index') }}">
                {{ __('app.buttons.common.back') }}
            </x-link-button.secondary>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 space-y-6">
        <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
            <table class="w-full" data-test="task">
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <th scope="row"
                            class="w-px whitespace-nowrap px-6 py-4 text-left font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-900">
                            {{ __('app.fields.id') }}</th>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $task->id }}</td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <th scope="row"
                            class="w-px whitespace-nowrap px-6 py-4 text-left font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-900">
                            {{ __('app.fields.title') }}</th>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $task->name }}</td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <th scope="row"
                            class="w-px whitespace-nowrap px-6 py-4 text-left font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-900">
                            {{ __('app.fields.status') }}</th>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $task->status->name }}</td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <th scope="row"
                            class="w-px whitespace-nowrap px-6 py-4 text-left font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-900">
                            {{ __('app.fields.labels') }}</th>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                            @if ($task->labels->isNotEmpty())
                                <x-checkbox-group disabled :items="$task->labels" name="labels" />
                            @else
                                <span class="text-gray-400">
                                    {{ __('app.fields.empty.labels') }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <th scope="row"
                            class="w-px whitespace-nowrap px-6 py-4 text-left font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-900">
                            {{ __('app.fields.created_by_id') }}</th>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $task->createdBy->name }}</td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <th scope="row"
                            class="w-px whitespace-nowrap px-6 py-4 text-left font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-900">
                            {{ __('app.fields.assigned_to_id') }}</th>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                            {{ $task->assignedTo?->name ?? __('app.fields.empty.assignee') }}</td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <th scope="row"
                            class="w-px whitespace-nowrap px-6 py-4 text-left font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-900">
                            {{ __('app.fields.created_at') }}
                        </th>
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                            {{ $task->created_at->format('d.m.Y H:i') }}</td>
                    </tr>
                    <tr
                        class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <th scope="col" colspan="2"
                            class="px-6 py-4 text-left text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-900">
                            {{ __('app.fields.description') }}</th>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td colspan="2" class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $task->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-end items-center gap-3">
            @can('update', $task)
                <x-link-button.primary href="{{ route('tasks.edit', $task) }}">
                    {{ __('app.buttons.common.edit') }}
                </x-link-button.primary>
            @endcan
            @can('delete', $task)
                <x-confirm-delete id="delete-task-{{ $task->id }}" :action="route('tasks.destroy', $task)" entity="tasks" />
            @endcan
        </div>
    </div>
</x-app-layout>
