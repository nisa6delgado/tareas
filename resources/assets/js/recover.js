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

	password = $('[name=password]').val();
	confirm_password = $('[name=confirm_password]').val();

	if (password != confirm_password) {
		Swal.fire({
			title: '¡Las contraseñas no coinciden!',
			icon: 'error',
			confirmButtonColor: 'black'
		});

		$('.submit').html('Cambiar contraseña');

		return false;
	}

	$.ajax({
		type: 'POST',
		url: '',
		data: data,
		success: function (response) {
			console.log(response);

			if (response == 'Enlace enválido') {
				Swal.fire({
					title: '¡Este enlace es inválido!',
					icon: 'error',
					confirmButtonColor: 'black'
				});

				$('.submit').html('Cambiar contraseña');

				return false;
			}

			Swal.fire({
				title: 'Contraseña cambiada exitosamente, ahora puedes iniciar sesión',
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


$('.password').click(function () {
	type = ($(this).parent().parent().find('input').attr('type') == 'password') ? 'text' : 'password';
	$(this).parent().parent().find('input').attr('type', type);
});