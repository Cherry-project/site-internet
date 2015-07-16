//Mise en place des points d'exclamation
var isnew=[1,0,0,0,1];
var exclam = document.querySelectorAll('.exclam'),
exclamLength = exclam.length;
for (var i = 0 ; i < exclamLength ; i++) {
    if (isnew[i]==1){
        exclam[i].style.display="inline-block";
    }
    else{
        exclam[i].style.display="none";
    }
}

//Fonction pour animation
$(function () {
    var idBuilding;
    //Losqu'on clique sur un batiment, on récupère son id, qui correspond à une classe de personnage
    //Le personnage se déplacera vers la position de cette nouvelle classe selon l'animation CSS
    $(".imageflottante").on("click", function () {
        idBuilding = $(this).attr("id");

        //calculer temps nécessaire (a partir de la dist au batiment -- faire ac la distance à l'emplacement d'arrivée)
     ///   //var dist=Math.sqrt(Math.pow(($("#personnage").position.top - $(this).position.top),2)+Math.pow(($("#personnage").position.left - $(this).position.left),2));


        $("#personnage").removeClass().addClass(idBuilding);
        //a la fin de la transition, on passe à la page nécessaire
        $("#personnage").one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
            switch(idBuilding) {
                case "hopital":
                window.location.href = "Hospital/indexHospital.php";
                break;
                case "cafe":
                window.location.href = "Cafe/indexCafe.php";
                break;
                case "jeux":
                window.location.href = "Games/indexGames.php";
                break;
                case "bib":
                window.location.href = "Libraries/indexLibraries.php";
                break;
                case "ecole":
                window.location.href = "School/indexSchool.php";
                break;
                default:
                window.location.href = "#";
            }
        });
    });
    
});


