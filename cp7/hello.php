<?php
// en PHP, le " . " ("point", les espaces ne sont pas nécessaires, juste pour une meilleure visibilité ici) sert à concaténer :  
echo "<h1>Salut !</h1> <p>Je m'appelle JM et je bosse chez les Darons Codeurs depuis le" . date('l d F Y', mktime(0,0,0,11,2,2020)) . ".</p>" ;
?>