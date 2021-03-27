datatable = $('#datatables').DataTable({
	"responsive": true,
	"order": [[0, 'desc']],
	"language": {
		"decimal":        "",
	    "emptyTable":     "No hay datos",
	    "info":           "Mostrando del _START_ al _END_ de _TOTAL_",
	    "infoEmpty":      "Mostrando del 0 al 0 de 0",
	    "infoFiltered":   "(filtrado de un total de _MAX_)",
	    "infoPostFix":    "",
	    "thousands":      ",",
	    "lengthMenu":     "Mostrar _MENU_",
	    "loadingRecords": "Cargando...",
	    "processing":     "Procesando...",
	    "search":         "Buscar:",
	    "zeroRecords":    "No hay resultados",
	    "paginate": {
	        "first":      "Primero",
	        "last":       "Último",
	        "next":       "Siguiente",
	        "previous":   "Anterior"
	    }
	}
});

if (typeof dt !== 'undefined') {
	new $.fn.dataTable.FixedHeader(datatable);
}

$('#user').change(function () {
	input = this;
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (event) {
			$('.user_photo').attr('src', event.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
});


$('.create').click(function (event) {
	event.preventDefault();

	$('.content').html(`
		<div class="text-center">
			<div class="spinner-border mt-5" style="width: 10rem; height: 10rem;" role="status">
				<span class="sr-only">Cargando...</span>
			</div>
		</div>
	`);

	$('.content').load('/users/create', function (response, status, xhr) {
		$('.content').html(xhr.responseText);
	});
});


$('.store').submit(function (event) {
	event.preventDefault();

	$('.submit').html(`
		<div class="text-center">
			<div class="spinner-border spinner-border-sm" role="status">
				<span class="sr-only">Cargando...</span>
			</div>
		</div>
	`);

	password = $('[name=password]').val();
	confirm_password = $('[name=confirm_password]').val();

	if (password != confirm_password) {
		Swal.fire({
			title: '¡Las contraseñas no coinciden!',
			icon: 'error',
			confirmButtonColor: 'black'
		});

		$('.submit').html(`
			<i class="fa fa-save"></i> Crear usuario
		`);

		return false;
	}

	var data = new FormData();
    var file = $('[name=photo]')[0].files[0];
    data.append('photo', file);
    data.append('name', $('[name=name]').val());
    data.append('email', $('[name=email]').val());
    data.append('password', $('[name=password]').val());

	$.ajax({
		type: 'POST',
		url: '/users/store',
		data: data,
		contentType: false,
        processData: false,
		success: function (response) {
			if (response == 'Correo electrónico existe') {
				Swal.fire({
					title: '¡Correo electrónico ya existe!',
					icon: 'error',
					confirmButtonColor: 'black'
				});

				$('.submit').html(`
					<i class="fa fa-save"></i> Crear usuario
				`);

				return false;
			}

			Swal.fire({
				title: '¡Usuario creado exitosamente!',
				text: 'Se ha creado un nuevo usuario',
				icon: 'success',
				confirmButtonColor: 'black'
			}).then(() => {
				$('.content').load('/users', function (response, status, xhr) {
					$('.content').html(xhr.responseText);
				});
			});
		},
		error: function (error) {
			$('.content').html(error.responseText);
		}
	});
});


$('.edit').click(function (event) {
	event.preventDefault();

	$('.content').html(`
		<div class="text-center">
			<div class="spinner-border mt-5" style="width: 10rem; height: 10rem;" role="status">
				<span class="sr-only">Cargando...</span>
			</div>
		</div>
	`);

	route = $(this).attr('href');

	$('.content').load(route, function (response, status, xhr) {
		$('.content').html(xhr.responseText);
	});
});


$('.update').submit(function (event) {
	event.preventDefault();

	$('.submit').html(`
		<div class="text-center">
			<div class="spinner-border spinner-border-sm" role="status">
				<span class="sr-only">Cargando...</span>
			</div>
		</div>
	`);

	password = $('[name=password]').val();
	confirm_password = $('[name=confirm_password]').val();

	if (password != confirm_password) {
		Swal.fire({
			title: '¡Las contraseñas no coinciden!',
			icon: 'error',
			confirmButtonColor: 'black'
		});

		$('.submit').html(`
			<i class="fa fa-save"></i> Editar usuario
		`);

		return false;
	}

	var data = new FormData();
    var file = $('[name=photo]')[0].files[0];
    data.append('photo', file);
    data.append('name', $('[name=name]').val());
    data.append('email', $('[name=email]').val());
    data.append('password', $('[name=password]').val());
    data.append('id', $('[name=id]').val());

	$.ajax({
		type: 'POST',
		url: '/users/update',
		data: data,
		contentType: false,
        processData: false,
		success: function (response) {
			console.log(response);

			if (response == 'Correo electrónico existe') {
				Swal.fire({
					title: '¡Correo electrónico ya existe!',
					icon: 'error',
					confirmButtonColor: 'black'
				});

				$('.submit').html(`
					<i class="fa fa-save"></i> Editar usuario
				`);

				return false;
			}

			if (response != '') {
				$('.img-profile').attr('src', response.photo);
				$('.username').text(response.name);
			}

			Swal.fire({
				title: '¡Usuario editado exitosamente!',
				text: 'Se ha editado un usuario',
				icon: 'success',
				confirmButtonColor: 'black'
			}).then(() => {
				$('.content').load('/users', function (response, status, xhr) {
					$('.content').html(xhr.responseText);
				});
			});
		},
		error: function (error) {
			$('.content').html(error.responseText);
		}
	});
});


$('.delete').click(function (event) {
	event.preventDefault();

	route = $(this).attr('href');

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
				url: route,
				success: function (response) {
					Swal.fire({
						title: '¡Eliminado!',
						text: 'Has eliminado este elemento',
						icon: 'success',
						confirmButtonColor: 'black'
					}).then(() => {
						$('.content').load('/users', function (response, status, xhr) {
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


$('.cancel').click(function (event) {
	event.preventDefault();

	$('.content').html(`
		<div class="text-center">
			<div class="spinner-border mt-5" style="width: 10rem; height: 10rem;" role="status">
				<span class="sr-only">Cargando...</span>
			</div>
		</div>
	`);

	$('.content').load('/users', function (response, status, xhr) {
		$('.content').html(xhr.responseText);
	});
});


$('.password').click(function () {
	type = ($(this).parent().parent().find('input').attr('type') == 'password') ? 'text' : 'password';
	$(this).parent().parent().find('input').attr('type', type);
});