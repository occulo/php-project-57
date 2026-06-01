<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Привет от Хекслета!') }}
      </h2>
      <div class="flex justify-center gap-3">
      @auth
        {{ html()->form('POST', route('logout'))->open() }}
        <x-danger-button>
          {{ __('auth.logout') }}
        </x-danger-button>
        {{ html()->form()->close() }}
      @else
        @if (Route::has('login'))
        <x-link-button.secondary href="{{ route('login') }}">
          {{ __('auth.login') }}
        </x-link-button.secondary>
        @endif
        @if (Route::has('register'))
        <x-link-button.primary href="{{ route('register') }}">
          {{ __('auth.register') }}
        </x-link-button.primary>
        @endif
      @endauth
      </div>
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
