<x-template active="{{ $project->slug }}">
    <section class="w-full lg:w-4/5 mb-20">
        <!--Title-->
        <x-title icon="{{ $project->icon }}" title="{{ $project->name }} » Editar"/>

        <hr class="bg-gray-300 my-6">

        <x-validation-errors/>

        <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
            <form method="POST" action="/projects/update">
                <input type="hidden" name="id" value="{{ $project->id }}">

                <x-input required label="Nombre" key="name" value="{{ $project->name }}"/>

                <x-input required label="Ícono" key="icon" value="{{ $project->icon }}"/>

                <x-input required label="Color" key="color" value="{{ $project->color }}"/>

                <x-button class="save"/>
            </form>
        </div>
    </section>
</x-template>
