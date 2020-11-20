$(document).ready(function() {


    let btn = $("#myBtn");
    let btnInsc = $("#myBtn2");
    let span = $(".close");
    let modal = $("#myModal");




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

    /*POPUP RESPONSIVE*/
    let arrow = $("#firstarrow i");
    let textarrowdown = '<p class="textAdded">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore</p>'

    let isDown = true;
    arrow.click(function() {
        arrow.toggleClass("fa-arrow-circle-up")
        if (isDown == true) {
            $(".addtext").append(textarrowdown)
            isDown = false
        } else {
            $('.textAdded').remove()
            isDown = true
        }

    })

})