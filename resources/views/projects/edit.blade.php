<x-app active="{{ $project->slug }}">
    <section class="w-full lg:w-4/5 mb-20">
        <!--Title-->
        <x-title icon="{{ $project->icon }}" title="{{ $project->name }} » Editar"/>

        <hr class="bg-gray-300 my-6">

        <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
            <form method="POST" action="/projects/update">
                <input type="hidden" name="slug" value="{{ $project->slug }}">

                <x-form-input label="Nombre" key="name" value="{{ $project->name }}"/>

                <x-form-input label="Ícono" key="icon" value="{{ $project->icon }}"/>

                <x-form-input label="Color" key="color" value="{{ $project->color }}"/>

                <x-form-button/>
            </form>
        </div>
    </section>
</x-app>
