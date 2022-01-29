<div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
    @if(isset($circle))
        @if($status)
            <i class="fa fa-check mr-2"></i>
        @else
            <i class="far fa-circle mr-2"></i>
        @endif
    @endif

    <a href="{{ '/tasks/show/' . $slug . '/' . $id }}" data-tooltip-target="view-task">
        {{ $title }}
    </a>

    <x-tooltip text="Ver los detalles de esta tarea" id="view-task"/>

    @if(isset($badge))
        <a data-tooltip-target="badge" href="{{ '/projects/show/' . $slug }}">
            <small class="badge" style="background-color: {{ $color  }}">
                <i class="{{ $icon }}"></i> {{ $project }}
            </small>
        </a>

        <x-tooltip text="Ver los detalles de este proyecto" id="badge"/>
    @endif
</div>
