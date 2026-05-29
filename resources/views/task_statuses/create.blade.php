<x-app-layout>
  <h1 class="text-2xl font-normal">{{ __('New status') }}</h1>
  <form method="post" action="{{ route('task_statuses.store') }}">
    @csrf
    <label for="name">{{ __('Name') }}</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}">
    @error('name')
    <span>{{ $message }}</span>
    @enderror
    <button type="submit">{{ __('Create') }}</button>
  </form>
</x-app-layout>