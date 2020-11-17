var btn = $("#myBtn");
var btnInsc = $("#myBtn2");
var span = $(".close");
var modal = $("#myModal");


// Ouvre le fond gris lors du click
btn.click(function() {
    $(".Hmodal").css({ "display": "block" });
})

btnInsc.click(function() {
        $(".Hmodal2").css({ "display": "block" });
    })
    // Quand click sur la croix close le popup

span.click(function() {
    $(".Hmodal").css({ "display": "none" });
})

span.click(function() {
    $(".Hmodal2").css({ "display": "none" });
})

// Ferme le popup si l'utilisateur clique autre pars que sur le popup
/*window.onclick = function(event) {
    if (event.target == modal) {
        $(".modal").css({ "display": "block" });
    }
}*/

/*modal.click(function(event) {
    if (event.target == $('.modal-content')) {
        $(".modal").css({ "display": "none" });
    }
})*/