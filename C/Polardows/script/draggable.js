setInterval(function(){
    $('.draggable').removeClass('blocked');
    $('.draggable').not(['onmousedown']).each(function() {
        $(this).attr('onmousedown', `tabResizeMouseStart(event,$(this).parent().parent());`);
        $(this).attr('onmouseup', `tabResizeMouseStop();`);
    });
},100);

/* function to make things draggable */
var PIM = { x: 0, y: 0 };
var PIE = { x: 0, y: 0 };
    
function tabResizeMouseStart(event,e) {
    $(event.target).addClass('drag_active');
    $(e).addClass('grab');

    var rect = $(e)[0].getBoundingClientRect();
    PIE['x'] = rect.left;
    PIE['y'] = rect.top;

    PIM['x'] = event.clientX; /* event.clientX = onde esta o mouse na horizontal */
    PIM['y'] = event.clientY; /* event.clientY = onde esta o mouse na vertical */
}
function tabResizeMouseStop() {
    $('.draggable').removeClass('drag_active');
    $('.poltab.grab').removeClass('grab');
}
function tabResizeEvent(event,e) {
    var y = (event.clientY - PIM['y']);
    var x = (event.clientX - PIM['x']);
    
    $(e).css("top",`${PIE['y']+y}px`);
    $(e).css("left",`${PIE['x']+x}px`);
}
$( document ).on( "mousemove", function( event ) {
    if($('.poltab.grab').length == 1){
        tabResizeEvent(event,$('.poltab.grab'));
    }
});
$( document ).on( "mouseup", function() {
    tabResizeMouseStop();
});
