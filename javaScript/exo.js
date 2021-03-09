const t = ["hello", "chacun", "chacune", "!"];
for (let i = 0; i < t.length; i++) {
    console.log(t[i]);
}
/* sera executer autant de fois que le nombre de valeur du tableau grace a t.length qui calcul le nombre de valeur du tableau */
/* on initialise i dans la boucle for pour que cette boucle se repete x fois jusqu'a se qu'il atteint la limite definie dans le for grace au i<t.length*/
/* on affiche ensuite a la console chacune de nos valeur grace au console.log(t[i]) en lui attribuant i */





const t = ["hello", "chacun", "chacune", "!"];
function tablefunction(t) {
    for (let i = 0; i < t.length; i++) {
        console.log(t[i]);
    }
}
tablefunction(t);

/*  nous avons crée une fonction tablefunction qui nous permet d'automatiser l'affichage des valeur du tableau */