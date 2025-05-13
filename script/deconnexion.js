document.getElementById('deconnexion').addEventListener('click', function (e) {
    e.preventDefault(); // Empêche le rechargement de la page
    // Effectuer une requête vers le contrôleur de déconnexion
    fetch('../Controlleur/controlleur_deconnexion.php', {
        method: 'POST'
    })
    .then(response => {
        if (response.ok) {
            // Rediriger l'utilisateur vers la page d'accueil
            window.location.href = './index.php';
        } else {
            console.error('Erreur lors de la déconnexion.');
        }
    })
    .catch(error => {
        console.error('Erreur réseau :', error);
    });
});