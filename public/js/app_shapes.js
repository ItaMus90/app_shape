var App = (function(){


    function _draw(canvas, x1 = 10, x2 = 30, shape_type = "square") {

        if (canvas.getContext) {

            var context = canvas.getContext('2d');

            //max 300 150
            context.strokeRect(0, 0, x1, x2);

        }

        //option to do switch case
    }


    function _guess(e){

        var input_id = e.parentNode.firstChild.nextSibling.id;

        var hidden_id = e.parentNode.parentNode.childNodes[5].firstChild.id;

        if (input_id.trim() === "" || input_id === null || input_id === undefined){

            alert('Error with the input tag');
            return;

        }

        if (hidden_id.trim() === "" || hidden_id === null || hidden_id === undefined){

            alert('Error with the canavs');
            return;

        }

        var guess = document.getElementById(input_id).value;
        var extent = document.getElementById(hidden_id).value;
        var csrf = document.getElementsByName('csrf-token')[0].getAttribute('content');

        if(guess.trim() === "" || isNaN(guess)){

            alert('Invalid input');
            return;

        }


        var xhr = new XMLHttpRequest();
        var data = {
            guess: guess,
            shape_name: hidden_id,
            extent: extent

        };
        xhr.open('POST','/guess',true);

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("X-CSRF-TOKEN", csrf);

        xhr.onreadystatechange = function() {

            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

                var res = JSON.parse(xhr.responseText || null);
                guess.innerText = "";
                alert(res.success);

            }

        }

        xhr.send(JSON.stringify(data));

    }


    return{

        draw: _draw,
        guess: _guess

    }


}());

window.onload = function () {


    var i = 0;
    var canvas = document.querySelectorAll("canvas");
    var cord = document.getElementById("shapes").value;
    var tag = "";


    cord = JSON.parse(cord);

    for (k in cord){

        var hidden = document.createElement("input");

        hidden.setAttribute("type", "hidden");
        hidden.setAttribute("value", cord[k].extent);
        hidden.setAttribute('id', cord[k].shape_name)

        tag = canvas[i];

        var details = JSON.parse(cord[k].parmas);

        App.draw(tag,details['x1'],details['x2']);

        canvas[i].appendChild(hidden);

        i++;

    }


};
