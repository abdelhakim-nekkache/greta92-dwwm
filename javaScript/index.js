const resultat = Math.floor(Math.random() * 10);
let reponse = Number(prompt("deviné quel est le bon chiffre compris entre 0 et 10"));
let rejouer = true;
const newgame = prompt("Voulez vous rejouez ?");
do {
    while (resultat != reponse) {
        if (reponse > resultat) {
            reponse = Number(prompt("Trop grand"));

        } else if (reponse < resultat) {
            reponse = Number(prompt("Trop petit"));

        } else {
            alert("bien joué !");
        }
    }
    newgame;
    if (newgame == 'non') {
        alert("A bientôt !");
    } else if (newgame == 'oui') {
        alert("C'est reparti !");
    }
} while (rejouer);









const resultat = Math.floor(Math.random() * 10);
let reponse = Number(prompt("deviné quel est le bon chiffre compris entre 0 et 10"));
let rejouer = true;
const newgame = prompt("Voulez vous rejouez ?");
do {
    while (resultat != reponse) {
        if (reponse > resultat) {
            reponse = Number(prompt("Trop grand"));

        } else if (reponse < resultat) {
            reponse = Number(prompt("Trop petit"));

        } else {
            alert("bien joué !");
            newgame = prompt("Voulez vous rejouez ?");
            if (newgame == 'non') {
                alert("A bientôt !");
            } else if (newgame == 'oui') {
                alert("C'est reparti !");
            }
        }
    }
} while (rejouer);







const newgame;
let rejouer = true;
while (rejouer) {
    const resultat = Math.floor(Math.random() * 10);
    let reponse = Number(prompt("deviné quel est le bon chiffre compris entre 0 et 10"));
    while (resultat != reponse) {
        if (reponse > resultat) {
            reponse = Number(prompt("Trop grand"));

        } else if (reponse < resultat) {
            reponse = Number(prompt("Trop petit"));

        } else {
            alert("bien joué !");
        }
    }
    newgame = prompt("Voulez vous rejouez ?");
    if (newgame == 'non') {
        alert("A bientôt !");
    } else if (newgame == 'oui') {
        alert("C'est reparti !");
    }
}







let rejouer = true;
while (rejouer) {
    const resultat = Math.floor(Math.random() * 10);
    let reponse = Number(prompt("deviné quel est le bon chiffre compris entre 0 et 10"));
    while (resultat != reponse && reponse != null) {
        if (reponse > 10) {
            reponse = prompt("Ce n'est pas un nombre entre 0 et 10");
        } else if (is(NaN reponse)) {
            reponse = prompt("Ce n'est pas un nombre");
        } else if (reponse > resultat) {
            reponse = prompt("Trop grand");
        } else if (reponse < resultat) {
            reponse = prompt("Trop petit");
        }
    }
}




/* SWITCH */

let choix = 3;
switch (choix) {
    case 0:
        console.log("case 0");
    case 1:
        console.log("case 1");
    case 3:
        console.log("case 3");
    case 7:
        console.log("case 7");
    default:
        console.log("default");
};





function mult(a, b) {
    return (a * b);
}


function puiss(x = 1, y = 0) {
    let resultat = 1;
    for (let i = 0; i < y; i++) {
        resultat = mult(resultat, x);
    }
    return resultat;
}


