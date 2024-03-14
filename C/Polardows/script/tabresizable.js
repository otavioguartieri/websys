setInterval(function(){
    $('.tab_resize').removeClass('blocked');
    $('.tab_resize').not(['onmousedown']).each(function() {
        $(this).attr('onmousedown', `tabResizeMouseStart(event,$(this).parent());`);
        $(this).attr('onmouseup', `tabResizeMouseStop();`);
    });
},100);

/* function to make things draggable */
var PIM = { x: 0, y: 0 };
    
function tabResizeMouseStart(event,e) {
    $(event.target).addClass('active');
    $(e).addClass('grab').attr("mv_dir",$(event.target)[0]['classList'][1]);
    $(e).find('.poltab_content>iframe').attr("defaultHeight",$(e).find('.poltab_content>iframe').attr("height"));
    $(e).find('.poltab_content>iframe').attr("defaultWidth",$(e).find('.poltab_content>iframe').attr("width"));
    PIM['x'] = event.clientX; /* event.clientX = onde esta o mouse na horizontal */
    PIM['y'] = event.clientY; /* event.clientY = onde esta o mouse na vertical */
}
function tabResizeMouseStop() {
    $('.tab_resize').removeClass('active');
    $('.poltab.grab').removeClass('grab').removeAttr("mv_dir");
}
function tabResizeEvent(event,e) {
    var y = (event.clientY - PIM['y']); 
    var x = (event.clientX - PIM['x']); 
    switch($(e).attr("mv_dir")){
        case 'v_t':
            $(e).css("top",`${event.clientY}px`);
            $(e).find('.poltab_content>iframe').attr("height",`${parseInt($(e).find('.poltab_content>iframe').attr("defaultHeight"))+y * -1}`);
        break;
        case 'v_b':
            $(e).find('.poltab_content>iframe').attr("height",`${parseInt($(e).find('.poltab_content>iframe').attr("defaultHeight"))+y}`);
        break;
        case 'h_l':
            $(e).css("left",`${event.clientX}px`);
            $(e).find('.poltab_content>iframe').attr("width",`${parseInt($(e).find('.poltab_content>iframe').attr("defaultWidth"))+x * -1}`);
        break;
        case 'h_r':
            $(e).find('.poltab_content>iframe').attr("width",`${parseInt($(e).find('.poltab_content>iframe').attr("defaultWidth"))+x}`);
        break;
        case 'z_tl':
            $(e).css("top",`${event.clientY}px`);
            $(e).find('.poltab_content>iframe').attr("height",`${parseInt($(e).find('.poltab_content>iframe').attr("defaultHeight"))+y * -1}`);
            $(e).css("left",`${event.clientX}px`);
            $(e).find('.poltab_content>iframe').attr("width",`${parseInt($(e).find('.poltab_content>iframe').attr("defaultWidth"))+x * -1}`);
        break;
        case 'z_tr':
            $(e).css("top",`${event.clientY}px`);
            $(e).find('.poltab_content>iframe').attr("height",`${parseInt($(e).find('.poltab_content>iframe').attr("defaultHeight"))+y * -1}`);
            $(e).find('.poltab_content>iframe').attr("width",`${parseInt($(e).find('.poltab_content>iframe').attr("defaultWidth"))+x}`);
        break;
        case 'z_bl':
            $(e).find('.poltab_content>iframe').attr("height",`${parseInt($(e).find('.poltab_content>iframe').attr("defaultHeight"))+y}`);
            $(e).css("left",`${event.clientX}px`);
            $(e).find('.poltab_content>iframe').attr("width",`${parseInt($(e).find('.poltab_content>iframe').attr("defaultWidth"))+x * -1}`);
        break;
        case 'z_br':
            $(e).find('.poltab_content>iframe').attr("height",`${parseInt($(e).find('.poltab_content>iframe').attr("defaultHeight"))+y}`);
            $(e).find('.poltab_content>iframe').attr("width",`${parseInt($(e).find('.poltab_content>iframe').attr("defaultWidth"))+x}`);
        break;
        default: break;
    }
}
$( document ).on( "mousemove", function( event ) {
    if($('.poltab.grab').length == 1){
        tabResizeEvent(event,$('.poltab.grab'));
    }
});
$( document ).on( "mouseup", function() {
    tabResizeMouseStop();
});
