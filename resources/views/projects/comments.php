<div class="modal fade" id="<?php echo 'comments_' . $task->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comentarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="send_comment">                    
                    <div class="comments">
                        <?php if ($task->comments->count()): ?>
                            <ul class="list-group">
                                <?php foreach ($task->comments as $comment): ?>
                                    <li class="list-group-item">
                                        <?php echo $comment->comment; ?>

                                        <button type="button" onClick="delete_comment(this, '<?php echo $comment->id; ?>')" class="btn btn-danger btn-sm float-right" title="Eliminar este comentario">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <div class="alert alert-info">No se han registrado comentarios en esta tarea</div>
                        <?php endif; ?>
                    </div>

                    <div class="input-group mt-2">
                        <input type="hidden" name="id_task" value="<?php echo $task->id; ?>">

                        <input type="text" class="form-control" required name="comment" placeholder="Escribe aquí tu comentario...">

                        <div class="input-group-append">
                            <button class="btn btn-primary send_comment_button" type="submit">
                                <i class="fa fa-comments"></i>
                                Enviar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>