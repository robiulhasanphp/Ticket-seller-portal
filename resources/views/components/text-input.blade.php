@props(['disabled' => false])

{{-- Text Input Component
    A reusable text input component with consistent styling and accessibility features.
    @props
        - $disabled: Boolean to disable the input
        - All HTML attributes via $attributes->merge()
--}}
<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}
/>

