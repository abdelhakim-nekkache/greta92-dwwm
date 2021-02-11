
// Branche l'événement SUBMIT au seul formulaire 
// de la page INDEX (I love Samir)
document.getElementsByTagName('form')[0].addEventListener(
    'submit',
    function (evt) {
        evt.preventDefault();
        // Teste si les mots de passe sont équivalents
        if (document.getElementById('pass').value === document.getElementById('check').value) {
            this.submit();
        } else {
            alert('Les mots de passe ne correspondent pas.');
        }
    },
    false
);