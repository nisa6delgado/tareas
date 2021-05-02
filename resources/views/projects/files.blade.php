<div class="modal fade files_modal" id="{{ 'files_' . $task->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Gestión de archivos</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				@if ($task->files->count())
					<ul class="list-group">
						@foreach ($task->files as $file)
							<li class="list-group-item">
								<i class="{{ icon_file($file->file) }}"></i> {{ $file->file }}

								<button type="button" data-id="{{ $file->id }}" data-slug="{{ $project->slug }}" class="btn btn-danger btn-sm float-right delete_file" alt="Eliminar archivo">
									<i class="fa fa-trash"></i>
								</button>
							</li>
						@endforeach
					</ul>
				@else
					<div class="alert alert-info">Esta tarea no contiene archivos</div>
				@endif

				<hr>

				<form class="upload_files">
					<div class="form-group">
	                    <label for="files">Archivos</label><br>
	                    <input type="file" name="files" multiple>
	                </div>

	                <input type="hidden" name="id_task" value="{{ $task->id }}">

	                <div class="form-group">
	                	<button class="btn btn-primary btn-sm upload_files_button">
	                		<i class="fa fa-upload"></i>
	                		Cargar archivos
	                	</button>
	                </div>
                </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>