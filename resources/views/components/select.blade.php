@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-purple-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
    {{ $slot }}
</select>
