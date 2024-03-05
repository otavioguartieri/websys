setInterval(function(){
    $('.tab_resize').each(function() {
        $(this).attr('ondragstart', `tabResizeMouseStart(event);`);
        $(this).attr('ondrag', `tabResizeMouse(event,$(this));`);
    });
},100);

/* function to make things draggable */
var posicaoInicial = { x: 0, y: 0 };
function tabResizeMouseStart(event) {
    var rect = event.target.getBoundingClientRect();
    posicaoInicial['x'] = event.clientX - rect.left;
    posicaoInicial['y'] = event.clientY - rect.top;
}
function tabResizeMouse(event,e) {
    console.log(event)
    var rect = event.target.getBoundingClientRect();
    var x = event.clientX - rect.left;
    var y = event.clientY - rect.top;
    if(x >=  0 && y >=  0){
        $(e).css('left',`+=${x - posicaoInicial['x']}px`);
        $(e).css('top',`+=${y - posicaoInicial['y']}px`);
    }
}