@props(['disabled' => false, 'type' => 'text'])

{{-- DEFINISI CLASS INTI --}}
@php
    $baseClasses =
        'w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-[#02104A] focus:border-transparent outline-none shadow-sm transition-all duration-200';
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'type' => $type,
    'class' => $baseClasses, // Gunakan class inti sebagai dasar
]) !!}>
