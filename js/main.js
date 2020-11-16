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

// On exécute la fonction au click sur le bouton
$(btnSwitch).click(
    function() {
        // On check si on est sur la page principale
        if (isOnMainPage) {
            $("#background").toggleClass("red")

        } else if (isOnProfilPage) {
            
            if(($(btnSwitch)).innerHTML == "DARK MODE"){
                $(btnSwitch).text("WHITE MODE")
            }else{
                $(btnSwitch).text("DARK MODE")
            }
            $("body").toggleClass("black")
            $(".annee").toggleClass("black")
            $(".annee").toggleClass("blackAnnee")
            $(".annee p").toggleClass("blackAnnee p")
            $(".annee div a").toggleClass("blackAnnee div a")
            $(".footerDesktop").toggleClass("footerBlack")
            $(".footerMobile").toggleClass("footerBlack")
            $(".containerProfil button").toggleClass("buttonBlack")
        }

    })