<x-app-layout>
  <h1 class="text-2xl font-normal">{{ __('Edit status') }}</h1>
  <form method="post" action="{{ route('task_statuses.update', $taskStatus) }}">
    @csrf
    @method('PATCH')
    <label for="name">{{ __('Name') }}</label>
    <input type="text" name="name" id="name" value="{{ old('name', $taskStatus->name) }}">
    @error('name')
    <span>{{ $message }}</span>
    @enderror
    <button type="submit">{{ __('Save') }}</button>
  </form>
</x-app-layout>