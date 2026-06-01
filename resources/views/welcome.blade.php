<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Привет от Хекслета!') }}
      </h2>
      @if (Route::has('login')) <div class="flex justify-center gap-3">
        <x-link-button.secondary href="{{ route('login') }}">
          {{ __('auth.login') }}
        </x-link-button.secondary>
        @if (Route::has('register'))
        <x-link-button.primary href="{{ route('register') }}">
          {{ __('auth.register') }}
        </x-link-button.primary>
        @endif
      </div>
      @endif
    </div>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          {{ __('Это простой менеджер задач на Laravel') }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
