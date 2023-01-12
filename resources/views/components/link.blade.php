<div class="mr-1">
    <a data-tooltip-target="{{ $id }}" {!! isset($delete) ? 'x-on:click="confirmDelete(event, $el)"' : '' !!} {!! isset($move) ? 'x-on:click="move(event, $el)"' : '' !!} href="{{ $href }}" class="{{ $class }} shadow bg-{{ $color }}-300 hover:bg-{{ $color }}-500 focus:shadow-outline focus:outline-none text-white font-bold py-1 px-2">
        <i class="{{ $icon }}"></i>
    </a>

    <x-tooltip text="{{ $title }}" id="{{ $id }}"/>
</div>
