document.addEventListener("DOMContentLoaded", () => {
        // Toggle changement mot de passe
        document.getElementById('showChangePwdBtn').onclick = function() {
            var form = document.getElementById('changePwdForm');
            form.style.display = (form.style.display === 'none') ? 'block' : 'none';
        };
        // Ne cibler que les boutons d'édition du profil
        const buttons = document.querySelectorAll(".DivProfil .edit-btn");

        buttons.forEach(button => {
            button.addEventListener("click", () => {
                const input = button.previousElementSibling; // Champ d'entrée associé au bouton

                if (button.textContent === "Modifier" || button.textContent === "Edit") {
                    // Rendre le champ modifiable
                    input.removeAttribute("readonly");
                    input.focus();
                    button.textContent = "Sauvegarder";
                    button.style.backgroundColor = "#28a745"; // Vert
                } else {
                    // Sauvegarder les modifications
                    input.setAttribute("readonly", "readonly");
                    button.textContent = "Modifier";
                    button.style.backgroundColor = "#007BFF"; // Bleu par défaut

                    // Vous pouvez envoyer les données modifiées au serveur ici via AJAX ou un formulaire
                    const data = {
                        field: input.id, // ID du champ (ex: "nom", "prenom", etc.)
                        value: input.value // Nouvelle valeur du champ
                    };
    
                    fetch("../controlleur/controlleur_monprofil.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => {
                        if (response.ok) {
                            console.log(`Champ ${data.field} sauvegardé avec succès : ${data.value}`);
                        } else {
                            console.error(`Erreur lors de la sauvegarde du champ ${data.field}.`);
                        }
                    })
                    .catch(error => {
                        console.error("Erreur réseau :", error);
                    });

                }
            });
        });
    });
