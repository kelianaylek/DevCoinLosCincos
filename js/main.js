// Script pour le dark mode
var url = window.location.pathname;
var splitUrl = url.split("/");
var lastWordUrl = splitUrl[splitUrl.length - 1];

// On crée les conditions de vérification de la page sur laquelle on est
var isOnMainPage = lastWordUrl == "index.html";
var isOnAskQuestionPage = lastWordUrl == "askQuestion.html";
var isOnLookQuestionsPage = lastWordUrl == "lookQuestions.html";
var isOnProfilPage = lastWordUrl == "profil.html";
var isOnQuestionPage = lastWordUrl == "question.html";

// On sélectionne le bouton darkMode
let btnSwitch = $("#darkMode");

// Si on est en white mode dans le local storage
if (localStorage.currentTheme == null) {
    console.log('currentTheme does not exist', )
    localStorage.currentTheme = "whiteMode"

    // Si on est en white mode dans le local storage
} else {
    console.log('CurrentTheme does exist', )
    console.log('Localstorage: ', localStorage.currentTheme)
    updateUI();

}

// Update du mode en fonction du thème actuel
function updateUI() {
    if (localStorage.currentTheme == "darkMode") {
        // On check si on est sur la page principale
        if (isOnMainPage) {
            $("body").addClass("black")
            $(".maincontainer section").addClass("black")
            $(".maincontainer section div").addClass("text")
            $(".backgroundmobile .background").addClass("bgdc")
            $(".backgroundDesktop .background").addClass("bgdc")
            $(".footer").addClass("mainFooterBlack")
        }
        // On check si on est sur la page poser une question
        else if (isOnAskQuestionPage) {
            $("body").addClass("black")
            $(".footerDesktop").addClass("footerBlack")
            $(".footerMobile").addClass("footerBlack")
        }
        // On check si on est sur la page voir les questions
        else if (isOnLookQuestionsPage) {
            $("body").addClass("black")
            $("main").addClass("black")
            $(".filters").addClass("filtersBlack")
            $(".fa-picture-o").addClass("pictoBlack")
            $(".informationsProblem a, .informationsProblemMobile a").addClass("pictoBlack")
        }
        // On check si on est sur la page profil
        else if (isOnProfilPage) {
            // On change le texte du bouton
            $(btnSwitch).text("WHITE MODE")

            // On change le style de la page
            $("body").addClass("black")
            $(".annee").addClass("black")
            $(".annee").addClass("blackAnnee")
            $(".annee p").addClass("blackAnnee p")
            $(".annee div a").addClass("blackAnnee div a")
            $(".footerDesktop").addClass("footerBlack")
            $(".footerMobile").addClass("footerBlack")
            $(".containerProfil button").addClass("buttonBlack")
        }
    } else if (localStorage.currentTheme == "whiteMode") {
        // On check si on est sur la page principale
        if (isOnMainPage) {
            $("body").removeClass("black")
            $(".maincontainer section").removeClass("black")
            $(".maincontainer section div").removeClass("text")
            $(".backgroundmobile .background").removeClass("bgdc")
            $(".backgroundDesktop .background").removeClass("bgdc")
            $(".footer").removeClass("mainFooterBlack")
        }
        // On check si on est sur la page poser une question
        else if (isOnAskQuestionPage) {
            $("body").removeClass("black")
            $(".footerDesktop").removeClass("footerBlack")
            $(".footerMobile").removeClass("footerBlack")
        }
        // On check si on est sur la page profil
        else if (isOnProfilPage) {
            // On change le texte du bouton
            $(btnSwitch).text("DARK MODE")

            // On change le style de la page
            $("body").removeClass("black")
            $(".annee").removeClass("black")
            $(".annee").removeClass("blackAnnee")
            $(".annee p").removeClass("blackAnnee p")
            $(".annee div a").removeClass("blackAnnee div a")
            $(".footerDesktop").removeClass("footerBlack")
            $(".footerMobile").removeClass("footerBlack")
            $(".containerProfil button").removeClass("buttonBlack")
        }
    }
}
// Au click, déclenche la fonction updateUI() en fonction du mode dans lequel on est
$(btnSwitch).click(
    function() {
        if (localStorage.currentTheme == "darkMode") {
            localStorage.currentTheme = "whiteMode"
            console.log('Localstorage: ', localStorage.currentTheme)
            updateUI();

        } else if (localStorage.currentTheme == "whiteMode") {
            localStorage.currentTheme = "darkMode"
            console.log('Localstorage: ', localStorage.currentTheme)
            updateUI();

        }
        updateUI();
    }
)