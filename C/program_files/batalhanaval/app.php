
<?php include_once '../../polardows/desktop/head.php' ; ?>
<style>
    @font-face {
        font-family:righteous;
        src: url(<?php echo $path ?>/appdata/assets/fonts/Righteous-Regular.ttf);
    }
    *{user-select:none;font-family:righteous;margin:0;}
    html{
        padding:0 0 4px 0;
    }
    .arena{
        width:400px;
        height:400px;
        display:flex;
        border: 10px solid #ccc ;
        flex-wrap:wrap;
        background-image: url('<?php echo $path ?>/appdata/assets/gifs/wave_pixel.gif');
        background-repeat: no-repeat;
        background-position: center; 
        background-size: 100%;
    }
    .arena div{
        display:flex;
        align-items:center;
        height:40px;
        width:400px;
    }
    .arena .line .space{
        width:39px;
        height:39px;
        border:0.5px solid #ccc;
    }
    .screen{
        display:flex;
        justify-content:center;
        background-color:white;
        margin:auto;
    }
    .menu{
        border:10px solid #aaa;
        width:220px;
    }
    .btn_navselect{
        width:40px;
        height:40px;
        background-color:#bbb;
    }


    .select_ok{
        background:#00CD0060;
        -webkit-box-shadow: inset 0px 0px 0px 2px #00CD0080;
        -moz-box-shadow: inset 0px 0px 0px 2px #00CD0080;
        box-shadow: inset 0px 0px 0px 2px #00CD0080;
    }
    .select_off{
        background:#FF000060;
        -webkit-box-shadow: inset 0px 0px 0px 2px #FF000080;
        -moz-box-shadow: inset 0px 0px 0px 2px #FF000080;
        box-shadow: inset 0px 0px 0px 2px #FF000080;
    }
</style>
<?php include_once '../../polardows/desktop/init.php' ; ?>
<div class="screen">
    <div class="arena">
    </div>
    <div class="menu">
        <div onclick="choose_ship('1');" class="btn_navselect navio_4">1</div>
        <div onclick="choose_ship('2');" class="btn_navselect navio_4">2</div>
        <div onclick="choose_ship('3');" class="btn_navselect navio_4">3</div>
        <div onclick="choose_ship('4');" class="btn_navselect navio_4">4</div>
    </div>
</div>
<?php include_once '../../polardows/desktop/end.php' ; ?>
<script>

    document.title = 'Batalha naval muito louca insana de alta complexidade top one brazil dos guri (BNI)';

    var cont_line = 1;
    var cont_column = 1;
    for(var i = 1; i <= 100; i ++){
        if(cont_column == 1)
            $('.arena').append(`<div class="line" id="line_${cont_line}"></div>`);
        $(`#line_${cont_column}`).append(`<div class="space" id="space_${cont_line}"></div>`);
        cont_line++;
        if(cont_line > 10){
            cont_line = 1;
            cont_column++;
        }
    }

    /* $( ".space" ).mouseover(function() {
        $(this).css('background-color','orange');
    }); */

    removeItem('battleship_ship_type');
    removeItem('battleship_ship_rotate');

    function choose_ship(ship_type){
        setItem('battleship_ship_type',ship_type);
        setItem('battleship_ship_rotate',1);
    }

    window.addEventListener("keydown", (event) => {
        if(event.keyCode == 32){
            if(getItem('battleship_ship_rotate') <= 3 ) setItem('battleship_ship_rotate',(parseInt(getItem('battleship_ship_rotate'))+1));
            else setItem('battleship_ship_rotate','1');
        }
        $(".space").mouseleave();
        $(`#line_${getItem('battleship_ship_cord_line')}`).find(`#space_${getItem('battleship_ship_cord_space')}`).mouseenter();
    });

    $( ".space" ).mouseenter(function() {

        var id_space = $(this).attr('id').split('_')[1];
        var id_line = $(this).parent().attr('id').split('_')[1];
        setItem('battleship_ship_cord_line',id_line);
        setItem('battleship_ship_cord_space',id_space);
        var OffShow = 0;
        if(getItem('battleship_ship_rotate') == '1'){
            for(var i = 0;i<=(getItem('battleship_ship_type')-1);i++){
                if($(`#line_${parseInt(id_line)}`).find(`#space_${parseInt(id_space)+i}`).length == false){
                    OffShow++;
                }
                $(`#line_${parseInt(id_line)}`).find(`#space_${parseInt(id_space)+i}`).addClass('select_ok');
            }
            if(OffShow > 0){
                for(var i = 0;i<=(getItem('battleship_ship_type')-1);i++){
                    $(`#line_${parseInt(id_line)}`).find(`#space_${parseInt(id_space)+i}`).addClass('select_off');
                }
            }
        }
        if(getItem('battleship_ship_rotate') == '2'){
            for(var i = 0;i<=(getItem('battleship_ship_type')-1);i++){
                if($(`#line_${parseInt(id_line)+i}`).find(`#space_${parseInt(id_space)}`).length == false){
                    OffShow++;
                }
                $(`#line_${parseInt(id_line)+i}`).find(`#space_${parseInt(id_space)}`).addClass('select_ok');
            }
            if(OffShow > 0){
                for(var i = 0;i<=(getItem('battleship_ship_type')-1);i++){
                    $(`#line_${parseInt(id_line)+i}`).find(`#space_${parseInt(id_space)}`).addClass('select_off');
                }
            }
        }
        if(getItem('battleship_ship_rotate') == '3'){
            for(var i = 0;i<=(getItem('battleship_ship_type')-1);i++){
                if($(`#line_${parseInt(id_line)}`).find(`#space_${parseInt(id_space)-i}`).length == false){
                    OffShow++;
                }
                $(`#line_${parseInt(id_line)}`).find(`#space_${parseInt(id_space)-i}`).addClass('select_ok');
            }
            if(OffShow > 0){
                for(var i = 0;i<=(getItem('battleship_ship_type')-1);i++){
                    $(`#line_${parseInt(id_line)}`).find(`#space_${parseInt(id_space)-i}`).addClass('select_off');
                }
            }
        }
        if(getItem('battleship_ship_rotate') == '4'){
            for(var i = 0;i<=(getItem('battleship_ship_type')-1);i++){
                if($(`#line_${parseInt(id_line)-i}`).find(`#space_${parseInt(id_space)}`).length == false){
                    OffShow++;
                }
                $(`#line_${parseInt(id_line)-i}`).find(`#space_${parseInt(id_space)}`).addClass('select_ok');
            }
            if(OffShow > 0){
                for(var i = 0;i<=(getItem('battleship_ship_type')-1);i++){
                    $(`#line_${parseInt(id_line)-i}`).find(`#space_${parseInt(id_space)}`).addClass('select_off');
                }
            }
        }
    }); 

    $( ".space" ).mouseleave(function() {
        $('.space').removeClass('select_off');
        $('.space').removeClass('select_ok');
    }); 
</script>
<?php include_once '../../polardows/desktop/bottom.php' ; ?>