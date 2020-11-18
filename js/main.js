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
        $("header nav").addClass("borderBottomOrange")
        $("body").addClass("black")
        // On check si on est sur la page principale
        if (isOnMainPage) {
            $(".maincontainer section").addClass("black")
            $(".maincontainer section div").addClass("whiteColor")
            $(".backgroundmobile .background").addClass("bgdc")
            $(".backgroundDesktop .background").addClass("bgdc")
            $(".footer").addClass("borderOrange")
        }
        // On check si on est sur la page poser une question
        else if (isOnAskQuestionPage) {
            $(".footerDesktop").addClass("borderTopOrange")
            $(".footerMobile").addClass("borderTopOrange")
        }
        // On check si on est sur la page voir les questions
        else if (isOnLookQuestionsPage) {
            $("main").addClass("black")
            $(".filters").addClass("borderOrange")
            $(".fa-picture-o").addClass("whiteColor")
            $(".informationsProblem a, .informationsProblemMobile a").addClass("orangeColor")
            $(".allQuestions section .informationsProblem>div i, .allQuestions section .informationsProblem>div>p").addClass("whiteColor")
            $(".allQuestions section").addClass("borderRadiusOrange")
            $(".footerDesktop").addClass("borderTopOrange")
            $(".footerMobile").addClass("borderTopOrange")
        }
        // On check si on est sur la page profil
        else if (isOnProfilPage) {
            // On change le texte du bouton
            $(btnSwitch).text("WHITE MODE")

            // On change le style de la page
            $(".annee").addClass("black")
            $(".annee").addClass("borderRadiusOrange")
            $(".annee p").addClass("whiteColor")
            $(".annee div a").addClass("whiteColor")
            $(".footerDesktop").addClass("borderTopOrange")
            $(".footerMobile").addClass("borderTopOrange")
            $(".containerProfil button").addClass("buttonBlack")
        }
        // On check si on est sur la page question
        else if (isOnQuestionPage) {
            $("main").addClass("black")
            $(".blockQuestion .introBlockQuestion div:first-child>div:first-child, .blockAnswers .introBlockQuestion div:first-child>div:first-child").addClass("borderOrange")
            $(".descriptionBlockQuestion").addClass("borderOrange")
            $(".blockQuestion .codeBlockQuestion>div, .blockAnswers .codeBlockQuestion>div").addClass("borderOrange")
            $(".styleInputResponse").addClass("borderRadiusOrange")
            $(".introBlockQuestion a p").addClass("whiteColor")
            $(".fa-picture-o").addClass("whiteColor")
            $("div:first-child>p").addClass("whiteColor")
            $(".footerDesktop").addClass("borderTopOrange")
            $(".footerMobile").addClass("borderTopOrange")
        }
    } else if (localStorage.currentTheme == "whiteMode") {
        $("header nav").removeClass("borderBottomOrange")
        $("body").removeClass("black")
        // On check si on est sur la page principale
        if (isOnMainPage) {
            $(".maincontainer section").removeClass("black")
            $(".maincontainer section div").removeClass("whiteColor")
            $(".backgroundmobile .background").removeClass("bgdc")
            $(".backgroundDesktop .background").removeClass("bgdc")
            $(".footer").removeClass("borderOrange")
        }
        // On check si on est sur la page poser une question
        else if (isOnAskQuestionPage) {
            $(".footerDesktop").removeClass("borderTopOrange")
            $(".footerMobile").removeClass("borderTopOrange")
        }
        // On check si on est sur la page voir les questions
        else if (isOnLookQuestionsPage) {
            $("main").removeClass("black")
            $(".filters").removeClass("borderOrange")
            $(".fa-picture-o").removeClass("white")
            $(".informationsProblem a, .informationsProblemMobile a").removeClass("orangeColor")
            $(".allQuestions section .informationsProblem>div i, .allQuestions section .informationsProblem>div>p").addClass("white")
            $(".allQuestions section").removeClass("borderRadiusOrange")
            $(".footerDesktop").removeClass("borderTopOrange")
            $(".footerMobile").removeClass("borderTopOrange")
        }
        // On check si on est sur la page profil
        else if (isOnProfilPage) {
            // On change le texte du bouton
            $(btnSwitch).text("DARK MODE")

            // On change le style de la page
            $(".annee").removeClass("black")
            $(".annee").removeClass("borderRadiusOrange")
            $(".annee p").removeClass("whiteColor")
            $(".annee div a").removeClass("whiteColor")
            $(".footerDesktop").removeClass("borderTopOrange")
            $(".footerMobile").removeClass("borderTopOrange")
            $(".containerProfil button").removeClass("buttonBlack")
        }
        // On check si on est sur la page question
        else if (isOnQuestionPage) {
            $("main").removeClass("black")
            $(".blockQuestion .introBlockQuestion div:first-child>div:first-child, .blockAnswers .introBlockQuestion div:first-child>div:first-child").removeClass("borderOrange")
            $(".descriptionBlockQuestion").removeClass("borderOrange")
            $(".blockQuestion .codeBlockQuestion>div, .blockAnswers .codeBlockQuestion>div").removeClass("borderOrange")
            $(".styleInputResponse").removeClass("borderRadiusOrange")
            $(".introBlockQuestion a p").removeClass("whiteColor")
            $(".fa-picture-o").removeClass("whiteColor")
            $("div:first-child>p").removeClass("whiteColor")
            $(".footerDesktop").removeClass("borderTopOrange")
            $(".footerMobile").removeClass("borderTopOrange")
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