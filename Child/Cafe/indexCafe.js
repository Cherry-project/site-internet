

//Récupère le contenu correspondant à l'élement
// function getContenu(elements) {
// 	while (elements = elements.nextSibling) {
// 		if (elements.className === 'contenucateg') {
// 			return elements;
// 		}
// 	}
// 	return false;
// }

//CHANGEMENTS DE STYLE

var changement={};

changement['video'] = function(id) {
	var categ = document.querySelectorAll('.categselect'),
    categLength = categ.length;
    for (var i = 0 ; i < categLength ; i++) {
    	categ[i].className="categorie";
    }
    var im = document.querySelectorAll('.imagecateg'),
    imLength = im.length;
    for (var i = 0 ; i < imLength ; i++) {
    	im[i].className="imagesidebar";
    }
    var titre = document.querySelectorAll('.titrecateg'),
    titreLength = titre.length;
    for (var i = 0 ; i < titreLength ; i++) {
    	titre[i].className="titresidebar";
    }

	var elem = document.getElementById('video');
	elem.className="categselect";
	var tit = elem.getElementsByClassName('titresidebar')[0].innerHTML;
	var cont = elem.getElementsByClassName('contenucateg')[0].innerHTML;
	document.getElementsByClassName('titreaffiche')[0].innerHTML = tit
	document.getElementsByClassName('contenuaffiche')[0].innerHTML = cont	
};

changement['email'] = function(id) {
	var categ = document.querySelectorAll('.categselect'),
    categLength = categ.length;
    for (var i = 0 ; i < categLength ; i++) {
    	categ[i].className="categorie";
    }
    var im = document.querySelectorAll('.imagecateg'),
    imLength = im.length;
    for (var i = 0 ; i < imLength ; i++) {
    	im[i].className="imagesidebar";
    }
    var titre = document.querySelectorAll('.titrecateg'),
    titreLength = titre.length;
    for (var i = 0 ; i < titreLength ; i++) {
    	titre[i].className="titresidebar";
    }

	var elem = document.getElementById('email');
	elem.className="categselect";
	var tit = elem.getElementsByClassName('titresidebar')[0].innerHTML;
	var cont = elem.getElementsByClassName('contenucateg')[0].innerHTML;
	document.getElementsByClassName('titreaffiche')[0].innerHTML = tit
	document.getElementsByClassName('contenuaffiche')[0].innerHTML = cont	

};

changement['chat'] = function(id) {
	categ = document.querySelectorAll('.categselect'),
    categLength = categ.length;
    for (var i = 0 ; i < categLength ; i++) {
    	categ[i].className="categorie";
    }
    var im = document.querySelectorAll('.imagecateg'),
    imLength = im.length;
    for (var i = 0 ; i < imLength ; i++) {
    	im[i].className="imagesidebar";
    }
    var titre = document.querySelectorAll('.titrecateg'),
    titreLength = titre.length;
    for (var i = 0 ; i < titreLength ; i++) {
    	titre[i].className="titresidebar";
    }

	var elem = document.getElementById('chat');
	elem.className="categselect";
	var tit = elem.getElementsByClassName('titresidebar')[0].innerHTML;
	var cont = elem.getElementsByClassName('contenucateg')[0].innerHTML;
	document.getElementsByClassName('titreaffiche')[0].innerHTML = tit
	document.getElementsByClassName('contenuaffiche')[0].innerHTML = cont	

};

changement['primakid'] = function(id) {
	categ = document.querySelectorAll('.categselect'),
    categLength = categ.length;
    for (var i = 0 ; i < categLength ; i++) {
    	categ[i].className="categorie";
    }
    var im = document.querySelectorAll('.imagecateg'),
    imLength = im.length;
    for (var i = 0 ; i < imLength ; i++) {
    	im[i].className="imagesidebar";
    }
    var titre = document.querySelectorAll('.titrecateg'),
    titreLength = titre.length;
    for (var i = 0 ; i < titreLength ; i++) {
    	titre[i].className="titresidebar";
    }

	var elem = document.getElementById('primakid');
	elem.className="categselect";
	var tit = elem.getElementsByClassName('titresidebar')[0].innerHTML;
	var cont = elem.getElementsByClassName('contenucateg')[0].innerHTML;
	document.getElementsByClassName('titreaffiche')[0].innerHTML = tit
	document.getElementsByClassName('contenuaffiche')[0].innerHTML = cont	

};


///FONCTION DE BASE
(function() { // Utilisation d'une IIFE pour éviter les variables globales.

    //var myForm = document.getElementById('myForm'),
    categ = document.querySelectorAll('.imagecateg'),
    categLength = categ.length;

    for (var i = 0 ; i < categLength ; i++) {
    	categ[i].addEventListener('click', function(e) {

    		var affiche = document.querySelectorAll('.contafficheFALSE'),
    		afficheLength = affiche.length;
    		for (var i = 0 ; i < afficheLength ; i++) {
    			affiche[i].className="contafficheTRUE";
    		}

    		var encadre = document.querySelectorAll('.encadre_def'),
    		encadreLength = encadre.length;
    		for (var i = 0 ; i < encadreLength ; i++) {
    			encadre[i].className="encadre_sidebar";
    		}

    		var encadre = document.querySelectorAll('.categorie_def'),
    		encadreLength = encadre.length;
    		for (var i = 0 ; i < encadreLength ; i++) {
    			encadre[i].className="categorie";
    		}

    		cat=e.target.parentNode;
    		changement[cat.id](cat.id); // "e.target" représente l'input actuellement modifié
    	}, false);
    }
})();   
