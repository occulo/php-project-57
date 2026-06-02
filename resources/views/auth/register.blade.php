<x-guest-layout>
  {{ html()->form('POST', route('register'))->open() }}
  <!-- Name -->
  <div>
    {{ html()->label(__('profile.name'), 'name') }}
    {{ html()->text('name', old('name'))->id('name')->attribute('required')->attribute('autofocus')->attribute('autocomplete', 'name') }}
    @error('name')
    <div>
        {{ $message }}
    </div>
    @enderror
  </div>
  <!-- Email Address -->
  <div>
    {{ html()->label(__('profile.email'), 'email') }}
    {{ html()->email('email', old('email'))->id('email')->attribute('required')->attribute('autocomplete', 'username') }}
    @error('email')
    <div>
        {{ $message }}
    </div>
    @enderror
  </div>
  <!-- Password -->
  <div>
    {{ html()->label(__('profile.password'), 'password') }}
    {{ html()->password('password')->id('password')->attribute('required')->attribute('autocomplete', 'new-password') }}
    @error('password')
    <div>
        {{ $message }}
    </div>
    @enderror
  </div>
  <!-- Confirm Password -->
  <div>
    {{ html()->label(__('profile.confirm_password'), 'password_confirmation') }}
    {{ html()->password('password_confirmation')->id('password_confirmation')->attribute('required')->attribute('autocomplete', 'new-password') }}
    @error('password_confirmation')
    <div>
        {{ $message }}
    </div>
    @enderror
  </div>
  <div>
    <a href="{{ route('login') }}">
      {{ __('auth.already_registered') }}
    </a>
    {{ html()->button(__('auth.register'))->type('submit') }}
  </div>
  {{ html()->form()->close() }}
</x-guest-layout>