
document.addEventListener('DOMContentLoaded', function() {
    const logo = document.getElementById('logo');
    if (logo) {
        logo.addEventListener('click', function() {
            window.location.href = 'catalogo.php';
        });
    }

   
});
