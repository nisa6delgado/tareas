<div class="modal fade" id="create_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar nueva tarea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form class="store_task">
                <div class="modal-body">
                    <div class="row">                    
                        <div class="col-md-12">
                            <input type="hidden" name="id_project" value="<?php echo $project->id; ?>">

                            <div class="form-group">
                                <label for="title">Título</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea id="description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="files">Archivos</label><br>
                                <input type="file" name="files" multiple>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                        Cerrar
                    </button>

                    <button type="submit" class="btn btn-primary store_task_button">
                        <i class="fa fa-save"></i>
                        Crear
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>