<?php   

$projects = array(
    "NRJ" => array(
        "name" => "Energies renouvelables",
        "budget" => "400000",
        "technos" => array(
            "Web" => array(
                "HTML", 
                "CSS", 
                "JS"
            ),
            "Mobile" => array("React Native"),
        )
    ),
    "H2O" => array(
        "name" => "Traitement des eaux usées",
        "budget" => "750000",
        "technos" => array(
            "Client riche" => array(
                "JAVA",
                "Oracle"
            ),
            "RWD" => array(
                "MongoDB",
                "Node",
                "Angular"
            )
        )
    ),
    "RDC" => array(
        "name" => "Gestion maraudes Restos du Coeur",
        // comme c'est les restos du coeurs, on a pas de budget pour ce projet
        // cela nous permet de tester l'absence de données dans le tableau 
        "technos" => array(
            "Web" => array(
                "HTML", 
                "CSS", 
                "JS"
            )
        )
    )
);


// affichage formaté du contenu pour contrôle visuel 
// echo '<pre>'; 
// print_r($projects); 
// echo '</pre>';



// On génère un tableau HTML affichant le contenu du tableau 'projects' : 

// 1) on crée le tableau html 
$html = '<table class="table table-striped">';
// 2) on crée le corps (thead + tbody) du tableau html 
$html .= '<thead><tr><th>Projets</th><th>Budget</th><th>Technologies</th></tr></thead><tbody>';
// 3) on fait une boucle qui va récupérer les données du tableau '$projects' pour les insérer dans le tableau html  
foreach( $projects as $key => $val ) {
    $html .= '<tr>';
    $html .= '<td>' . $key . ' - ' . $projects[$key]['name'] . '</td>';
    // on utilise un 'ternaire' pour vérifier si 'budget' contient une valeur 
    $html .= '<td>' . ( array_key_exists('budget', $projects[$key]) ? $projects[$key]['budget'] : "test valeur vide") . '</td>';
    $html .= '<td><ul>';
    // on refait une seconde boucle pour parcourir le sous-tableau 
    foreach($projects[$key]['technos'] as $key2 => $val2) {
        $html .= '<li>' . $key2 . '<ol>';
        foreach( $projects[$key]['technos'][$key2] as $val3 ) {
            $html .= '<li>' . $val3 . '</li>';
        }
        $html .= '</ol></li>';
    }
    $html .= '</td></ul>';
    $html .= '</tr>';
}
// on ferme les balises ouvertes aux étapes 1) et 2) 
$html .= '</tbody></table>';
// on affichage le résultat
echo $html;
?>