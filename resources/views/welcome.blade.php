<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Привет от Хекслета!') }}
      </h2>
      <div class="flex justify-center gap-3">
      @auth
        {{ html()->form('POST', route('logout'))->id('logout-form')->open() }}
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('auth.logout') }}
          </a>
        {{ html()->form()->close() }}
      @else
        @if (Route::has('login'))
        <a href="{{ route('login') }}">
          {{ __('auth.login') }}
        </a>
        @endif
        @if (Route::has('register'))
        <a href="{{ route('register') }}">
          {{ __('auth.register') }}
        </a>
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
