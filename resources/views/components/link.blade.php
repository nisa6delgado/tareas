<a data-tooltip-target="{{ $id }}" {!! isset($delete) ? 'x-on:click="confirmDelete(event, $el)"' : '' !!} {!! isset($move) ? 'x-on:click="move(event, $el)"' : '' !!} href="{{ $href }}" class="{{ $class }} bg-{{ $color }}-300 hover:bg-{{ $color }}-500 focus:shadow-outline focus:outline-none {!! isset($text) ? $text : 'text-white' !!} font-bold py-1 px-2 ml-2">
    <i class="{{ $icon }}"></i> {{ isset($content) ? $content : '' }}
</a>

@if(isset($title))
    <x-tooltip text="{{ $title }}" id="{{ $id }}"/>
@endif