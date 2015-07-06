/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, jQuery, alert*/
function rangeValue() {
    "use strict";
    document.getElementById("valeurPrixMin").innerHTML = document.getElementById("prixMin").value;
    document.getElementById("valeurPrixMax").innerHTML = document.getElementById("prixMax").value;
}
function rangeValueAjouter() {
    "use strict";
    document.getElementById("valeurPrix").innerHTML = document.getElementById("prix").value;
}
$(document).ready(function () {
    "use strict";
    var compteur = 0;
    $('#enablePrix').click(function () {
        compteur = compteur + 1;
        if (compteur % 2 !== 0) {
            $('div#prixmin').html('<label for="prixMin">Prix minimal :</label><p id="valeurPrixMin"></p><input class="form-control" min="0" max="9999" onchange="rangeValue()" name="prixMin" type="range" id="prixMin" disabled>');
            $('div#prixmax').html('<label for="prixMax">Prix maximal :</label><p id="valeurPrixMax"></p><input class="form-control" min="0" max="9999" onchange="rangeValue()" name="prixMiax" type="range" id="prixMax" disabled>');
        }
        if (compteur % 2 === 0) {
            $('div#prixmin').html('<label for="prixMin">Prix minimal :</label><p id="valeurPrixMin"></p><input class="form-control" min="0" max="9999" onchange="rangeValue()" name="prixMin" type="range" id="prixMin">');
            $('div#prixmax').html('<label for="prixMax">Prix maximal :</label><p id="valeurPrixMax"></p><input class="form-control" min="0" max="9999" onchange="rangeValue()" name="prixMiax" type="range" id="prixMax">');
        }
    });
});