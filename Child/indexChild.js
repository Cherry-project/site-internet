
function exclamation (){//Mise en place des points d'exclamation
    var isnew=[1,0,0,1,0];
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
}

$("#perso_image").animateSprite({
    fps: 3,
    animations: {
        lookDown:[0],
        walkDown: [1,2],
        lookUp: [3],
        walkUp: [4,5],
        lookRight: [6],
        walkRight: [7,8],
        lookLeft: [9],
        walkLeft: [10,11],
        nothing:[12,13]
    },
    loop: true,
    complete: function(){
        // use complete only when you set animations with 'loop: false'
        alert("animation End");
    }
});


function deplacement_total(destination){//deplacement vers le bas+principal+final
    //On modifie le div de destination
    $("#dest").removeClass().addClass(destination);
    //marche 100px vers le bas
    $("#perso_image").animateSprite('play', 'walkDown');
    $("#personnage").css({ 
            "MozTransition"    : '1s linear 0.5s',
            "transition"       : '1s linear 0.5s',
            "top":"+=50"
        });
    $("#personnage").one('webkitTransitionEnd transitionend', function(e) { //fin 50px
        $("#perso_image").animateSprite('play', 'lookDown');
        $("#mongolfiere").css({"display":"inline-block"});
        $("#perso_image").css({"display":"none"});
        //decollage
        $("#personnage").css({
            "MozTransition": "2s linear 0.5s",
            "transition": "2s linear 0.5s", 
            "transform": "scale(1.4,1.4)"
        });
        $("#personnage").one('webkitTransitionEnd transitionend', function(e) { //fin décollage
            deplacement_principal(destination);        
        });//fin décollage
    });//fin 100px*/
}

function deplacement_principal(destination){//mouvement d'une ile à l'autre
    //changer le temps nécessaire à l'animation selon la distance a parcourir
    var dist=Math.sqrt(Math.pow(($("#personnage").position().top - $("#dest").position().top),2)+Math.pow(($("#personnage").position().left - $("#dest").position().left),2));
    var time=dist/100;
    //on donne sa destination au personnage 
    //$("#personnage").removeClass().addClass(destination);
    $("#personnage").css({
        "MozTransition"    : time+'s linear 0.5s',
        "transition"       : time+'s linear 0.5s',
        "left" : $("#dest").position().left+'px',
        "top" : $("#dest").position().top+'px'
    });
            
    $("#personnage").one('webkitTransitionEnd transitionend', function(e) { //fin déplacement principal
        $("#personnage").one('webkitTransitionEnd transitionend', function(e) {//2eme fin dep principal (1 pour left 1 pour top)
            //atterrissage
            $("#personnage").css({
                "MozTransition": "2s ease 0.5s",
                "transition": "2s ease 0.5s",
                "transform": "scale(1,1)"
            });
            $("#personnage").one('webkitTransitionEnd transitionend', function(e) { //fin aterrissage
                deplacement_final(destination);
            });//fin atterrissage
        });
    });//fin deplacement principal
}

