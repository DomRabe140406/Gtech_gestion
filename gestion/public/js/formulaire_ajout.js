function etapeSuivante(maintenant,suivante)
{
    document.getElementById("etape" + maintenant).classList.remove("active");
    document.getElementById("etape" + suivante).classList.add("active");
}

function etapePrecedente(maintenant,precedente)
{
    document.getElementById("etape" + maintenant).classList.remove("active");
    document.getElementById("etape" + precedente).classList.add("active");
}

function annulerForm(){
    let confirmation = confirm("Voulez-vous annuler le formulaire ?");

    if(confirmation){
        window.location.href= "/dashboard";
    }
}

function updateProgress(step)
{
    let progress = document.getElementById("progress");

    if(step == 1)
        progress.style.width = "33%";

    if(step == 2)
        progress.style.width = "66%";

    if(step == 3)
        progress.style.width = "100%";
}


function updateProgressFacture(step)
    {
        const largeurs = {1:25, 2:50, 3:75, 4:100};

        const stepLabel = document.getElementById("stepLabelFacture");
        const stepPercent = document.getElementById("stepPercentFacture");

        if (stepLabel) stepLabel.textContent = "Étape " + step + " sur 4";
        if (stepPercent) stepPercent.textContent = Math.round(largeurs[step]) + "%";

        for (let i = 1; i <= 4; i++) {
            const segment = document.getElementById("segmentFacture" + i);
            if (!segment) continue;

            if (i <= step) {
                segment.classList.remove("bg-gray-200", "dark:bg-gray-700");
                segment.classList.add("bg-blue-500");
            } else {
                segment.classList.remove("bg-blue-500");
                segment.classList.add("bg-gray-200", "dark:bg-gray-700");
            }
        }
    }