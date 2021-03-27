$('.store_task').submit(function (event) {
	event.preventDefault();

	$('.store_task_button').html(`
		<div class="text-center">
			<div class="spinner-border spinner-border-sm" role="status">
				<span class="sr-only">Cargando...</span>
			</div>
		</div>
	`);

	var data = new FormData();
    var files = $('.store_task').find('[name=files]')[0].files;
    
    for (var i = files.length - 1; i >= 0; i--) {
    	data.append('files[]', files[i]);
    }
    
    data.append('id_project', $('.store_task').find('[name=id_project]').val());
    data.append('title', $('.store_task').find('[name=title]').val());
    data.append('description', $('.store_task').find('#description').val());

    $.ajax({
    	type: 'POST',
    	url: '/tasks/store',
    	contentType: false,
        processData: false,
    	data: data,
    	success: function (response) {
    		console.log(response);

    		Swal.fire({
				title: '¡Tarea creada exitosamente!',
				text: 'Se ha creado una nueva tarea en este proyecto',
				icon: 'success',
				confirmButtonColor: 'black'
			}).then(() => {
				$('.modal').modal('hide');
				$('.content').load('/projects/' + response, function (response, status, xhr) {
					$('.content').html(xhr.responseText);
				});
			});
    	},
    	error: function (error) {
    		$('body').html(error.responseText);
    	}
    });
});

$('.move_task').submit(function (event) {
    event.preventDefault();

    $(this).find('.move_task_button').html(`
        <div class="text-center">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Cargando...</span>
            </div>
        </div>
    `);

    $.ajax({
        type: 'POST',
        url: '/tasks/move',
        data: $(this).serialize(),
        success: function (response) {
            console.log(response);

            Swal.fire({
                title: '¡Tarea movida exitosamente!',
                text: 'Se ha movido una tarea en este proyecto',
                icon: 'success',
                confirmButtonColor: 'black'
            }).then(() => {
                $('.modal').modal('hide');

                $('.active').removeClass('active');
                $('[href="/projects/' + response + '"]').parent().addClass('active');

                $('.content').load('/projects/' + response, function (response, status, xhr) {
                    $('.content').html(xhr.responseText);
                });
            });
        },
        error: function (error) {
            $('body').html(error.responseText);
        }
    });
});

$('.update_task').submit(function (event) {
    event.preventDefault();

    $(this).find('.update_task_button').html(`
        <div class="text-center">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Cargando...</span>
            </div>
        </div>
    `);

    $.ajax({
        type: 'POST',
        url: '/tasks/update',
        data: $(this).serialize(),
        success: function (response) {
            console.log(response);

            Swal.fire({
                title: '¡Tarea editada exitosamente!',
                text: 'Se ha editado una tarea en este proyecto',
                icon: 'success',
                confirmButtonColor: 'black'
            }).then(() => {
                $('.modal').modal('hide');
                $('.content').load('/projects/' + response, function (response, status, xhr) {
                    $('.content').html(xhr.responseText);
                });
            });
        },
        error: function (error) {
            $('body').html(error.responseText);
        }
    });
});

$('.check').click(function () {
    id = $(this).attr('data-id');
    status = $(this).attr('data-status');

    $(this).html(`
        <div class="text-center">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Cargando...</span>
            </div>
        </div>
    `);

    instance = $(this);

    $.ajax({
        url: '/tasks/status',
        data: {
            id: id,
            status: status
        },
        type: 'POST',
        success: function (response) {
            console.log(response);

            if (status == 1) {
                text = 'realizada';
            } else {
                text = 'no realizada';
            }

            Swal.fire({
                title: '¡Tarea marcada ' + text + '!',
                text: 'Se ha marcado esta tarea como ' + text,
                icon: 'success',
                confirmButtonColor: 'black'
            }).then(() => {
                $('.modal').modal('hide');
                $('.content').load('/projects/' + response, function (response, status, xhr) {
                    $('.content').html(xhr.responseText);
                });
            });
        },
        error: function (error) {
            $('body').html(error.responseText);
        }
    });
});

$('.delete_task').click(function () {
    id = $(this).attr('data-id');
    slug = $(this).attr('data-slug');

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
                url: '/tasks/delete/' + id,
                success: function (response) {
                    Swal.fire({
                        title: '¡Eliminado!',
                        text: 'Has eliminado este elemento',
                        icon: 'success',
                        confirmButtonColor: 'black'
                    }).then(() => {
                        $('.content').load('/projects/' + slug, function (response, status, xhr) {
                            $('.content').html(xhr.responseText);
                        });
                    });
                },
                error: function (error) {
                    $('.content').html(error.responseText);
                }
            });
        }
    });
});