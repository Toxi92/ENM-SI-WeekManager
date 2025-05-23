window.onload = function() {
  if (!localStorage.getItem('pageReloaded')) {
      localStorage.setItem('pageReloaded', 'true');
      window.location.reload(true);
  } else {
      localStorage.removeItem('pageReloaded');
  }
};
// Détermine le chemin selon la page courante
let pathClair, pathSombre;
if (window.location.pathname.endsWith('index.php')) {
    pathClair = './styles/style.css';
    pathSombre = './styles/style-dark.css';
} else {
    pathClair = '/../styles/style.css';
    pathSombre = '/../styles/style-dark.css';
}

// Applique le thème sauvegardé au chargement
document.addEventListener('DOMContentLoaded', function () {
    const themeStyle = document.getElementById('Style_theme');
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        themeStyle.setAttribute('href', savedTheme);
    }
    // Ajoute l'écouteur sur le bouton à bascule
    const toggleBtn = document.getElementById('toggleThemeBtn');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            if (!themeStyle) {
                console.error('Style_Theme introuvable !');
                return;
            }
            const currentHref = themeStyle.getAttribute('href');
            let newTheme;
            if (currentHref.endsWith('style-dark.css')) {
                newTheme = pathClair;
            } else {
                newTheme = pathSombre;
            }
            themeStyle.setAttribute('href', newTheme);
            localStorage.setItem('theme', newTheme);
            location.reload(true);
        });
    }
});