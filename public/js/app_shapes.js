var App = (function(){


    function draw(canvas, width = 300, height = 150) {

        if (canvas.getContext) {

            var context = canvas.getContext('2d');

            //max 300 150
            context.strokeRect(0, 0, width, height);

        }
    }


    return{

        draw: draw

    }


}());
