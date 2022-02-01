<x-app active="configuration">
    <section class="w-full lg:w-4/5 mb-20">
        <!--Title-->
        <x-title icon="fa fa-plus" title="Crear nuevo proyecto"/>

        <hr class="bg-gray-300 my-6">

        <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
            <form method="POST" action="/projects/store">
                <x-form-input label="Nombre" key="name" value=""/>

                <x-form-input label="Ícono" key="icon" value=""/>

                <x-form-input label="Color" key="color" value=""/>

                <x-form-button/>
            </form>
        </div>
    </section>
</x-app>