function deplacement_final(destination){//entrée dans un batiment
    $("#perso_image").css({"display":"inline-block"});
    $("#mongolfiere").css({"display":"none"});
    $("#perso_image").animateSprite('play', 'walkUp');
    $("#personnage").css({
        "MozTransition": "2s ease 0.5s",
        "transition": "2s ease 0.5s", 
        "top":"-=50"
    });
    $("#personnage").one('webkitTransitionEnd transitionend', function(e) {
        $("#perso_image").animateSprite('play', 'lookUp');
        switch(destination) {
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
}

//Fonction principale
$(function () {
    var idBuilding;
    //Losqu'on clique sur un batiment, on récupère son id
    //Le personnage se déplacera vers la position du batiment
    $(".batiment").on("click", function () {
        idBuilding = $(this).attr("id");
        //Si le perso n'est pas deja sur l'ile correspondante, on le fait voler
        if(!($("#personnage").hasClass(idBuilding))){
            deplacement_total(idBuilding);
        }
        else{//sinon il marche vers la porte
            deplacement_final(idBuilding);
        }
    });
    //anims supplémentaires
    exclamation(); 
    var helico_time=Math.floor(Math.random()*10000);   
    setTimeout(helicopter, helico_time);
    
    //var ovis_time=5000;
    //setTimeout(ovis, ovis_time);
    ovis();
    
});

function helicopter(){
    if ($("#helico").position().top==260 && $("#helico").position().left==670){
        ///////ajouter calcul vitesse
        var pos=pos_bord_aleatoire();
        var x=pos[0], y=pos[1];
        if (x<50){ ///remplacer 50 par x position de départ
            $("#helico").css({
                "MozTransition": "0s linear 0s",
                "transition": "0s linear 0s",
                "-moz-transform": "rotateY(180deg)",
                "-webkit-transform": "rotateY(180deg)",
                "transform": "rotateY(180deg)"
            });
        }
        $("#helico").css({//décollage
            "MozTransition": "2s linear 1s",
            "transition": "2s linear 1s", 
            "top":"-=50"
        });
        $("#helico").one('webkitTransitionEnd transitionend', function(e) {//fin décollage
            $("#helico").css({
                "MozTransition"    : '6s linear 0.5s',
                "transition"       : '6s linear 0.5s',
                "left" : x+'%',
                "top" : y+'%',
            });
            $("#helico").one('webkitTransitionEnd transitionend', function(e) {//fin trajet
                $("#helico").one('webkitTransitionEnd transitionend', function(e) {//fin trajet
                    $("#helico").hide();
                });
            });
        });
    }
    else if (!$("#helico").is(":visible")){//retour helico 
        $("#helico").removeAttr('style');
        var pos=pos_bord_aleatoire();
        var x=pos[0], y=pos[1];
        if (x>50){ ///remplacer 50 par x position de départ
            $("#helico").css({
                "MozTransition": "0s linear 0s",
                "transition": "0s linear 0s",
                "-moz-transform": "rotateY(180deg)",
                "-webkit-transform": "rotateY(180deg)",
                "transform": "rotateY(180deg)"
            });
        }
        $("#helico").css({
            "MozTransition"    : '0s linear 0s',
            "transition"       : '0s linear 0s',
            "left" : x+'%',
            "top" : y+'%',
        });
        $("#helico").show();   
        //vers hopital
        $("#helico").css({
            "MozTransition"    : '6s linear 0.5s',
            "transition"       : '6s linear 0.5s',
            "left" : '670px',
            "top" : '210px',
        });
        $("#helico").one('webkitTransitionEnd transitionend', function(e) {//aterrissage
            if (x>50){ ///remplacer 50 par x position de départ
                $("#helico").css({
                    "MozTransition"    : '2s linear 1s',
                    "transition"       : '2s linear 1s',
                    "top" : '+=50px',
                    "-moz-transform": "rotateY(0deg)",
                    "-webkit-transform": "rotateY(0deg)",
                    "transform": "rotateY(0deg)"
                });
            }
            else{
                $("#helico").css({
                    "MozTransition"    : '2s linear 1s',
                    "transition"       : '2s linear 1s',
                    "top" : '+=50px',
                });
            }
        }); 
    }
    var time=Math.floor(Math.random()*10000)+8000;
    setTimeout(helicopter, time);
}

function ovis(){
    //$("#ovis").hide();
    //image aléatoire
    var tab_ovis = ["image/sprites/avion.png","image/sprites/avion2.png","image/sprites/dirigable.png","image/sprites/mongolf2.png","image/sprites/oiseaux.png","image/sprites/ovni.png"];
    var i=Math.floor(Math.random()*tab_ovis.length);
    $("#ovis").attr('src',tab_ovis[i]);
    //trajectoire aléatoire
    var pos1=pos_bord_aleatoire();
    var x1=pos1[0], y1=pos1[1];
    var pos2=pos_bord_aleatoire();
    var x2=pos2[0], y2=pos2[1];
    if (x1==x2 && y1==y2){
        x2+=20;
        y2+=20;
    }
    else if ((x1==x2==-10) || (x1==x2==100)){
        x2=20;
    }
    else if ((y1==y2==-10) || (y1==y2==100)){
        y2=20;
    }
    $("#dest_ovis").css({
        "left" : x2+'%',
        "top" : y2+'%',
    }); 
    $("#ovis").css({
        "MozTransition"    : '0s linear 0s',
        "transition"       : '0s linear 0s',
        "left" : x1+'%',
        "top" : y1+'%',
    }); 
    //////suivant image, rotation suivant trajectoire
    var angle=Math.atan(($("#dest_ovis").position().top-$("#ovis").position().top)/($("#dest_ovis").position().left-$("#ovis").position().left));

    $("#ovis").css({
        "MozTransition"    : '0s linear 0s',
        "transition"       : '0s linear 0s',
        "-moz-transform": 'rotate('+angle+'deg)',
        "-webkit-transform": 'rotate('+angle+'deg)',
        "transform": 'rotate('+angle+'deg)'
    });



    $("#ovis").show();  
    $("#ovis").css({
        "MozTransition"    : '6s linear 0.5s',
        "transition"       : '6s linear 0.5s',
        "left" : x2+'%',
        "top" : y2+'%',
    });
    //////cacher les éléments quand ils ont fini leur trajet, pr ne pas les voir statiques
    //$("#ovis").hide();
    /////mettre en aléatoire 
    var ovis_time=12000;
    setTimeout(ovis, ovis_time);  
}

function pos_bord_aleatoire(){//calcule une position aléatoire le long des bords de l'écran
    if(Math.floor(Math.random()*2)==1){//horizontal
        if (Math.floor(Math.random()*2)==1){//haut
            var x=Math.floor(Math.random()*100)-10;
            var y=-10; 
        }
        else{//bas
            var x=Math.floor(Math.random()*100)-10;
            var y=100;
        }
    }
    else {//vertical
        if (Math.floor(Math.random()*2)==1){//gauche
            var x=-10;
            var y=Math.floor(Math.random()*100)-10;
        }
        else {
            var x=100;
            var y=Math.floor(Math.random()*100)-10;
        }
    }
    return [x,y];
}


