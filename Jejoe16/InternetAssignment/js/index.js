
$(document).ready(function(){
    // Set trigger and container variables
    var trigger = $('#nav ul li a'),
        container = $('#content');

    // Fire on click
    trigger.on('click', function(){
        // Set $this for re-use. Set target from data attribute
        var $this = $(this),
            target = $this.data('target');

        // Load target page into container
        container.load(target + '.php');

        // Stop normal link behavior
        return false;
    });
});
