<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('app.task_statuses') }}
            </h2>
            @auth
                <x-link-button.primary href="{{ route('task_statuses.create') }}">
                    {{ __('app.buttons.task_statuses.create') }}
                </x-link-button.primary>
            @endauth
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 py-12">
        @if (session()->has('flash_notification'))
            <div
                class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg font-medium text-gray-900 dark:text-gray-100">
                @include('flash::message')
            </div>
        @endif
        <div
            class="overflow-x-auto rounded-xl text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
            <table class="min-w-full table-fixed" data-test="task_statuses">
                <thead class="bg-gray-100 dark:bg-gray-900">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <th class="w-16 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">ID</th>
                        <th class="w-auto px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">
                            {{ __('app.fields.name') }}</th>
                        <th class="w-40 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">
                            {{ __('app.fields.created_at') }}</th>
                        @auth
                            <th class="w-1 px-6 py-4 font-medium text-center text-gray-700 dark:text-gray-300">
                                {{ __('app.fields.actions') }}</th>
                        @endauth
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($taskStatuses as $status)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4 text-center text-gray-900 dark:text-gray-100">{{ $status->id }}</td>
                            <td
                                class="px-6 py-4 text-left whitespace-normal break-words text-gray-900 dark:text-gray-100">
                                {{ $status->name }}</td>
                            <td class="px-6 py-4 text-center text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                {{ $status->created_at->format('d.m.Y H:i') }}</td>
                            @auth
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-3">
                                        <x-link-button.primary href="{{ route('task_statuses.edit', $status) }}">
                                            {{ __('app.buttons.common.edit') }}
                                        </x-link-button.primary>
                                        {{ html()->form('DELETE', route('task_statuses.destroy', $status))->open() }}
                                        <x-link-button.danger href="{{ route('task_statuses.destroy', $status) }}"
                                            onclick="event.preventDefault(); if (confirm('{{ __('app.pages.task_statuses.destroy.subtitle') }}')) { this.closest('form').submit(); }">
                                            {{ __('app.buttons.common.delete') }}
                                        </x-link-button.danger>
                                        {{ html()->form()->close() }}
                                    </div>
                                </td>
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($taskStatuses->hasPages())
            {{ $taskStatuses->links() }}
        @endif
    </div>
</x-app-layout>
