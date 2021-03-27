$('.create_project').submit(function (event) {
	event.preventDefault();

	$('.create_project_button').html(`
		<div class="text-center">
			<div class="spinner-border spinner-border-sm" role="status">
				<span class="sr-only">Cargando...</span>
			</div>
		</div>
	`);

	$.ajax({
		type: 'POST',
		url: '/projects/store',
		data: $(this).serialize(),
		success: function (response) {
			console.log(response);

    		Swal.fire({
				title: '¡Proyecto creado satisfactoriamente!',
				text: 'Se ha creado un nuevo proyecto',
				icon: 'success',
				confirmButtonColor: 'black'
			}).then(() => {
				window.location.href = '/';
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
                $('.content').load('/', function (response, status, xhr) {
                    $('.content').html(xhr.responseText);
                });
            });
        },
        error: function (error) {
            $('body').html(error.responseText);
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
