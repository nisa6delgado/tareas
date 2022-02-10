function app() {
    return {
        confirmDelete (event, element, ajax = null) {
            event.preventDefault();

            Swal.fire({
                title: '¿Está seguro que desea eliminar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                confirmButtonColor: 'black',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (ajax) {
                        fetch(element.href)
                            .then(response => response.json())
                            .then(data => console.log(data));

                        element.parentElement.remove();

                        return false;
                    }

                    return window.location.href = element.href;
                }
            });
        }
    }
}
