<!-- Begin Page Content -->
<div class="container-fluid mb-5">

	<!-- Page Heading -->
	<h1 class="h3 mb-5 text-gray-800">
		<i class="{{ $project->icon }}"></i>
		{{ $project->name }}

		<div>		
			<button title="Eliminar proyecto" class="btn btn-danger btn-sm float-right delete_project" data-id="{{ $project->id }}">
				<i class="fa fa-trash"></i>
			</button>

			<button title="Editar proyecto" data-toggle="modal" data-target="#edit_project" class="btn btn-secondary btn-sm float-right mr-2">
				<i class="fa fa-edit"></i>
			</button>

			<button title="Agregar tarea" class="btn btn-secondary btn-sm float-right mr-2" data-toggle="modal" data-target="#create_task">
				<i class="fa fa-plus"></i>
			</button>
		</div>
	</h1>

	@if($project->tasks->count())
		<div id="accordion">
			@foreach ($project->tasks as $task)
				<div class="card">
					<div class="card-header text-justify" id="headingThree">
						<h5 class="mb-0 text-justify">
							<button title="Click aquí para ver más información" class="btn btn-link collapsed text-left" data-toggle="collapse" data-target="#collapseThree_{{ $task->id }}" aria-expanded="false" aria-controls="collapseThree">
								@if($task->status)
									<i class="fa fa-check text-success"></i>
								@else
									<i class="far fa-circle"></i>
								@endif

								{{ $task->title }}
							</button>
						</h5>
					</div>

					<div id="{{ 'collapseThree_' . $task->id }}" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
						<div class="card-body">
							<p>{{ description($task->description) }}</p>

							@if($task->files->count())
								<hr>
								<b>Archivos adjuntos</b>
								<br><br>
								@foreach ($task->files as $file)
									@if(!(strpos($task->description, $file->file) !== false))
                                        <a title="Clic aquí para ver archivo" {{ lightbox($file->file, $task->title) }} target="_blank" class="d-block d-sm-inline mr-3 attach {{ modal($file->file) }}" href="{{ url('/resources/assets/files/' . $file->file . '?v=' . rand(9, 999999)) }}">
                                            <i class="{{ icon_file($file->file) }}"></i> {{ $file->file }}
                                        </a>
                                    @endif
								@endforeach
							@endif
						</div>

						<div class="card-footer text-right">
							<button title="Editar tarea" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="{{ '#edit_task_' . $task->id }}"><i class="fa fa-edit"></i></button>
							<button title="Ver o agregar comentarios" class="btn btn-info btn-sm" data-toggle="modal" data-target="{{ '#comments_' . $task->id }}"><i class="fa fa-comments"></i></button>

							@if($task->status)
								<button class="btn btn-secondary btn-sm check" data-status="0" title="Marcar tarea como no finalizada" data-id="{{ $task->id }}"><i class="far fa-circle"></i></button>
							@else
								<button class="btn btn-success btn-sm check" data-status="1" title="Marcar tarea como finalizada" data-id="{{ $task->id }}"><i class="fa fa-check"></i></button>
							@endif

							<button class="btn btn-info btn-sm" title="Gestión de archivos" data-toggle="modal" data-target="{{ '#files_' . $task->id }}"><i class="fa fa-file"></i></button>

							<button title="Mover tarea a otro proyecto" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="{{ '#move_task_' . $task->id }}"><i class="fas fa-compress-alt"></i></button>

							<button class="btn btn-danger btn-sm delete_task" title="Eliminar tarea" data-id="{{ $task->id }}" data-slug="{{ $project->slug }}"><i class="fa fa-trash"></i></button>
						</div>
					</div>
				</div>

				@include('projects/edit_task')
				@include('projects/move_task')
				@include('projects/comments')
				@include('projects/files')
			@endforeach
		</div>

	@else
		<div class="alert alert-info">No se han registrado tareas en este proyecto</div>
	@endif
</div>
<!-- /.container-fluid -->

<input type="hidden" name="slug" value="{{ $project->slug }}">

@include('projects/create_task')
@include('projects/edit_project')
@include('projects/view_doc')

<script src="{{ asset('js/comments.js') }}"></script>
<script src="{{ asset('js/files.js') }}"></script>
<script src="{{ asset('js/projects.js') }}"></script>
<script src="{{ asset('js/tasks.js') }}"></script>
