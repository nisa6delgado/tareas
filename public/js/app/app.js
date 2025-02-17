document.addEventListener('keydown', function (event) {
    if (event.ctrlKey && event.key == 'h') {
        event.preventDefault();
        window.location.href = '/';
    }
});