$('.user').submit(function () {
	event.preventDefault();

	$('.submit').html(`
		<div class="text-center">
			<div class="spinner-border spinner-border-sm" role="status">
				<span class="sr-only">Cargando...</span>
			</div>
		</div>
	`);

	data = $('.user').serialize();

	$.ajax({
		type: 'POST',
		url: '/login',
		data: data,
		success: function (response) {
			if (response == 'Datos incorrectos') {
				Swal.fire({
					title: '¡Datos incorrectos!',
					icon: 'error',
					confirmButtonColor: 'black'
				});

				$('.submit').html('Iniciar sesión');

				return false;
			}

			window.location.href = '/';
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