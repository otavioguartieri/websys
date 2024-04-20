$(document).ready(()=>{
    $("#taskbar").html('');
});
function TaskbarAdd(app_id,name,icon){
    $("#taskbar").append(`
        <div class="taskbar_app" onmouseup="TaskbarOpen($(this));" onmouseenter="$(this).addClass('preview');" onmouseleave="$(this).removeClass('preview');" Taskbar_id="${app_id}">
            <div class="taskbar_app-icon" style="--bgicon:url('${icon}');"></div>
            <div class="taskbar_app-status"</div>
        </div>
    `);
}
function TaskbarRemove(app_id){
    $(`.taskbar_app[Taskbar_id="${app_id}"]`).remove();
}
function TaskbarOpen(e){
    if($(e).hasClass('minified')){
        $(`.poltab[app_id="${$($(e)).attr('Taskbar_id')}"]`).removeClass('invisible');
        setTimeout(() => {
            $(`.poltab[app_id="${$($(e)).attr('Taskbar_id')}"]`).removeClass('minified');
            $($(e)).addClass('open').removeClass('minified');
        }, 10);
        setTimeout(() => {
            $(`.poltab[app_id="${$($(e)).attr('Taskbar_id')}"]`).removeClass('transition');
        }, parseFloat($(':root').css('--PoltabMinifiedTransitionTime').replace(/(^0-9)/gi,'')));
    }else{
        $(`.poltab[app_id="${$($(e)).attr('Taskbar_id')}"]`).addClass('transition').addClass('minified');
        $($(e)).removeClass('open').addClass('minified');
        setTimeout(() => {
            $(`.poltab[app_id="${$($(e)).attr('Taskbar_id')}"]`).addClass('invisible');
        }, parseFloat($(':root').css('--PoltabMinifiedTransitionTime').replace(/(^0-9)/gi,'')));
    }
}
setInterval(() => {
    $('.taskbar_app').each(function(){
        if($(`.poltab[app_id="${$(this).attr('Taskbar_id')}"]`).hasClass("minified")){
            $(this).removeClass('open');
            $(this).addClass('minified');
        }else{
            $(this).addClass('open');
            $(this).removeClass('minified');
        }
    });
}, 100);