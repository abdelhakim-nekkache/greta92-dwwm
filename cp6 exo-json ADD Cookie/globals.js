/**
 * Renvoie l'âge en années entre deux dates passées en paramètres
 * @param {string} d1 - première date
 * @param {string} d2 - deuxième date 
 */
function datediff(d1, d2) {
    let iResult = 0;
    let date1 = new Date(1);
    let date2 = new Date(2);
    if (date2>date1){
        iResult = date2 - date1;
    } else {
        iResult = date1 - date2;
    }

   iResult= iResult / 1000 / 60 / 60 / 24 / 365.25;
    return Math.floor(iResult);
}