document.addEventListener("DOMContentLoaded", () => {
    const toggleButton = document.getElementById("toggleButton");

    toggleButton.addEventListener("click", () => {
        // Inverser le texte du bouton
        const isPlus = toggleButton.textContent === "+";
        toggleButton.textContent = isPlus ? "-" : "+";

        // Appeler le contrôleur PHP pour gérer l'état
        fetch("../controlleur/controlleur_monprofil.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ state: isPlus ? "plus" : "minus" })
        })
        .then(response => {
            if (response.ok) {
                console.log("État mis à jour avec succès.");
            } else {
                console.error("Erreur lors de la mise à jour de l'état.");
            }
        })
        .catch(error => {
            console.error("Erreur réseau :", error);
        });
    });
});