var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];

// Ouvre le fond gris lors du click
btn.onclick = function() {
    modal.style.display = "block";
}

// Quand click sur la croix close le popup
span.onclick = function() {
    modal.style.display = "none";
}

// Ferme le popup si l'utilisateur clique autre pars que sur le popup
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}