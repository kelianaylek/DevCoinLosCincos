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
    let arrow = $("#scrolldown");
    arrow.click(function(e) {
        e.preventDefault();
        let arrowup = '<a href="#" id="scrollup"><i class="fa fa-arrow-circle-up fa-2x" aria-hidden="true"></i></a>'
        let textarrowdown = '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore</p>'
        $(".addtext").append(textarrowdown);
        $("#firstarrow a").remove()
        $("#firstarrow").append(arrowup)

    })
    let arrowreverse = $("#scrollup")
    arrowreverse.click(function(e) {
        e.preventDefault();
        console.log('kélian')
        let arrowdown = '<a href="#" id="scrolldown"><i class="fa fa-arrow-circle-down fa-2x" aria-hidden="true"></i></a>'
        $(textarrowdown).remove()
        $(arrowup).remove()
        $("#firstarrow").append(arrowdown)
    })
})