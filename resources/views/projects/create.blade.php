<x-template active="configuration">
    <section class="w-full lg:w-4/5 mb-20 pr-4">
        <!--Title-->
        <x-title icon="fa fa-plus" title="Crear nuevo proyecto"/>

        <x-validation-errors/>

        <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
            <form method="POST" action="/projects/store">
                <x-input required label="Nombre" key="name" value="{{ old('name') }}"/>

                <x-input required label="Ícono" key="icon" value="{{ old('icon') }}"/>

                <x-input required label="Color" key="color" value="{{ old('color') }}"/>

                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <x-button class="save"/>

                        <x-link
                            id="back"
                            href="/"
                            class="back py-2 px-4"
                            color="gray"
                            content="Ir a atrás"
                            icon="fa fa-arrow-left"
                        />
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-template>
