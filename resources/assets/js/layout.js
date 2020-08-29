$(document).ready(function () {
	$('.content').html(`
		<div class="text-center">
			<div class="spinner-border mt-5" style="width: 10rem; height: 10rem;" role="status">
				<span class="sr-only">Cargando...</span>
			</div>
		</div>
	`);

	$('.content').load('/dashboard', function (response, status, xhr) {
		$('.content').html(xhr.responseText);
	});
});


$('.menu').click(function (event) {
	event.preventDefault();

	$('.menu').parent().removeClass('active');

	$(this).parent().addClass('active');

	route = $(this).attr('href');

	$('.content').html(`
		<div class="text-center">
			<div class="spinner-border mt-5" style="width: 10rem; height: 10rem;" role="status">
				<span class="sr-only">Cargando...</span>
			</div>
		</div>
	`);

	$('.content').load(route, function (response, status, xhr) {
		$('.content').html(xhr.responseText);
	});

	if ($(window).width() < 768) {
		$("body").toggleClass("sidebar-toggled");
		$(".sidebar").toggleClass("toggled");
		if ($(".sidebar").hasClass("toggled")) {
			$('.sidebar .collapse').collapse('hide');
		};
	};
});


$('.profile').click(function (event) {
	event.preventDefault();

	route = $('.profile').attr('href');

	$('.content').load(route, function (response, status, xhr) {
		$('.content').html(xhr.responseText);
	});	
});
