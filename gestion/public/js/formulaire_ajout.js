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
        //window.location.href = "liste_formation.php";
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
    let progress = document.getElementById("progress");

    if(step == 1)
        progress.style.width = "25%";

    if(step == 2)
        progress.style.width = "50%";

    if(step == 3)
        progress.style.width = "75%";

    if(step == 4)
        progress.style.width = "100%";
}

function updateProgressFiche(step)
{
    let progress = document.getElementById("progress");

    if(step == 1)
        progress.style.width = "10%";

    if(step == 2)
        progress.style.width = "25%";

    if(step == 3)
        progress.style.width = "35%";

    if(step == 4)
        progress.style.width = "45%";

    if(step == 5)
        progress.style.width = "55%";

    if(step == 6)
        progress.style.width = "65%";

    if(step == 7)
        progress.style.width = "75%";

    if(step == 8)
        progress.style.width = "87.5%";

    if(step == 9)
        progress.style.width = "100%";
}
