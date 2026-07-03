//Les règles de validation pour chaque champ du formulaire
const rules = {

    1:{
        Ref_formation:[
            "required"
        ],

        Nom_formation:[
            "required"
        ],

        Date:[
            "required",
            "afterToday"
        ],

        Nb_j:[
            "required",
            "min:1"
        ],

        Statut:[
            "required"
        ]
    },
    2:{

        Nb_participant:[
            "required",
            "min:1"
        ]

    }
};
//Les messages d'erreur pour chaque règle de validation
const messages = {
    required:"Ce champ est obligatoire.",
    afterToday:"La date doit être supérieure à aujourd'hui.",
    min:"Valeur trop petite."
};

function validerChamp(input, regles) {

    // On efface l'ancienne erreur
    effacerErreur(input);

    for (const regle of regles) {

        // REQUIRED
        if (regle === "required") {
            if (input.value.trim() === "") {
                afficherErreur(input, messages.required);
                return false;
            }
        }

        // AFTER TODAY
        if (regle === "afterToday") {
            if (input.value === "") {
                continue;
            }

            const aujourd = new Date();
            const yyyy = aujourd.getFullYear();
            const mm = String(aujourd.getMonth() + 1).padStart(2, "0");
            const dd = String(aujourd.getDate()).padStart(2, "0");

            const today = `${yyyy}-${mm}-${dd}`;
            if (input.value <= today) {
                afficherErreur(input, messages.afterToday);
                return false;
            }
        }

        // MIN
        if (regle.startsWith("min")) {
            const minimum = parseInt(regle.split(":")[1]);
            if (Number(input.value) < minimum) {
                afficherErreur(input, messages.min + " (minimum " + minimum + ")");
                return false;
            }
        }
    }
    return true;
}

function validerEtape(numero){
    let valide = true;
    const champs = rules[numero];
    for (const id in champs) {
        const input = document.getElementById(id);
        if (!validerChamp(input, champs[id])) {
            valide = false;
        }
    }
    return valide;
}

function afficherErreur(input,message){
    input.classList.add("border-red-500");
    let erreur=input.nextElementSibling;
    erreur.innerText=message;
}

function effacerErreur(input){
    input.classList.remove("border-red-500");
    let erreur=input.nextElementSibling;
    erreur.innerText="";
}
//Gestion des étapes du formulaire
function passerEtape(step) {
    if (validerEtape(step)) {
        etapeSuivante(step, step + 1);
        updateProgress(step + 1);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    for (const etape in rules) {
        for (const id in rules[etape]) {
            const input = document.getElementById(id);

            if (!input) continue;

            input.addEventListener("input", function () {
                validerChamp(input, rules[etape][id]);
            });

            input.addEventListener("change", function () {
                validerChamp(input, rules[etape][id]);
            });
        }
    }
});

/*DOMContentLoaded : Attends que toute la page HTML soit chargée avant d'exécuter ce code*/