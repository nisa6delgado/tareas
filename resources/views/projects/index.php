<!-- Begin Page Content -->
<div class="container-fluid mb-5">

	<!-- Page Heading -->
	<h1 class="h3 mb-5 text-gray-800">
		<i class="<?php echo $project->icon; ?>"></i>
		<?php echo $project->name; ?>

		<div>		
			<button title="Eliminar proyecto" class="btn btn-danger btn-sm float-right delete_project" data-id="<?php echo $project->id; ?>">
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

	<?php if ($project->tasks->count()): ?>
		<div id="accordion">
			<?php foreach ($project->tasks as $task): ?>
				<div class="card text-justify">
					<div class="card-header text-justify" id="headingThree">
						<h5 class="mb-0 text-justify">
							<button title="Click aquí para ver más información" class="btn btn-link collapsed text-left" data-toggle="collapse" data-target="#<?php echo 'collapseThree_' . $task->id; ?>" aria-expanded="false" aria-controls="collapseThree">
								<?php if ($task->status): ?>
									<i class="fa fa-check text-success"></i>
								<?php else: ?>
									<i class="far fa-circle"></i>
								<?php endif; ?>

								<?php echo $task->title; ?>
							</button>
						</h5>
					</div>

					<div id="<?php echo 'collapseThree_' . $task->id; ?>" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
						<div class="card-body">
							<p><?php echo description($task->description); ?></p>

							<?php if ($task->files->count() && (!strpos($task->description, '[') && !strpos($task->description, ']'))): ?>
								<hr>
								<b>Archivos adjuntos</b>
								<br><br>
								<?php foreach ($task->files as $file): ?>
									<a title="Clic aquí para ver archivo" <?php lightbox($file->file, $task->title); ?> target="_blank" class="d-block d-sm-inline mr-3 attach <?php modal($file->file); ?>" href="<?php echo url('/resources/assets/files/' . $file->file . '?v=' . rand(9, 99999)); ?>">
										<i class="<?php echo icon_file($file->file); ?>"></i> <?php echo $file->file; ?>
									</a>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>

						<div class="card-footer text-right">
							<button title="Editar tarea" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="<?php echo '#edit_task_' . $task->id; ?>"><i class="fa fa-edit"></i></button>
							<button title="Ver o agregar comentarios" class="btn btn-info btn-sm" data-toggle="modal" data-target="<?php echo '#comments_' . $task->id; ?>"><i class="fa fa-comments"></i></button>

							<?php if ($task->status): ?>
								<button class="btn btn-secondary btn-sm check" data-status="0" title="Marcar tarea como no finalizada" data-id="<?php echo $task->id; ?>"><i class="far fa-circle"></i></button>
							<?php else: ?>
								<button class="btn btn-success btn-sm check" data-status="1" title="Marcar tarea como finalizada" data-id="<?php echo $task->id; ?>"><i class="fa fa-check"></i></button>
							<?php endif; ?>

							<button class="btn btn-info btn-sm" title="Gestión de archivos" data-toggle="modal" data-target="<?php echo '#files_' . $task->id; ?>"><i class="fa fa-file"></i></button>

							<button title="Mover tarea a otro proyecto" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="<?php echo '#move_task_' . $task->id; ?>"><i class="fas fa-compress-alt"></i></button>

							<button class="btn btn-danger btn-sm delete_task" title="Eliminar tarea" data-id="<?php echo $task->id; ?>" data-slug="<?php echo $project->slug; ?>"><i class="fa fa-trash"></i></button>
						</div>
					</div>
				</div>

				<?php include 'edit_task.php'; ?>
				<?php include 'move_task.php'; ?>
				<?php include 'comments.php'; ?>
				<?php include 'files.php'; ?>
			<?php endforeach; ?>
		</div>

	<?php else: ?>
		<div class="alert alert-info">No se han registrado tareas en este proyecto</div>
	<?php endif; ?>
</div>
<!-- /.container-fluid -->

<input type="hidden" name="slug" value="<?php echo $project->slug; ?>">

<?php include 'create_task.php'; ?>
<?php include 'edit_project.php'; ?>
<?php include 'view_doc.php'; ?>

<script src="<?php asset('js/comments.js'); ?>"></script>
<script src="<?php asset('js/files.js'); ?>"></script>
<script src="<?php asset('js/projects.js'); ?>"></script>
<script src="<?php asset('js/tasks.js'); ?>"></script>
