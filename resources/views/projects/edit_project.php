<div class="modal fade" id="edit_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar proyecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="edit_project">
                <input type="hidden" name="id" value="<?php echo $project->id; ?>">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $project->name; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="text" name="color" class="form-control" value="<?php echo $project->color; ?>">
                            </div>

                            <div class="form-group">
                                <label for="icon">Ícono</label>
                                <input type="text" name="icon" class="form-control" value="<?php echo $project->icon; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                    <button type="submit" class="btn btn-primary edit_project_button"><i class="fa fa-save"></i> Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>