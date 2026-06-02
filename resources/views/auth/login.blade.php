<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status :status="session('status')" />
    {{ html()->form('POST', route('login'))->open() }}
    <!-- Email Address -->
    <div class="mt-4">
      {{ html()->label(__('profile.email'), 'email')->class('block font-medium text-sm text-gray-700 dark:text-gray-300') }}
      {{ html()->email('email', old('email'))->attribute('required')->attribute('autofocus')->class('block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm') }}
      @error('email')
      <div class="mt-2 text-sm font-medium text-red-500">
        {{ $message }}
      </div>
      @enderror
    </div>
    <!-- Password -->
    <div class="mt-4">
      {{ html()->label(__('profile.password'), 'password')->class('block font-medium text-sm text-gray-700 dark:text-gray-300') }}
      {{ html()->password('password')->attribute('required')->class('block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm') }}
      @error('password')
      <div class="mt-2 text-sm font-medium text-red-500">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="block mt-4">
      {{ html()->checkbox('remember', false, 1)->class('rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800') }}
      {{ html()->label(__('auth.remember_me'), 'remember')->class('ms-2 text-sm text-gray-600 dark:text-gray-400') }}
    </div>
    {{ html()->button(__('auth.login'))->class('my-4 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150')->type('submit') }}
    @if (Route::has('password.request'))
    <a href="{{ route('password.request') }}" class="ml-3 underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
      {{ __('auth.forgot_password') }}
    </a>
    @endif
    {{ html()->form()->close() }}
</x-guest-layout>