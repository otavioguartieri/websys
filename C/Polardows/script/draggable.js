setInterval(function(){
    $('.draggable').not('[draggable]').each(function() {
        $(this).attr('ondragstart', `calcularPosicaoMouseStart(event);${$(this).attr('ondragstart') || ''}`);
        $(this).attr('ondrag', `calcularPosicaoMouse(event,this);${$(this).attr('ondragstart') || ''}`);
        $(this).attr('draggable', `true`);
    })
},500);

/* function to make things draggable */
var posicaoInicial = { x: 0, y: 0 };
function calcularPosicaoMouseStart(event) {
    var rect = event.target.getBoundingClientRect();
    posicaoInicial['x'] = event.clientX - rect.left;
    posicaoInicial['y'] = event.clientY - rect.top;
}
function calcularPosicaoMouse(event,e) {
    var rect = event.target.getBoundingClientRect();
    var x = event.clientX - rect.left;
    var y = event.clientY - rect.top;
    if(parseInt($(e).css('left').replace('px','')) + x - posicaoInicial['x'] >=  0)
        $(e).css('left',`+=${x - posicaoInicial['x']}px`);
    if(parseInt($(e).css('top').replace('px','')) + y - posicaoInicial['y'] >=  0)
        $(e).css('top',`+=${y - posicaoInicial['y']}px`);
}