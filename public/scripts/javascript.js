/**
 * Created with JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-03
 * Time: 20:22
 * To change this template use File | Settings | File Templates.
 */
window.onload = function(){
   var request = new XMLHttpRequest();
    request.open('GET', 'fishes', true);

    request.onload = function(){
        if(request.status >=200 && request.status < 400){
            // Success!
            data = JSON.parse(request.responseText);

            data.forEach(function(fish){
                console.log(fish.name);
            });
        }else{
            // Error
        }
    };

    request.onerror = function(){
        console.log('some kind of error');
    }

    request.send();

    var el = document.querySelector('.js-submit-catch');

    el.addEventListener('click', function(e){
        var obj = {};

        obj.userId = document.getElementById('fisher').value;
        obj.fish = document.getElementById('fish').value;
        obj.weight = document.getElementById('weight').value;
        obj.measurement = document.getElementById('measurement').value;

        var request = new XMLHttpRequest();
        request.open('POST', 'fishes', true);

        request.onload = function(){
          if(request.status >= 200 && request.status < 400){
            // Success
            console.log('success');
          }else{
              console.log('failure');
          }
        };
        request.send(JSON.stringify(obj));

        e.preventDefault();
    });
};


