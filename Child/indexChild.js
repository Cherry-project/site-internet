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

///FONCTION DE BASE
(function() {

	//CLIC IMAGES
    categ = document.querySelectorAll('.imageflottante'),
    categLength = categ.length;

    for (var i = 0 ; i < categLength ; i++) {
    	//Pour chaque image on écoute le clic
    	categ[i].addEventListener('click', function(e) {

            var obj = e.target.id;
            var perso = document.getElementById('personnage');
            
            if (obj=='cafe'){
                perso.style.animationName= "tocafe"; 
            }
            else if (obj == 'jeux'){
                perso.style.animationName= "tojeux"; 
            }
            else if (obj == 'hopital'){
                perso.style.animationName= "tohopital"; 
            }
            else if (obj == 'bib'){
                perso.style.animationName= "tobib";  
            }
            else if (obj == 'ecole'){
                perso.style.animationName= "toecole";  
            }
    	}, false);
    }

    

})();   
