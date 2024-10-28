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

                <div class="px-20 mx-10">
                    <canvas id="tasks-for-project"></canvas>
                </div>
            </div>

            <div class="bg-white p-5">
                <div>
                    Tareas por estado
                </div>

                <div class="px-20 mx-10">
                    <canvas id="tasks-for-status"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white p-5 mt-3">
            <div>
                Tareas por día
            </div>

            <div class="p-10 m-10">
                <canvas id="tasks-for-date"></canvas>
            </div>
        </div>

        <div class="bg-white pt-5 pb-1 pr-5 pl-5 mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tarea</th>
                        <th>Proyecto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->project->name }}</td>

                            <td>
                                <x-link
                                    href="{{ '/tasks/show/' . $item->project->slug . '/' . $item->id }}"
                                    title="Ver tarea"
                                    color="white"
                                    text="dark"
                                    icon="fa fa-eye"
                                    id="back"
                                    class="view-task"
                                />

                                <x-link
                                    href="{{ '/tasks/edit/' . $item->project->slug . '/' . $item->id }}"
                                    title="Editar tarea"
                                    color="white"
                                    text="dark"
                                    icon="fa fa-edit"
                                    id="back"
                                    class="edit-task"
                                />

                                @if($item->status)
                                    <x-link
                                        href="{{ '/status/' . $item->id . '/undone' }}"
                                        title="Marcar tarea como pendiente"
                                        color="white"
                                        text="dark"
                                        icon="fa fa-circle"
                                        id="undone-task"
                                        class="undone-task"
                                    />
                                @else
                                    <x-link
                                        href="{{ '/status/' . $item->id . '/done' }}"
                                        title="Marcar tarea como realizada"
                                        color="white"
                                        text="text-green-500"
                                        icon="fa fa-check"
                                        id="done-task"
                                        class="done-task"
                                    />
                                @endif

                                <x-link
                                    href="{{ '/tasks/delete/' . $item->project->slug . '/' . $item->id }}"
                                    title="Eliminar tarea"
                                    color="white"
                                    text="text-red-500"
                                    icon="fa fa-trash"
                                    id="delele-task"
                                    delete="true"
                                    class="delele-task"
                                />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                window.location.href = '/projects/show/' + project.replace(' ', '-');
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

            new Chart('tasks-for-status', {
                type: 'pie',
                data: {
                    labels: {!! $status->pluck('status') !!},
                    datasets: [
                        {
                            data: {!! $status->pluck('quantity') !!},
                            backgroundColor: {!! $status->pluck('color') !!},
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
