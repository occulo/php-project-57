<x-app-layout>
  <h1 class="text-2xl font-normal">{{ __('New task') }}</h1>
  <form method="POST" action="{{ route('tasks.store') }}">
    @csrf
    <div>
      <label for="name">{{ __('Name') }}</label>
      <input type="text" name="name" id="name" value="{{ old('name') }}">
      @error('name')
      <span>{{ $message }}</span>
      @enderror
    </div>
    <div>
      <label for="description">{{ __('Description') }}</label>
      <textarea name="description" id="description">{{ old('description') }}</textarea>
      @error('description')
      <span>{{ $message }}</span>
      @enderror
    </div>
    <div>
      <label for="status_id">{{ __('Status') }}</label>
      <select name="status_id" id="status_id">
        @foreach ($taskStatuses as $status)
        <option value="{{ $status->id }}" @selected(old('status_id') == $status->id)>
            {{ $status->name }}
        </option>
        @endforeach
      </select>
      @error('status_id')
      <span>{{ $message }}</span>
      @enderror
    </div>
    <div>
      <label for="assigned_to_id">{{ __('Assign to') }}</label>
      <select name="assigned_to_id" id="assigned_to_id">
        <option value="">{{ __('Unassigned') }}</option>
        @foreach ($users as $user)
        <option value="{{ $user->id }}" @selected(old('assigned_to_id') == $user->id)>
            {{ $user->name }}
        </option>
        @endforeach
      </select>
      @error('assigned_to_id')
      <span>{{ $message }}</span>
      @enderror
    </div>
    <button type="submit">
      {{ __('Create') }}
    </button>
  </form>
</x-app-layout>