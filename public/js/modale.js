document.addEventListener('DOMContentLoaded', function () {
    // POUR OUVRIR LA MODALE
    var openModalLinks = document.querySelectorAll('.open-modal');

    openModalLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Empêche le comportement par défaut du lien
            var modalId = this.getAttribute('data-id');
            var modal = document.getElementById('modal-' + modalId);
            modal.style.display = 'block';
        });
    });

    // POUR FERMER LA MODALE
    var closeModalButtons = document.querySelectorAll('.close');

    closeModalButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Trouvez l'élément parent modal
            var modal = this.closest('.modal');
            modal.style.display = 'none';
        });
    });
});