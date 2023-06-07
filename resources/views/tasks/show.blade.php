<x-template active="{{ $task->project->slug }}">
    <section class="w-full lg:w-4/5 mb-10">
        <!--Title-->
        <x-title icon="{{ $task->project->icon }}" title="{{ $task->title }}">
            <x-slot name="buttons">
                <div class="flex items-center ml-1">
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

        <hr class="bg-gray-300 my-6">

        @if($task->description)
            <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
                {!! markdown($task->description) !!}
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
