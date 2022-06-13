jQuery(document).ready(function($){

    // testimonial slider
    var stack = $('.stack').paperstack({});
    $('#next').click(stack.next);
    $('#prev').click(stack.previous);


});