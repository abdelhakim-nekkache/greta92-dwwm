

<?php
/**
 * Renvoie l'âge en années entre 2 dates passées en paramètres
 * @param {string} $dateNaissance - une date
 * @param {string} $today - une autre date
 * @return {int} âge en années
 */


function age($dateNaissance, $today): int {

    // Test si les arguments sont bien des dates
    if(!is_date($dateNaissance) || !is_date($today)) {
        trigger_error('L\'un des arguments n\'est pas une date', E_USER_WARNING);
    }

    // Transforme les dates de string en timestamp
    $d1 = strtotime($dateNaissance);
    $d2 = strtotime($today);

    // Cherche la date la plus forte vs la plus faible
    if ($d1>$d2){
        $diff = $d1 - $d2;
    } elseif ($d2 > $d1){
        $diff = $d2 - $d1;
    } else {
        $diff = 0;
    }


    // Renvoie le résultat
    return floor($diff / 60 / 60 / 24 / 365.25);
}


/**
 * Renvoie true si la chaine passée en paramètre est une date
 * @param {string} $arg - Argument à tester
 * @return {boolean}
 */

 function is_date($arg):bool
 {
     return (bool) strtotime($arg);
 }


/**
 *  Renvoie un montant TTC à partir d'un montant HT et d'un taux de TVA passés en paramètres
 * @param {float} $mt - montant positif
 * @param {float} $taux - taux valant : 0.021, 0.055, 0.1, 0.2
 * Taux normal 20%
 * @return {float}
 */

 function ttc($mt, $taux=0.2): float 
 {
    $corrects = [.021, .055, .1, .2];
    if (!is_float($mt) && $mt<0){
        trigger_error('le montant HT doit être positif.');
    } elseif (!in_array($taux,$corrects,true)){
        trigger_error('le taux doit être : ' . implode(', ', $corrects), E_USER_WARNING);
    } else {
        return $mt * (1 + $taux);
    }

}

?>