$('form').submit(function (event) {
	event.preventDefault();

	$('.submit').html(`
		<div class="text-center">
			<div class="spinner-border spinner-border-sm" role="status">
				<span class="sr-only">Cargando...</span>
			</div>
		</div>
	`);

	data = $('form').serialize();

	$.ajax({
		type: 'POST',
		url: '/forgot',
		data: data,
		success: function (response) {
			if (response == 'Este correo electrónico no se encuentra registrado') {
				Swal.fire({
					title: '¡Este correo electrónico no se encuentra registado!',
					icon: 'error',
					confirmButtonColor: 'black'
				});

				$('.submit').html('Recuperar contraseña');

				return false;
			}

			Swal.fire({
				title: 'Revise su correo electrónico para recuperar su contraseña',
				icon: 'success',
				confirmButtonColor: 'black'
			});

			$('.submit').html('Recuperar contraseña');
		},
		error: function (error) {
			$('body').html(error.responseText);
		}
	});
});