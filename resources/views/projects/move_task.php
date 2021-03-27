<div class="modal fade" id="<?php echo 'move_task_' . $task->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Mover tarea a otro proyecto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="move_task">
				<input type="hidden" name="id" value="<?php echo $task->id; ?>">

				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="id_project">Proyecto</label>
								<select name="id_project" class="form-control" required>
									<option value=""></option>
									<?php foreach (projects() as $item): ?>
										<option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
					<button type="submit" class="btn btn-primary move_task_button"><i class="fa fa-save"></i> Guardar cambios</button>
				</div>
			</form>
		</div>
	</div>
</div>