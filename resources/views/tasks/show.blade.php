<x-template active="{{ $task->project->slug }}">
    <section class="w-full lg:w-4/5 mb-20">
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

                    @if($task->status)
                        <x-link
                            href="{{ '/status/' . $task->id . '/undone' }}"
                            title="Marcar tarea como pendiente"
                            color="gray"
                            icon="far fa-circle"
                            id="undone"
                            class="undone"
                        />
                    @else
                        <x-link
                            href="{{ '/status/' . $task->id . '/done' }}"
                            title="Marcar tarea como realizada"
                            color="green"
                            icon="fa fa-check"
                            id="done"
                            class="done"
                        />
                    @endif

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
                {!! str()->markdown($task->description ?? '') !!}
            </div>
        @endif

        @if($task->files->count())
            <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
                <p><b>Archivos adjuntos</b></p>

                @foreach($task->files as $file)
                    <span class="mr-2">
                        <a target="_blank" href="{{ url($file->file) }}">
                            <i class="{{ icon($file->file) }}"></i> {{ $file->file }}
                        </a>
                    </span>
                @endforeach
            </div>
        @endif
    </section>
</x-template>
