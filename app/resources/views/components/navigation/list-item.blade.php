@props(['active' => false, 'href' => '#', 'name'])
@if($name != 'Sellers')
    <a href="{{ $href }}" class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ $active ? 'bg-cyan-800 text-white' : 'text-cyan-100 hover:bg-cyan-600 hover:text-white' }}" aria-current="page">
        {{ $svg }}
        {{ $name }}
    </a>
@else
    <a href="{{ $href }}" class="ml-minus-8 group flex items-center px-2 py-2 text-base font-medium rounded-md  bg-red-500 text-white text-cyan-100 hover:bg-cyan-600 hover:text-white" aria-current="page">
        {{ $svg }}
        {{ $name }}
    </a>
@endif

