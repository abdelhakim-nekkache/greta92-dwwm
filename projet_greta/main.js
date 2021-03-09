var tata = document.getElementById('adress');
var toto = document.getElementById('toto');

toto.addEventListener(
    'click',
    function () {

        let xhr = new XMLHttpRequest();

        xhr.open("GET",'https://api-adresse.data.gouv.fr/search/?q='+tata.value);

        xhr.send();

        xhr.onreadystatechange  = function() 
    { 
       if(xhr.readyState  == 4)
       {
        if(xhr.status  == 200) { 
            let result = JSON.parse(xhr.responseText);
            console.log(result);
            let resultLoca = result.features[0].geometry.coordinates;
            console.log(resultLoca);
            console.log(resultLoca[0]+','+resultLoca[1]);
        } else
            document.ajax.dyn="Error code " + xhr.status;
        }


    };

    });
