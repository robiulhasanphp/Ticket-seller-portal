@props(['value'])

{{-- Form Input Label Component
    Consistent label styling for form inputs with accessibility support.
    @props
        - $value: Label text (alternative to slot)
--}}
<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>

