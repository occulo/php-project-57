<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status :status="session('status')" />
  {{ html()->form('POST', route('login'))->open() }}
  <!-- Email Address -->
  <div>
    {{ html()->label(__('profile.email'), 'email') }}
    {{ html()->email('email', old('email'))->attribute('required')->attribute('autofocus') }}
    @error('email')
    <div>
      {{ $message }}
    </div>
    @enderror
  </div>
  <!-- Password -->
  <div>
    {{ html()->label(__('profile.password'), 'password') }}
    {{ html()->password('password')->attribute('required') }}
    @error('password')
    <div>
      {{ $message }}
    </div>
    @enderror
  </div>
  <div>
    {{ html()->checkbox('remember', false, 1) }}
    {{ html()->label(__('auth.remember_me'), 'remember') }}
  </div>
  @if (Route::has('password.request'))
  <a href="{{ route('password.request') }}">
    {{ __('auth.forgot_password') }}
  </a>
  @endif
  {{ html()->button(__('auth.login'))->type('submit') }}
  {{ html()->form()->close() }}
</x-guest-layout>