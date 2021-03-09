/**
 * Utilise l'objet indexedDB pour stocker les données du 
 * formulaire sous forme d'objets.
 */

 document.getElementById('readIndexedDB').addEventListener(
    'click',
    function() {
        // Si IDB est supporté
        if(window.indexedDB){
            // Ouvre la BDD
            let oIDB = window.indexedDB;
            let oCnn = oIDB.open('Darons-Coders', 1);
            // Définit la structure si besoin : 1er passage seulement
            oCnn.addEventListener(
                'upgradeneeded',
                function() {
                    // Connexion a la BDD
                    let oDb = oCnn.result;
                    // Créer ObjectStore si besoin
                    if (!oDb.objectStoreNames.contains('Repertoire')){
                        let oStore = oDb.createObjectStore('Repertoire', {autoIncrement:true});
                        let oIdx = oStore.createIndex('IndexZip', ['zip']);
                    }
                },
                false
            );

            // Si connexion ok
            oCnn.addEventListener(
                'success',
                function () {
                    // Connexion a la BDD
                    let oDb = oCnn.result;
                    // Démarre une transaction
                    let oTx = oDb.transaction(['Repertoire'], 'readwrite');
                    // Ouvre l'objectStore
                    let oStore = oTx.objectStore('Repertoire');
                    // Sauvegarde les données du formulaire
                    let aElements = document.querySelectorAll('form [name]');
                    let oData = {};
                    for(let i = 0; i<aElements.length; i++) {
                        oData[aElements[i].name] = aElements[i].value;
                    }
                    // Stocke l'objet
                    let oReq = oStore.put(oData);

                    // Si stockage OK
                    oReq.addEventListener(
                        'success',
                        function () {
                            alert('Stockage IDB terminé avec succés');
                        },
                        false
                    );

                    // Si stockage KO
                    oReq.addEventListener(
                        'error',
                        function(oErr) {
                            alert('Erreur IDB : '+oErr);
                        },
                        false
                    );

                    // Si transaction finie
                    oTx.addEventListener(
                        'complete',
                        function() {
                            oDb.close();
                        },
                        false
                    );

                },
                false
            );
            // Si connexion KO
            oCnn.addEventListener(
                'error',
                function() {
                    alert('Erreur de connexion IDB');
                },
                false
            );

        } else {
            alert('IDB non supporté sur se browser');
        }
    },
    false
 );


 document.getElementById('readIndexedDB').addEventListener(
     'click',
     function () {
        // Si IDB supporté
        if (window.indexedDB) {
            // Ouvre BDD
            let oCnn = window.indexedDB.open
            ('Darons-Coders', 1);

            // Si ouverture KO
            oCnn.addEventListener(
                'error',
                function (evt) {
                    alert('Erreur : ' + evt);
                },
                false
            );
            // Si ouverture OK 
            oCnn.addEventListener(
                'success',
                function () {
                    let oDB = oCnn.result;
                    let oTx = oDB.transaction(['Repertoire'], 'readonly');
                    let oStore = oTx.objectStore('Repertoire');
                    let oReq = oStore.openCursor();

                    // Si ouverture curseur KO
                    oReq.addEventListener(
                        'error',
                        function(evt) {
                            alert('Erreur : ' + evt );
                        },
                        false
                    );
                    // Si ouverture curseur OK
                    oReq.addEventListener(
                        'success',
                        function(evt) {
                            let oCursor = evt.target.result;
                            if (oCursor) {
                                console.log(oCursor.value);
                                oCursor.continue();
                            }
                        },
                        false
                    );
                    // Si transaction fini
                    oTx.addEventListener(
                        'complete',
                        function() {
                            oDB.close();
                        },
                        false
                    );
                },
                false
            );
        }
     },
     false
 );