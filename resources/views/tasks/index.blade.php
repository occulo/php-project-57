<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('app.tasks') }}
            </h2>
            @auth
                <x-link-button.primary href="{{ route('tasks.create') }}">
                    {{ __('app.buttons.tasks.create') }}
                </x-link-button.primary>
            @endauth
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 py-12">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            {{ html()->form('GET', route('tasks.index'))->open() }}
            <div class="flex items-center justify-between">
                <header class="flex items-baseline gap-2">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('app.pages.tasks.index.title') }}
                    </h2>
                    <span class="text-sm text-gray-600 dark:text-gray-400">
                        {{ __('app.pages.tasks.index.subtitle') }}
                    </span>
                </header>
                <div class="flex items-center gap-3">
                    <x-primary-button>
                        {{ __('app.buttons.common.apply') }}
                    </x-primary-button>
                    <x-link-button.danger href="{{ route('tasks.index') }}">
                        {{ __('app.buttons.common.reset') }}
                    </x-link-button.danger>
                </div>
            </div>
            <div class="mt-6 grid grid-cols-3 gap-6 items-start">
                <div class="col-span-1">
                    <x-input-label for="filter[status_id]" :value="__('app.fields.status')" />
                    <x-select-input id="filter[status_id]" name="filter[status_id]" class="mt-1 w-full">
                        <option value="">{{ __('app.pages.tasks.index.options_all') }}</option>
                        @foreach ($taskStatuses as $status)
                            <option value="{{ $status->id }}" @selected(request('filter.status_id') == $status->id)>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </x-select-input>
                </div>
                <div class="col-span-1">
                    <x-input-label for="filter[assigned_to_id]" :value="__('app.fields.assigned_to_id')" />
                    <x-select-input id="filter[assigned_to_id]" name="filter[assigned_to_id]" class="mt-1 w-full">
                        <option value="">{{ __('app.pages.tasks.index.options_all') }}</option>
                        <option value="unassigned">{{ __('app.fields.empty.assignee') }}</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected(request('filter.assigned_to_id') == $user->id)>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </x-select-input>
                </div>
                <div class="col-span-1">
                    <x-input-label for="filter[created_by_id]" :value="__('app.fields.created_by_id')" />
                    <x-select-input id="filter[created_by_id]" name="filter[created_by_id]" class="mt-1 w-full">
                        <option value="">{{ __('app.pages.tasks.index.options_all') }}</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected(request('filter.created_by_id') == $user->id)>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </x-select-input>
                </div>
                <div class="col-span-3">
                    <x-input-label for="filter[label_ids]" :value="__('app.fields.labels')" />
                    <x-checkbox-group :items="$labels" :selected="request('filter.label_ids', [])" name="filter[label_ids]"
                        class="mt-1 cursor-pointer" />
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
        @if (session()->has('flash_notification'))
            <div
                class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg font-medium text-gray-900 dark:text-gray-100">
                @include('flash::message')
            </div>
        @endif
        <div
            class="overflow-x-auto rounded-xl text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
            <table class="min-w-full table-fixed" data-test="tasks">
                <thead class="bg-gray-100 dark:bg-gray-900">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <th class="w-1 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">
                            {{ __('app.fields.id') }}</th>
                        <th class="min-w-48 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">
                            {{ __('app.fields.title') }}</th>
                        <th class="w-36 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">
                            {{ __('app.fields.status') }}</th>
                        <th class="w-32 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">
                            {{ __('app.fields.labels') }}</th>
                        <th class="w-40 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">
                            {{ __('app.fields.assigned_to_id') }}</th>
                        <th class="w-40 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">
                            {{ __('app.fields.created_by_id') }}</th>
                        <th class="w-40 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">
                            {{ __('app.fields.created_at') }}</th>
                        @auth
                            <th class="w-1 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">
                                {{ __('app.fields.actions') }}</th>
                        @endauth
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($tasks as $task)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4 text-center text-gray-900 dark:text-gray-100">{{ $task->id }}</td>
                            <td
                                class="px-6 py-4 text-left whitespace-normal break-words text-gray-900 dark:text-gray-100">
                                <a href="{{ route('tasks.show', $task) }}">
                                    {{ $task->name }}
                                </a>
                            </td>
                            <td
                                class="px-6 py-4 text-left whitespace-normal break-words text-gray-900 dark:text-gray-100">
                                {{ $task->status->name }}</td>
                            <td
                                class="px-6 py-4 text-left whitespace-normal break-words text-gray-900 dark:text-gray-100">
                                @if ($task->labels->isNotEmpty())
                                    <x-checkbox-group disabled :items="$task->labels" name="labels" class="text-xs" />
                                @else
                                    <span class="text-gray-400">
                                        {{ __('app.fields.empty.labels') }}
                                    </span>
                                @endif
                            </td>
                            <td
                                class="px-6 py-4 text-left whitespace-normal break-words text-gray-900 dark:text-gray-100">
                                {{ $task->assignedTo?->name ?? __('app.fields.empty.assignee') }}</td>
                            <td
                                class="px-6 py-4 text-left whitespace-normal break-words text-gray-900 dark:text-gray-100">
                                {{ $task->createdBy->name }}</td>
                            <td class="px-6 py-4 text-center text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                {{ $task->created_at->format('d.m.Y H:i') }}</td>
                            @auth
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center gap-3">
                                        @can('update', $task)
                                            <x-link-button.primary href="{{ route('tasks.edit', $task) }}">
                                                {{ __('app.buttons.common.edit') }}
                                            </x-link-button.primary>
                                        @endcan
                                        @can('delete', $task)
                                            {{ html()->form('DELETE', route('tasks.destroy', $task))->open() }}
                                            <x-link-button.danger href="{{ route('tasks.destroy', $task) }}"
                                                onclick="event.preventDefault(); if (confirm('{{ __('app.pages.tasks.destroy.subtitle') }}')) { this.closest('form').submit(); }">
                                                {{ __('app.buttons.common.delete') }}
                                            </x-link-button.danger>
                                            {{ html()->form()->close() }}
                                        @endcan
                                    </div>
                                </td>
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($tasks->hasPages())
            {{ $tasks->links() }}
        @endif
    </div>
</x-app-layout>
