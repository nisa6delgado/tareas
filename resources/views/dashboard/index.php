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

	<?php if ($tasks->count()): ?>
		<div id="accordion">
			<?php foreach ($tasks as $task): ?>
				<div class="card">
					<div class="card-header" id="headingThree">
						<h5 class="mb-0">
							<button title="Click aquí para ver más información" class="btn btn-link collapsed text-left" data-toggle="collapse" data-target="#<?php echo 'collapseThree_' . $task->id; ?>" aria-expanded="false" aria-controls="collapseThree">
								<?php echo $task->title; ?>

								<span class="badge badge-secondary" style="background-color: <?php echo $task->project->color; ?>">
									<i class="<?php echo $task->project->icon; ?>"></i>
									<?php echo $task->project->name; ?>									
								</span>
							</button>
						</h5>
					</div>

					<div id="<?php echo 'collapseThree_' . $task->id; ?>" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
						<div class="card-body">
							<p><?php echo description($task->description); ?></p>

							<?php if ($task->files->count() && strpos($task->description, '![') === false): ?>
								<hr>
								<b>Archivos adjuntos</b>
								<br><br>
								<?php foreach ($task->files as $file): ?>
									<a title="Clic aquí para ver archivo" <?php lightbox($file->file, $task->title); ?> target="_blank" class="d-block d-sm-inline mr-3 attach <?php modal($file->file); ?>" href="<?php echo url('/resources/assets/files/' . $file->file . '?v=' . rand(9, 999999)); ?>">
										<i class="<?php echo icon_file($file->file); ?>"></i> <?php echo $file->file; ?>
									</a>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>

						<div class="card-footer text-right">
							<?php if ($task->status): ?>
								<button class="btn btn-secondary btn-sm check" data-status="0" title="Marcar tarea como no finalizada" data-id="<?php echo $task->id; ?>"><i class="far fa-circle"></i></button>
							<?php else: ?>
								<button class="btn btn-success btn-sm check" data-status="1" title="Marcar tarea como finalizada" data-id="<?php echo $task->id; ?>"><i class="fa fa-check"></i></button>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

	<?php else: ?>
		<div class="alert alert-info">No se han registrado recientemente</div>
	<?php endif; ?>
</div>

<?php include 'create_project.php'; ?>
<?php include 'view_doc.php'; ?>

<script src="<?php asset('js/dashboard.js'); ?>"></script>
