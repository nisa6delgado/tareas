<x-template active="configuration">
    <section class="w-full lg:w-4/5 mb-20">
        <!--Title-->
        <x-title icon="fa fa-wrench" title="Configuración"/>

        <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
            <form method="POST">
                @foreach($configurations as $configuration)
                    @if($configuration->key == 'password')
                        <x-input
                            label="{{ $configuration->key }}"
                            key="{{ $configuration->key }}"
                            value="{{ $configuration->value }}"
                            password
                            required
                        />
                    @else
                        <x-input
                            label="{{ $configuration->key }}"
                            key="{{ $configuration->key }}"
                            value="{{ $configuration->value }}"
                            required
                        />
                    @endif
                @endforeach

                

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
