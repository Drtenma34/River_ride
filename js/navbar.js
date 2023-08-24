document.addEventListener('DOMContentLoaded', function() {
    console.log("Le script est chargé.");

    var dropdown = document.getElementById('navbarDropdown');
    var dropdownMenu = document.getElementById('dropdownMenu');

    dropdown.addEventListener('click', function(event) {
        console.log("J'ai cliqué sur dropdown");
        if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
            dropdownMenu.style.display = 'block';
            console.log("Je m'affiche");
        } else {
            dropdownMenu.style.display = 'none';
            console.log("J'étais affiché mtn je disparais ");
        }
        event.stopPropagation(); // Empêche l'événement de se propager aux éléments parents
    });

    // Fermer le menu déroulant si l'utilisateur clique en dehors de celui-ci
    window.addEventListener('click', function(event) {
        console.log("j'ai cliqué dans ma fenêtre ");
        if (event.target !== dropdown && dropdownMenu.style.display === 'block') {
            dropdownMenu.style.display = 'none';
            console.log("Je clique dans ma fenêtre(en dehors du menu dropdown activé) --> dropdown disparait ");
        }
    });
});