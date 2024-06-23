@props(['id', 'name', 'label'])

<div {{ $attributes->merge(['class' => 'mt-4']) }}>
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
    <div class="mt-1 flex items-center">
        <input id="{{ $id }}" name="{{ $name }}" type="file" {{ $attributes->merge(['class' => 'form-input block w-full py-2 px-3 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) }}>
    </div>
    @error($name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
