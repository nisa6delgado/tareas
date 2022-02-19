function app() {
    return {
        init () {
            document.addEventListener('keydown', event => {
                if (event.ctrlKey && event.key == 'b') {
                    event.preventDefault();
                    window.history.back();
                }

                if (event.ctrlKey && event.key == 'd') {
                    event.preventDefault();
                    document.getElementsByClassName('delete')[0].click();
                }

                if (event.ctrlKey && event.key == 'e') {
                    event.preventDefault();
                    document.getElementsByClassName('edit')[0].click();
                }

                if (event.ctrlKey && event.key == 'h') {
                    event.preventDefault();
                    window.location.href = '/';
                }

                if (event.ctrlKey && event.key == 'l') {
                    event.preventDefault();
                    window.location.href = '/logout';
                }

                if (event.ctrlKey && event.key == 'm') {
                    event.preventDefault();
                    document.getElementsByClassName('create')[0].click();
                }

                if (event.ctrlKey && event.key == 'o') {
                    event.preventDefault();
                    window.location.href = '/backup';
                }

                if (event.ctrlKey && event.key == 'q') {
                    event.preventDefault();

                    if (document.getElementsByClassName('done')[0]) {
                        document.getElementsByClassName('done')[0].click();
                    }

                    if (document.getElementsByClassName('undone')[0]) {
                        document.getElementsByClassName('undone')[0].click();
                    }
                }

                if (event.ctrlKey && event.key == 's') {
                    event.preventDefault();
                    document.getElementsByClassName('save')[0].click();
                }

                if (event.ctrlKey && event.key == 'y') {
                    event.preventDefault();
                    window.location.href = '/configurations';
                }
            });
        },

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
