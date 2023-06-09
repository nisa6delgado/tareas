<x-template active="{{ $project->slug }}">
    <section class="w-full lg:w-4/5 mb-20">
        <!--Title-->
        <x-title icon="{{ $project->icon }}" title="{{ $project->name }}">
            <x-slot name="buttons">
                <div class="flex items-center">
                    <x-link
                        href="{{ '/tasks/create/' . $project->slug }}"
                        title="Crear nueva tarea en este proyecto"
                        color="gray"
                        icon="fa fa-plus"
                        id="create"
                        class="create"
                    />

                    <x-link
                        href="{{ '/projects/edit/' . $project->slug }}"
                        title="Editar este proyecto"
                        color="gray"
                        icon="fa fa-edit"
                        id="edit"
                        class="edit"
                    />

                    <x-link
                        href="{{ '/projects/delete/' . $project->slug }}"
                        title="Eliminar este proyecto"
                        color="red"
                        icon="fa fa-trash"
                        delete="true"
                        id="delete"
                        class="delete"
                    />
                </div>
            </x-slot>
        </x-title>

        @if($project->tasks->count())
            @foreach($project->tasks as $task)
                <x-task
                    circle="true"
                    status="{{ $task->status }}"
                    title="{!! $task->title !!}"
                    slug="{{ $project->slug }}"
                    id="{{ $task->id }}"
                />
            @endforeach
        @else
            <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white text-center">No hay tareas</div>
        @endif
    </section>
</x-template>
