<!-- Begin Page Content -->
<div class="container-fluid mb-5">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">
		<i class="fa fa-home"></i>
		Inicio

		<button class="btn btn-secondary btn-sm float-right" title="Agregar nuevo proyecto" data-toggle="modal" data-target="#create_project">
			<i class="fa fa-plus"></i>
		</button>
		
		<a href="/servers/backup" class="btn btn-secondary btn-sm float-right mr-1" title="Generar respaldo">
		    <i class="fa fa-download"></i>
		</a>
	</h1>

	Tareas pendientes

	<hr>

	@if ($tasks->count())
		<div id="accordion">
			@foreach ($tasks as $task)
				<div class="card">
					<div class="card-header" id="headingThree">
						<h5 class="mb-0">
							<button title="Click aquí para ver más información" class="btn btn-link collapsed text-left" data-toggle="collapse" data-target="#{{ 'collapseThree_' . $task->id }}" aria-expanded="false" aria-controls="collapseThree">
								{{ $task->title }}

								<span class="badge badge-secondary" style="background-color: {{ $task->project->color }}">
									<i class="{{ $task->project->icon }}"></i>
									{{ $task->project->name }}
								</span>
							</button>
						</h5>
					</div>

					<div id="{{ 'collapseThree_' . $task->id }}" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
						<div class="card-body">
							<p>{!! description($task->description) !!}</p>

							@if ($task->files->count())
								<hr>
								<b>Archivos adjuntos</b>
								<br><br>
								@foreach ($task->files as $file)
                                    @if (!(strpos($task->description, $file->file) !== false))
                                        <a title="Clic aquí para ver archivo" {{ lightbox($file->file, $task->title) }} target="_blank" class="d-block d-sm-inline mr-3 attach {{ modal($file->file) }}" href="{{ url('/resources/assets/files/' . $file->file . '?v=' . rand(9, 999999)) }}">
                                            <i class="{{ icon_file($file->file) }}"></i> {{ $file->file }}
                                        </a>
                                    @endif
								@endforeach
							@endif
						</div>

						<div class="card-footer text-right">
							@if ($task->status)
								<button class="btn btn-secondary btn-sm check" data-status="0" title="Marcar tarea como no finalizada" data-id="{{ $task->id }}"><i class="far fa-circle"></i></button>
							@else
								<button class="btn btn-success btn-sm check" data-status="1" title="Marcar tarea como finalizada" data-id="{{ $task->id }}"><i class="fa fa-check"></i></button>
							@endif
						</div>
					</div>
				</div>
			@endforeach
		</div>

	@else
		<div class="alert alert-info">No se han registrado recientemente</div>
	@endif
</div>

@include('dashboard/create_project')
@include('dashboard/view_doc')

<script src="{{ asset('js/dashboard.js') }}"></script>
