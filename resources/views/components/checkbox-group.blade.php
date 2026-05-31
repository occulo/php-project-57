@props(['items','name', 'selected' => [], 'disabled' => false])

<div class="flex flex-wrap gap-1 items-start">
    @foreach ($items as $item)
    <div>
        <input @disabled($disabled) id="{{ $name }}-{{ $item->id }}" name="{{ $name }}[]" type="checkbox" value="{{ $item->id }}" class="hidden peer" @checked(in_array($item->id, $selected)) >
        <label for="{{ $name }}-{{ $item->id }}" {{ $attributes->merge(['class' => 'inline-flex items-center leading-none px-2.5 py-1.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-full text-sm font-medium text-gray-700 dark:text-gray-300 transition hover:bg-gray-50 dark:hover:bg-gray-700 peer-checked:bg-gray-200 dark:peer-checked:bg-gray-700 peer-checked:border-gray-400 dark:peer-checked:border-gray-400']) }}>
            {{ $item->name }}
        </label>
    </div>
    @endforeach
</div>
