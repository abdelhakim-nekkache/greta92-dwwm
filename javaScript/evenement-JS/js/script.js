/* script JS pour gestion des evenements */
// variable globale compteur pour lecture du tableau
let cmptr=0;
// Variable globale qui recevra le texte contenu dans l'élément cliqué
let nomElement="";

// on pointe sur le CONTENEUR principal de la page HTML
let conteneurHtml = document.getElementById("conteneur");
// puis on crée un tableau qui pointe sur tous les éléments du contenu
let myTbClique = Array.from(document.querySelectorAll(".myDiv"));

for(myCmptr = 0; myCmptr < myTbClique.length; myCmptr++){
    myTbClique[myCmptr].addEventListener('click', my)
}


// Cette fonction est appelée à chaque clic sur un élément du CONTENEUR
// identifié par la boucle d'itération précédente
function myOnClick(event){
    let myIndice = myTbClique.indexOf(event.currentTarget);
    // on test que la variable INDICE est bien une valeur positive, 
    if (myIndice != -1)
    // on affecte le texte contenu dans la DIV à la variable NomElement
    myNomElement = myTbClique
}