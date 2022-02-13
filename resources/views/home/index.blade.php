<x-template active="/">
    <section class="w-full lg:w-4/5 mb-20">
        <!--Title-->
        <x-title icon="fa fa-home" title="Inicio">
            <x-slot name="buttons">
                <div class="flex md:items-center">
                    <x-link
                        href="{{ '/projects/create' }}"
                        title="Crear nuevo proyecto"
                        color="gray"
                        icon="fa fa-plus"
                        id="create"
                        class="create"
                    />

                    <x-link
                        href="{{ '/backup' }}"
                        title="Generar copia de seguridad"
                        color="gray"
                        icon="fa fa-download"
                        id="download"
                    />
                </div>
            </x-slot>
        </x-title>

        <hr class="bg-gray-300 my-6">

        @foreach($tasks as $task)
            <x-task
                id="{{ $task->id }}"
                title="{!! $task->title !!}"
                slug="{{ $task->project->slug }}"
                color="{{ $task->project->color }}"
                icon="{{ $task->project->icon }}"
                project="{{ $task->project->name }}"
                badge="true"
            />
        @endforeach
    </section>
</x-template>
