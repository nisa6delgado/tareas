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
                    Tareas por día
                </div>

                <div class="pt-10">
                    <canvas id="tasks-for-date"></canvas>
                </div>
            </div>
        </div>
    </section>

    <input type="hidden" id="tasks" value='{!! $tasks !!}'>

    <x-slot:js>
        <script src="{{ node('chart.js/dist/chart.umd.js') }}"></script>

        <script>
            const tasksForProjectElement = document.getElementById('tasks-for-project');

            const tasksForProjectChart = new Chart(tasksForProjectElement, {
                type: 'pie',
                data: {
                    labels: {!! $tasks->pluck('project') !!},
                    datasets: [
                        {
                            data: {!! $tasks->pluck('quantity') !!},
                            backgroundColor: {!! $tasks->pluck('color') !!},
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

            tasksForProjectElement.onclick = (event) => {
                response = tasksForProjectChart.getElementsAtEventForMode(
                    event,
                    'nearest',
                    { intersect: true },
                    true
                );

                if (response.length === 0) {
                    return;
                }

                project = tasksForProjectChart.data.labels[response[0].index].toLowerCase();
                window.location.href = '/projects/show/' + project;
            };

            new Chart('tasks-for-date', {
                type: 'line',
                data: {
                    labels: {!! $dates->pluck('date') !!},
                    datasets: [
                        {
                            label: 'Tareas por día',
                            data: {!! $dates->pluck('quantity') !!},
                            borderColor: '{{ $tasks[0]->color }}'
                        },
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    scales: {
                        y: {
                            min: 0,
                            max: {{ max($dates->pluck('quantity')->toArray()) + 1 }},
                            ticks: {
                                stepSize: 1,
                            }
                        }
                    }
                }
            });
        </script>
    </x-slot>
</x-template>
