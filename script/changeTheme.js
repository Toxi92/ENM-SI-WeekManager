window.onload = function() {
  if (!localStorage.getItem('pageReloaded')) {
      localStorage.setItem('pageReloaded', 'true');
      window.location.reload(true);
      console.log('Test1');
  } else {
      localStorage.removeItem('pageReloaded');
        console.log('Test2');
  }
};
console.log('Test3');
// Détermine le chemin selon la page courante
let pathClair, pathSombre;
if (window.location.pathname.endsWith('index.php')) {
    console.log('Test4');
    pathClair = './styles/style.css';
    pathSombre = './styles/style-dark.css';
} else {
    console.log('Test5');
    pathClair = '/../styles/style.css';
    pathSombre = '/../styles/style-dark.css';
}

// Applique le thème sauvegardé au chargement
document.addEventListener('DOMContentLoaded', function () {
    console.log('Test6');
    const themeStyle = document.getElementById('Style_theme');
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        console.log('Test7');
        themeStyle.setAttribute('href', savedTheme);
    }
    // Ajoute l'écouteur sur le bouton à bascule
    const toggleBtn = document.getElementById('toggleThemeBtn');
    console.log('Test8');
    if (toggleBtn) {
        console.log('Test9');
        toggleBtn.addEventListener('click', function () {
            if (!themeStyle) {
                console.error('Style_Theme introuvable !');
                return;
            }
            const currentHref = themeStyle.getAttribute('href');
            let newTheme;
            if (currentHref.endsWith('style-dark.css')) {
                console.log('Test10');
                newTheme = pathClair;
            } else {
                console.log('Test11');
                newTheme = pathSombre;
            }
            console.log('Test12');
            themeStyle.setAttribute('href', newTheme);
            localStorage.setItem('theme', newTheme);
            location.reload(true);
        });
    }
});