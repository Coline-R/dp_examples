// variables utiles
var bgImgArr = [
	"assets/img/background3.jpg",
	"assets/img/background2.jpg",
	"assets/img/background.jpg",
];
var i = 0;

// fonction pour afficher une image différente toutes les 15s
function displayBgImg() {
	setInterval(function () {
		if (i === bgImgArr.length) {
			i = 0;
			$("header").css("background-image", "url(" + bgImgArr[i] + ")");
			i++;
		} else {
			$("header").css("background-image", "url(" + bgImgArr[i] + ")");
			i++;
		}
	}, 15000);
}

// appel de la fonction lorsque la page est prête pour l'utilisateur
$(document).ready(displayBgImg());
