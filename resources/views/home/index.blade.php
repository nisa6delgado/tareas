<x-template active="/">
    <section class="w-full lg:w-4/5 mb-20 pr-4">
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
                        class=""
                    />
                </div>
            </x-slot>
        </x-title>

        <div class="grid grid-cols-2 gap-3">
            <div class="bg-white p-5">
                <div>
                    Tareas por proyecto
                </div>

                <div class="px-20">
                    <canvas id="tasks-for-project"></canvas>
                </div>
            </div>

            <div class="bg-white p-5">
                <div>
                    Tareas por estado
                </div>

                <div class="px-20">
                    <canvas id="tasks-for-status"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 mt-3">
            <div class="bg-white p-5">
                <div>
                    Tareas por fecha
                </div>

                <div class="px-20">
                    <canvas id="tasks-for-date"></canvas>
                </div>
            </div>
        </div>
    </section>

    <x-slot:js>
        <script src="{{ node('chart.js/dist/chart.umd.js') }}"></script>

        <script>
            new Chart('tasks-for-project', {
                type: 'pie',
                data: {
                    labels: {!! $chart['projects'] !!},
                    datasets: [
                        {
                            data: {!! $chart['tasks'] !!},
                            backgroundColor: {!! $chart['colors'] !!},
                        },
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                }
            });
        </script>
    </x-slot>
</x-template>
