<x-template active="{{ $task->project->slug }}">
    <section class="w-full lg:w-4/5 mb-10 pr-4">
        <!--Title-->
        <x-title icon="{{ $task->project->icon }}" title="{{ $task->title }}">
            <x-slot name="buttons">
                <div class="flex items-center ml-1">
                    <x-link
                        href="{{ '/projects/show/' . $task->project->slug }}"
                        title="Ir a atrás"
                        color="gray"
                        icon="fa fa-arrow-left"
                        id="back"
                        class="back"
                    />

                    <x-link
                        href="{{ '/tasks/edit/' . $task->project->slug . '/' . $task->id }}"
                        title="Editar esta tarea"
                        color="gray"
                        icon="fa fa-edit"
                        id="edit"
                        class="edit"
                    />

                    <x-link
                        href="{{ '/tasks/delete/' . $task->project->slug . '/' . $task->id }}"
                        title="Eliminar esta tarea"
                        color="red"
                        icon="fa fa-trash"
                        delete="true"
                        id="delete"
                        class="delete"
                    />
                </div>
            </x-slot>
        </x-title>

        @if($task->description)
            <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
                @if($task->format == 'html')
                    {!! $task->description !!}
                @endif

                @if($task->format == 'markdown')
                    {!! markdown($task->description) !!}
                @endif

                @if($task->format == 'csv')
                    {!! csv($task->description) !!}
                @endif
            </div>
        @else
            <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white text-center">No hay descripción</div>
        @endif

        @if($task->files->count())
            <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
                <p><b>Archivos adjuntos</b></p>

                @foreach($task->files as $file)
                    <span class="mr-2">
                        <a href="{{ $file->url }}">
                            <i class="{{ $file->icon }}"></i> {{ $file->file }}
                        </a>
                    </span>
                @endforeach
            </div>
        @endif
    </section>
</x-template>
