$(document).ready(()=>{
    $("#taskbar").html('');
});
function TaskbarAdd(app_id,name,icon){
    $("#taskbar").append(`
        <div class="taskbar_app" onmouseenter="$(this).addClass('preview');" onmouseleave="$(this).removeClass('preview');" Taskbar_id="${app_id}">
            <div class="taskbar_app-icon" style="--bgicon:url('${icon}');"></div>
            <div class="taskbar_app-status"</div>
        </div>
    `);
}
function TaskbarRemove(app_id){
    $(`.taskbar_app[Taskbar_id="${app_id}"]`).remove();
}