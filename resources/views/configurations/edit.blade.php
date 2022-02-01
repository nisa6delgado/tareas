<x-app active="configuration">
    <section class="w-full lg:w-4/5 mb-20">
        <!--Title-->
        <x-title icon="fa fa-wrench" title="Configuración"/>

        <hr class="bg-gray-300 my-6">

        <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
            <form method="POST">
                @foreach($configurations as $configuration)
                    @if($configuration->key == 'password')
                        <x-form-input
                            label="{{ $configuration->key }}"
                            key="{{ $configuration->key }}"
                            value="{{ $configuration->value }}"
                            password
                        />
                    @else
                        <x-form-input
                            label="{{ $configuration->key }}"
                            key="{{ $configuration->key }}"
                            value="{{ $configuration->value }}"
                        />
                    @endif
                @endforeach

                <x-form-button/>
            </form>
        </div>
    </section>
</x-app>