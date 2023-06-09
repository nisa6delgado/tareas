<x-template active="configuration">
    <section class="w-full lg:w-4/5 mb-20">
        <!--Title-->
        <x-title icon="fa fa-plus" title="Crear nuevo proyecto"/>

        <x-validation-errors/>

        <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
            <form method="POST" action="/projects/store">
                <x-input required label="Nombre" key="name" value="{{ old('name') }}"/>

                <x-input required label="Ícono" key="icon" value="{{ old('icon') }}"/>

                <x-input required label="Color" key="color" value="{{ old('color') }}"/>

                <x-button class="save"/>
            </form>
        </div>
    </section>
</x-template>
