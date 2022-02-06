<x-template active="{{ $project->slug }}">
    <section class="w-full lg:w-4/5 mb-20">
        <!--Title-->
        <x-title icon="{{ $project->icon }}" title="{{ $project->name }} » Crear nueva tarea"/>

        <hr class="bg-gray-300 my-6">

        <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
            <form enctype="multipart/form-data" method="POST" action="/tasks/store">
                <input type="hidden" name="slug" value="{{ $project->slug }}">

                <x-input required label="Título" key="title" value=""/>

                <x-textarea label="Descripción" key="description" value=""/>

                <x-input-file label="Archivos adjuntos" multiple key="files[]"/>

                <x-button/>
            </form>
        </div>
    </section>
</x-template>
