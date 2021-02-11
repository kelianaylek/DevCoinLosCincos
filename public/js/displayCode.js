$(document).ready(function() {

    // Affichage html
    function displayPopupHtml() {
        var windowHeight = ((document.documentElement.clientHeight) / 100) * 85;
        $('.htmlCodeResponsive').fadeIn('slow');

        $('.htmlCodeResponsive').css({
            "display": "block",
            "position": "absolute",
            "top": "90px",
            "width": "90%",
            "margin": "0 auto"
        })
        $('.htmlCodeResponsive code').css({
            "height": windowHeight,
            "overflow": "auto",
            "resize": "none",
            "position": "relative",
        })

    }

    function closePopupHtml() {
        $('.htmlCodeResponsive').fadeOut('slow');
    }
    // display html
    let btnLookHtml = $("button[name=html]")
    btnLookHtml.click(function() {
            displayPopupHtml();
        })
        // close html
    let btnCloseHtml = $(".popupCloseHtml")
    btnCloseHtml.click(function() {
        closePopupHtml();

    })


    // Affichage css
    function displayPopupCss() {
        var windowHeight = ((document.documentElement.clientHeight) / 100) * 85;
        $('.cssCodeResponsive').fadeIn('slow');

        $('.cssCodeResponsive').css({
            "display": "block",
            "position": "absolute",
            "top": "90px",
            "width": "90%",
            "margin": "0 auto"
        })
        $('.cssCodeResponsive code').css({
            "height": windowHeight,
            "overflow": "auto",
            "resize": "none",
            "position": "relative",
        })

    }

    function closePopupCss() {
        $('.cssCodeResponsive').fadeOut('slow');
    }
    // display css
    let btnLookCss = $("button[name=css]")
    btnLookCss.click(function() {
            displayPopupCss();
        })
        // close css
    let btnCloseCss = $(".popupCloseCss")
    btnCloseCss.click(function() {
        closePopupCss();

    })




    function displayPopupJs() {
        var windowHeight = ((document.documentElement.clientHeight) / 100) * 85;
        $('.jsCodeResponsive').fadeIn('slow');

        $('.jsCodeResponsive').css({
            "display": "block",
            "position": "absolute",
            "top": "90px",
            "width": "90%",
            "margin": "0 auto"
        })
        $('.jsCodeResponsive code').css({
            "height": windowHeight,
            "overflow": "auto",
            "resize": "none",
            "position": "relative",
        })

    }

    function closePopupJs() {
        $('.jsCodeResponsive').fadeOut('slow');
    }
    // display js
    let btnLookJs = $("button[name=js]")
    btnLookJs.click(function() {
            displayPopupJs();
        })
        // close js
    let btnCloseJs = $(".popupCloseJs")
    btnCloseJs.click(function() {
        closePopupJs();

    })
})