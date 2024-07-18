<?php include_once '../../Polardows/desktop/head.php' ; ?>

<!-- tetris grid: 20x10 -->
<!-- each block: 25px  -->
<!-- delay padrão 1s -> 1000ms -->

<style>
    :root{
        --BlockPieceBorderWidth: 12.5px;
    }
    .screen{
        display:flex;
    }
    .arena{
        position: relative;
        background:#000;
        height:400px;
        width:600px;
        overflow:hidden;
    }
    .snake .bodyPart{
        width: 20px;
        height: 20px;
        background:red; 
    }
</style>
<?php include_once '../../Polardows/desktop/init.php' ; ?>
<div class="screen">
    <div class="arena">
        <div class="snake alive">
            <div class="bodyPart"></div>
        </div>
    </div>
</div>
<?php include_once '../../Polardows/desktop/end.php' ; ?>
<script>

    document.title = 'Snake Game';

    /* controles de movimentação */

    var ElementPos = ($('.snake').width()/2)-($('.spaceship').width()/2);
    var AxisX = 0;

    var varDir = 0;
    var varEsq = 0;
    
    var vel = 2; /* velocidade do player */

    var game = 'stop';

    document.addEventListener("keydown", function(event){
        if($('.snake').hasClass('alive'))
            if(game == 'stop'){
                game = 'start';
            }
        switch (event.keyCode) {
            case 68: varDir = 1; if(varEsq == 1) varEsq = 2; break;
            case 65: varEsq = 1; if(varDir == 1) varDir = 2; break;
            case 39: varDir = 1; if(varEsq == 1) varEsq = 2; break;
            case 37: varEsq = 1; if(varDir == 1) varDir = 2; break;
        }
    });
    document.addEventListener("keyup", function(event){
        switch (event.keyCode) {
            case 68: varDir = 0; if(varEsq == 2) varEsq = 1; break;
            case 65: varEsq = 0; if(varDir == 2) varDir = 1; break;
            case 39: varDir = 0; if(varEsq == 2) varEsq = 1; break;
            case 37: varEsq = 0; if(varDir == 2) varDir = 1; break;
        }
    });

    /* motor de movimentação */
    setInterval(() => {
        
        /* movimentação do player */
        if((ElementPos + AxisX) > 0){
            if(varEsq == 1) AxisX -= vel; 
        }else{
            AxisX = ElementPos - $('.ship_area').width()+$('.spaceship').width();
        }
        if((ElementPos + AxisX) < $('.ship_area').width()-$('.spaceship').width()){
            if(varDir == 1) AxisX += vel; 
        }else{
            AxisX = $('.ship_area').width()/2-$('.spaceship').width()/2;
        }
        $('.spaceship').css('left',ElementPos + AxisX);

    }, 10);
</script>
<?php include_once '../../Polardows/desktop/bottom.php' ; ?>