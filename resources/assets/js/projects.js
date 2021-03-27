$('.edit_project').submit(function (event) {
	event.preventDefault();

	$('.edit_project_button').html(`
		<div class="text-center">
			<div class="spinner-border spinner-border-sm" role="status">
				<span class="sr-only">Cargando...</span>
			</div>
		</div>
	`);

	id = $('[name=id]').val();

	$.ajax({
		type: 'POST',
		url: '/projects/update/',
		data: $(this).serialize(),
		success: function (response) {
			console.log(response);

    		Swal.fire({
				title: '¡Proyecto editado exitosamente!',
				text: 'Se ha editado este proyecto',
				icon: 'success',
				confirmButtonColor: 'black'
			}).then(() => {
				$('.modal').modal('hide');
				window.location.href = '/';
			});
		},
		error: function (error) {
			$('body').html(error.responseText);
		}
	});
});

$('.delete_project').click(function () {
	id = $(this).attr('data-id');

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
                url: '/projects/delete/' + id,
                success: function (response) {
                    Swal.fire({
                        title: '¡Eliminado!',
                        text: 'Has eliminado este elemento',
                        icon: 'success',
                        confirmButtonColor: 'black'
                    }).then(() => {
                        window.location.href = '/';
                    });
                },
                error: function (error) {
                    $('.content').html(error.responseText);
                }
            });
        }
    });
});

$('.view-doc').click(function (event) {
	if ($(window).width() > 768) {
		event.preventDefault();
		href = $(this).attr('href');
		title = $(this).html();
		$('#view_doc').find('.modal-title').html(title);
		$('#view_doc').find('iframe').attr('src', href);
		$('#view_doc').modal('show');
	}	
});