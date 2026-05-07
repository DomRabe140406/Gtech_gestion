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
       /* if(confirmation){
            document.getElementById("form_principale").reset();
            document.querySelectorAll(".etape").forEach(etape => {
                etape.classList.remove("active");
            });
            document.getElementById("etape1").classList.add("active")
        }*/
        window.location.href = "liste_formation.php";
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