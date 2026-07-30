const FormateurRules = {

    1:{
        Nom_formateur:[
            "required"
        ],

        Prenom_formateur:[
            "required"
        ],

        specialites:[
            "required"
        ]
    },

    2:{
        email:[
            "emailOrTelephone",
            "email"
        ],

        telephone:[
            "emailOrTelephone",
            "telephone"
        ]
    }
};

function validerChampFormateur(input, regles) {
    // On efface l'ancienne erreur
    effacerErreur(input);

    for (const regle of regles) {

        // REQUIRED
        if (regle === "required") {
            // Cas d'une liste multiple
            if (input.id === "specialites") {

                const checked = document.querySelectorAll(
                    'input[name="specialites[]"]:checked'
                );

                if (checked.length === 0) {
                    afficherErreur(input, "Veuillez sélectionner au moins une spécialité.");
                    return false;
                    
                }
            }
            // Cas d'un champ texte
            else {
                if (input.value.trim() === "") {
                    afficherErreur(input, messages.required);
                    return false;
                }
            }
        }

        // EMAIL OU TELEPHONE
        if (regle === "emailOrTelephone") {

            const email = document.getElementById("email").value.trim();
            const telephone = document.getElementById("telephone").value.trim();

            if(email === "" && telephone === ""){
                afficherErreur(document.getElementById("email"), messages.emailOrTelephone);
                afficherErreur(document.getElementById("telephone"), messages.emailOrTelephone);
                return false;
            }
            effacerErreur(document.getElementById("email"));
            effacerErreur(document.getElementById("telephone"));
        }

        //EMAIL
        if(regle === "email"){

            if(input.value.trim() === ""){
                continue;
            }

            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if(!regex.test(input.value.trim())){
                afficherErreur(input, messages.email);
                return false;
            }
        }

        // TELEPHONE
        if (regle === "telephone") {

            if (input.value.trim() === "") {
                continue;
            }

            const regex = /^(\+261|261|0)(32|33|34|38)\d{7}$/;

            if (!regex.test(input.value.trim())) {
                afficherErreur(input, messages.telephone);
                return false;
            }
        }
    }
    return true;
}

document.addEventListener("DOMContentLoaded", function () {
    for (const etape in FormateurRules) {
        for (const id in FormateurRules[etape]) {
            const input = document.getElementById(id);

            if (!input) continue;

            input.addEventListener("input", function () {
                validerChampFormateur(input, FormateurRules[etape][id]);
            });

            input.addEventListener("change", function () {
                validerChampFormateur(input, FormateurRules[etape][id]);
            });
        }
    }
});


document.querySelectorAll('input[name="specialites[]"]').forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
        const checked = document.querySelectorAll(
            'input[name="specialites[]"]:checked'
        );
        if (checked.length > 0) {
            effacerErreur(document.getElementById("specialites"));
        }
    });
});

// Vérification dynamique Email / Téléphone
document.getElementById("email").addEventListener("input", verifierEmailTelephone);
document.getElementById("telephone").addEventListener("input", verifierEmailTelephone);

function verifierEmailTelephone() {

    const email = document.getElementById("email");
    const telephone = document.getElementById("telephone");

    // Si au moins un des deux est rempli,
    // on efface les erreurs "champ obligatoire"
    if (email.value.trim() !== "" || telephone.value.trim() !== "") {
        effacerErreur(email);
        effacerErreur(telephone);
    }

    // Vérification du format de l'email
    if (email.value.trim() !== "") {

        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!regex.test(email.value.trim())) {
            afficherErreur(email, messages.email);
        } else {
            effacerErreur(email);
        }
    }

    //vérification du format du téléphone malgache
    if (telephone.value.trim() !== "") {

        const regex = /^(\+261|261|0)(32|33|34|38)\d{7}$/;

        if (!regex.test(telephone.value.trim())) {
            afficherErreur(telephone, messages.telephone);
        } else {
            effacerErreur(telephone);
        }
    }
}

function validerEtapeFormateur(numero) {

    let valide = true;

    const champs = FormateurRules[numero];
    for (const id in champs) {
        const input = document.getElementById(id);
        if (!validerChampFormateur(input, champs[id])) {
            valide = false;
        }
    }
    return valide;
}
//Gestion des étapes du formulaire
function passerEtapeFormateur(step) {
    if (validerEtapeFormateur(step)) {
        etapeSuivante(step, step + 1);
        updateProgress(step + 1);
    }
}

function envoyerFormulaireFormateur() {

    // Vérifie toute l'étape 2
    if (!validerEtapeFormateur(2)) {
        return;
    }

    // Si tout est correct, on envoie le formulaire
    document.getElementById("form_principale").submit();
}