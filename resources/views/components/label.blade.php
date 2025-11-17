@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium mb-1 text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
