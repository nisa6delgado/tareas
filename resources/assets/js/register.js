$('.password').click(function () {
	type = ($(this).parent().parent().find('input').attr('type') == 'password') ? 'text' : 'password';
	$(this).parent().parent().find('input').attr('type', type);
});


$('form').submit(function (event) {
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
			text: '¡Las contraseñas no coinciden!',
			icon: 'error',
			confirmButtonColor: 'black'
		});

		$('.submit').html('Registrar');

		return false;
	}

	data = $('form').serialize();

	$.ajax({
		type: 'POST',
		url: '/logup',
		data: data,
		success: function (response) {
			if (response == 'Correo electrónico ya existe') {
				Swal.fire({
					text: '¡Correo electrónico ya existe!',
					icon: 'error',
					confirmButtonColor: 'black'
				});

				$('.submit').html('Registrar');

				return false;
			}

			Swal.fire({
				text: '¡Registro exitoso, ahora puedes iniciar sesión!',
				icon: 'success',
				confirmButtonColor: 'black'
			}).then(() => {
				window.location.href = '/login';
			});
		},
		error: function (error) {
			$('body').html(error.responseText);
		}
	});
});