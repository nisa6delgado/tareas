$('.delete_file').click(function () {
	id = $(this).attr('data-id');
	instance = $(this);

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
                url: '/files/delete/' + id,
                success: function (response) {
                    instance.parent().remove();
                },
                error: function (error) {
                    $('.content').html(error.responseText);
                }
            });
        }
    });
});

$('.files_modal').on('hide.bs.modal', function () {
	slug = $('[name=slug]').val();
	$('.content').load('/projects/' + slug, function (response, status, xhr) {
		$('.content').html(xhr.responseText);
	});
});

$('.upload_files').submit(function (event) {
	event.preventDefault();

	$(this).find('.upload_files_button').html(`
		<div class="text-center">
			<div class="spinner-border spinner-border-sm" role="status">
				<span class="sr-only">Cargando...</span>
			</div>
		</div>
	`);

	var data = new FormData();
    var files = $(this).find('[name=files]')[0].files;
    
    for (var i = files.length - 1; i >= 0; i--) {
    	data.append('files[]', files[i]);
    }
    
    data.append('id_task', $(this).find('[name=id_task]').val());

    $.ajax({
    	type: 'POST',
    	url: '/files/store',
    	contentType: false,
        processData: false,
    	data: data,
    	success: function (response) {
    		console.log(response);

    		Swal.fire({
				title: '¡Archivos subidos exitosamente!',
				text: 'Se han subido nuestros archivos en esta rea',
				icon: 'success',
				confirmButtonColor: 'black'
			}).then(() => {
				$('.modal').modal('hide');
			});
    	},
    	error: function (error) {
    		$('body').html(error.responseText);
    	}
    });
});