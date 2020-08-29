$('.send_comment').submit(function (event) {
	event.preventDefault();

	$(this).find('.send_comment_button').html(`
		<div class="text-center">
			<div class="spinner-border spinner-border-sm" role="status">
				<span class="sr-only">Cargando...</span>
			</div>
		</div>
	`);

	instance = $(this);

	$.ajax({
		type: 'POST',
		url: '/comments/store',
		data: $(this).serialize(),
		success: function (response) {
			console.log(response);

			comment = instance.find('[name=comment]').val();

			element = instance.find('.comments').find('.list-group').length;

			if (element) {
				instance.find('.comments').find('.list-group').append(`
					<li class="list-group-item">
                        ${comment}

                        <button type="button" class="btn btn-danger btn-sm float-right" onClick="delete_comment(this, '${response.id}')" title="Eliminar este comentario">
                                <i class="fa fa-trash"></i>
                            </button>
                    </li>
				`);
			} else {
				instance.find('.comments').html(`
					<div class="list-group">
						<li class="list-group-item">
                            ${comment}

                            <button type="button" class="btn btn-danger btn-sm float-right" onClick="delete_comment(this, '${response.id}')" title="Eliminar este comentario">
                                <i class="fa fa-trash"></i>
                            </button>
                        </li>
					</div>
				`);
			}

			instance.find('[name=comment]').val('');

			instance.find('.send_comment_button').html(`
				<i class="fa fa-comments"></i>
				Enviar
			`);
		},
		error: function (error) {
			$('body').html(error.responseText);
		}
	});
});

function delete_comment(that, id) {
	Swal.fire({
        title: '¿Está seguro?',
        text: '¡Luego no podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'black',
        confirmButtonText: 'Eliminar',
        cancelButtonColor: '#858796',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: '/comments/delete/' + id,
                success: function (response) {
                    $(that).parent().remove();
                },
                error: function (error) {
                    $('.content').html(error.responseText);
                }
            });
        }
    });
}