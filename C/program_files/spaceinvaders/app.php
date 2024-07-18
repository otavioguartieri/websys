<?php include_once '../../Polardows/desktop/head.php' ; ?>
<style>
    .screen{
    }
    .arena{
        position: relative;
        background:#000;
        height:600px;
        width:600px;
        overflow:hidden;
    }
    /* .ship_area{
        position:absolute;
        bottom:0;
        width:100%;
        margin:10px 0;
    } */
    .spaceship{
        position:absolute;
        width:40px;
        height:40px;
        background-size:contain;
        filter:invert(1);
        bottom:0;
    }
    .enemy_area{
        width: 400px;
        position: relative;
        left: 80px;
        top:60px;
    }
    .enemy_space{
        position:absolute;
    }
    .enemy{
        position:absolute;
        width:40px;
        height:40px;
        background-size:contain;
        filter:invert(1);
    }

    .barrier_area{
        position:relative;
        top:460px;
        left:60px;
    }

    .barrier{
        width: 80px;
        display:flex;
        flex-wrap:wrap;
        position:relative;
    }

    .barrier:nth-child(1){ left:0; }
    .barrier:nth-child(2){ left:135px; }
    .barrier:nth-child(3){ left:270px; }
    .barrier:nth-child(4){ left:405px; }

    .barrier .barrier_particion{
        width: 3px;
        height: 3px;
        position:absolute;
        top:0;
        left:0;
        background-color: white;
    }

    .enemy_space:nth-child(1){ top:0px; }
    .enemy_space:nth-child(2){ top:40px; }
    .enemy_space:nth-child(3){ top:80px; }
    .enemy_space:nth-child(4){ top:120px; }
    .enemy_space:nth-child(5){ top:160px; }

    .enemy_space .enemy:nth-child(1) { left:0px; }
    .enemy_space .enemy:nth-child(2) { left:40px; }
    .enemy_space .enemy:nth-child(3) { left:80px; }
    .enemy_space .enemy:nth-child(4) { left:120px; }
    .enemy_space .enemy:nth-child(5) { left:160px; }
    .enemy_space .enemy:nth-child(6) { left:200px; }
    .enemy_space .enemy:nth-child(7) { left:240px; }
    .enemy_space .enemy:nth-child(8) { left:280px; }
    .enemy_space .enemy:nth-child(9) { left:320px; }
    .enemy_space .enemy:nth-child(10){ left:360px; }
    .enemy_space .enemy:nth-child(11){ left:400px; }
    
    .enemy.alive.prst_1[prs="1"]{ background-image:url('<?php echo $path ?>/appdata/assets/sprites/enemy_1-1.png'); }
    .enemy.alive.prst_1[prs="2"]{ background-image:url('<?php echo $path ?>/appdata/assets/sprites/enemy_1-2.png'); }
    .enemy.alive.prst_2[prs="1"]{ background-image:url('<?php echo $path ?>/appdata/assets/sprites/enemy_2-1.png'); }
    .enemy.alive.prst_2[prs="2"]{ background-image:url('<?php echo $path ?>/appdata/assets/sprites/enemy_2-2.png'); }
    .enemy.alive.prst_3[prs="1"]{ background-image:url('<?php echo $path ?>/appdata/assets/sprites/enemy_3-1.png'); }
    .enemy.alive.prst_3[prs="2"]{ background-image:url('<?php echo $path ?>/appdata/assets/sprites/enemy_3-2.png'); }
    .enemy.alive.prst_ufo{ background-image:url('<?php echo $path ?>/appdata/assets/sprites/enemy_ufo.png'); }



    .spaceship.alive.player_1{ background-image:url('<?php echo $path ?>/appdata/assets/sprites/player_1.png');}
    .spaceship.alive.player_2{ background-image:url('<?php echo $path ?>/appdata/assets/sprites/player_2.png');}
    .spaceship.alive.player_3{ background-image:url('<?php echo $path ?>/appdata/assets/sprites/player_3.png');}

    .expls{ background-image:url('<?php echo $path ?>/appdata/assets/sprites/explosion_1.png') !important; }
    .dead{ filter:opacity(0) !important; }
    
</style>
<?php include_once '../../Polardows/desktop/init.php' ; ?>
<div class="screen">
    <div class="arena">
        <div class="enemy_area">
            <div class="enemy_space">
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
            </div>
            <div class="enemy_space">
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
                <div class="enemy alive prst_1" prs="1"></div>
            </div>
            <div class="enemy_space">
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
            </div>
            <div class="enemy_space">
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
                <div class="enemy alive prst_2" prs="1"></div>
            </div>
            <div class="enemy_space">
                <div class="enemy alive prst_3" prs="1"></div>
                <div class="enemy alive prst_3" prs="1"></div>
                <div class="enemy alive prst_3" prs="1"></div>
                <div class="enemy alive prst_3" prs="1"></div>
                <div class="enemy alive prst_3" prs="1"></div>
                <div class="enemy alive prst_3" prs="1"></div>
                <div class="enemy alive prst_3" prs="1"></div>
                <div class="enemy alive prst_3" prs="1"></div>
                <div class="enemy alive prst_3" prs="1"></div>
                <div class="enemy alive prst_3" prs="1"></div>
                <div class="enemy alive prst_3" prs="1"></div>
            </div>
        </div>
        <div class="barrier_area">
            <div class="barrier"></div>
            <div class="barrier"></div>
            <div class="barrier"></div>
            <div class="barrier"></div>
        </div>
        <div class="ship_area">
            <div class="spaceship alive player_2"></div>
        </div>
        <div class="hud_area">
            
        </div>
    </div>
</div>
<?php include_once '../../Polardows/desktop/end.php' ; ?>
<script>

    document.title = 'Space Invaders';

    var column = 1;
    var line = 1;
    var posleft = 0;
    var postop = 0;

    for(var i = 1; i <=300; i++){
        if(column >= 26){
            line++;
            postop += 3;
            posleft = 0;
            column = 1;
        }
        if(i != 1 && i != 2 && i != 3 && i != 23 && i != 24 && i != 25 && i != 26 && i != 50 && i != 51 && i != 75)
            $('.barrier').append(` <div class="barrier_particion" style="left:${posleft}px;top:${postop}px" line="${line}" column="${column}"></div>`);
        column++;
        posleft += 3;
    }

    var velBala = 4; /* velocidade da bala */
    var CoolDownDisparo = 60; /* cooldown da bala */
    var vel_enemey_1 = 8; /* avanço do inimigo na tela */
    var dist_top_queda = 30; /* avanço da queda do inimigo na tela */
    var cnt_ctrl_vel_enemy = 51 /* velocidade do inimigo na tela (quanto menor mais rapido) padrao 50*/
    var cnt_ctrlenemy = 0; /* controle de pixel do inimigo */

    var count_temp_enemy_fire = 0; /* tempo do tiro inicial do inimigo */
    var cntr_enemy_fire = 200; /* tempo de disparo do inimigo */

    var timerDisparo = 70;

    /* controles de movimentação */

    var ElementPos = ($('.ship_area').width()/2)-($('.spaceship').width()/2);
    var AxisX = 0;

    var varDir = 0;
    var varEsq = 0;
    var varTiro = 0;
    
    var vel = 2; /* velocidade do player */

    var game = 'stop';

    document.addEventListener("keydown", function(event){
        if($('.spaceship').hasClass('alive'))
            if(game == 'stop'){
                game = 'start';
            }
        switch (event.keyCode) {
            case 68: varDir = 1; if(varEsq == 1) varEsq = 2; break;
            case 65: varEsq = 1; if(varDir == 1) varDir = 2; break;
            case 39: varDir = 1; if(varEsq == 1) varEsq = 2; break;
            case 37: varEsq = 1; if(varDir == 1) varDir = 2; break;
            case 32: varTiro = 1; break; 
        }
    });
    document.addEventListener("keyup", function(event){
        switch (event.keyCode) {
            case 68: varDir = 0; if(varEsq == 2) varEsq = 1; break;
            case 65: varEsq = 0; if(varDir == 2) varDir = 1; break;
            case 39: varDir = 0; if(varEsq == 2) varEsq = 1; break;
            case 37: varEsq = 0; if(varDir == 2) varDir = 1; break;
            case 32: varTiro = 0; break; 
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

        /* controle de cooldown do disparo */
        if(game == 'start')
            if(varTiro == 1 && timerDisparo > CoolDownDisparo) disparo();
            else if(timerDisparo < 600) timerDisparo += 1;

        /* controle e ação de cada bala */
        $('.bala').each(function(){
            $(this).css('top',`-=${velBala}px`);
            if(parseInt($(this).css('top').replace('px',''))-1 < 0) $(this).remove();
        });

        if($('.enemy.alive') != undefined)
            $('.enemy.alive').each(function(){
                /* colisão com a bala */
                if($('.bala').css('top') != undefined){

                    var top_enemy = $(this)[0].getBoundingClientRect()['top'];
                    var bottom_enemy = $(this)[0].getBoundingClientRect()['bottom'];

                    if($(this).hasClass('.prst_2')){
                        var left_enemy = $(this)[0].getBoundingClientRect()['left'] + 6;
                        var right_enemy = $(this)[0].getBoundingClientRect()['left'] + 28;
                    }else{
                        var left_enemy = $(this)[0].getBoundingClientRect()['left'] + 2;
                        var right_enemy = $(this)[0].getBoundingClientRect()['left'] + 36;
                    }

                    if((parseInt($('.bala').css('top').replace('px',''))) > (top_enemy) && (parseInt($('.bala').css('top').replace('px',''))+12) < (bottom_enemy) && (parseInt($('.bala').css('left').replace('px',''))) > (left_enemy) && (parseInt($('.bala').css('left').replace('px',''))) < (right_enemy)){
                        
                        $(this).removeClass('alive');
                        $(this).addClass('expls');

                        setTimeout(() => {
                            $(this).removeClass('expls');
                            $(this).addClass('dead');
                        }, 200);

                        cnt_ctrl_vel_enemy -= 1;

                        $('.bala').each(function(){
                            if((parseInt($(this).css('top').replace('px',''))) < bottom_enemy)
                                $(this).remove();
                        });
                    }
                }
            });

        if(count_temp_enemy_fire >= cntr_enemy_fire && game == 'start'){

            var inimigo_disparo = $(`.enemy_space:nth-child(${Math.floor(Math.random() * 6).toString()}) .enemy:nth-of-type(${Math.floor(Math.random() * 110).toString().substr(0,1)})`);

            if($(inimigo_disparo).hasClass('alive')){

                var positionDanoX = ($(inimigo_disparo)[0].getBoundingClientRect()['left']-(9)+$(inimigo_disparo).width()/(2)).toFixed('1');
                var positionDanoY = ($(inimigo_disparo)[0].getBoundingClientRect()['top']-(10)).toFixed('1');
                $('.arena').append(`<div class="dano" style="width:3px;height:14px;background:#fff;position:absolute; left:${positionDanoX}px; top:${positionDanoY}px"></div>`);

                count_temp_enemy_fire = 0;
            }
        }
        count_temp_enemy_fire++;

        /* controle e ação de cada bala do inimigo*/
        $('.dano').each(function(){
            $(this).css('top',`+=${velBala}px`);
            
            var leftplayer = parseInt($('.spaceship').css('left').replace('px',''))+0;
            var rightplayer = parseInt($('.spaceship').css('left').replace('px',''))+40;
            var topplayer = parseInt($('.ship_area').css('bottom').replace('px',''))+70;

            if(parseInt($(this).css('top').replace('px',''))+12 > $('.arena').width()) $(this).remove();
            if(parseInt($(this).css('top').replace('px','')) > $('.arena').width()- 30 && parseInt($(this).css('left').replace('px','')) > leftplayer && parseInt($(this).css('left').replace('px','')) < rightplayer){
                
                $(this).remove();

                $('.spaceship').removeClass('alive');
                $('.spaceship').addClass('expls');

                setTimeout(() => {
                    $('.spaceship').removeClass('expls');
                    $('.spaceship').addClass('dead');
                }, 200);

                game = 'stop';
            }
        });

        /* controle de movimentação do inimigo */
        if(cnt_ctrlenemy >= cnt_ctrl_vel_enemy && game == 'start'){

            if(!$('.enemy_area').attr('side'))
                $('.enemy_area').attr('side','right');

            $('.enemy').not('.dead').each(function(){
                if((parseInt($(this).css('left').replace('px','')) + 130) > $('.arena').width()){
                    $('.enemy_area').attr('side','left');
                    $('.enemy_area').attr('down','1');
                }
                if((parseInt($(this).css('left').replace('px',''))) < -70){
                    $('.enemy_area').attr('side','right');
                    $('.enemy_area').attr('down','1');
                }
            });

            if($('.enemy_area').attr('side') == 'right')
                $('.enemy.alive, .enemy.expls').css('left',`+=${vel_enemey_1}`);

            if($('.enemy_area').attr('side') == 'left')
                $('.enemy.alive, .enemy.expls').css('left',`-=${vel_enemey_1}`);
                
            if($('.enemy_area').attr('down') == '1'){
                $('.enemy.alive, .enemy.expls').css('top',`+=${vel_enemey_1}`);
                $('.enemy_area').attr('down','0');
            }
                
            if($('.enemy_area').attr('side')){
                if($('.enemy.alive').attr('prs') == '1')
                    $('.enemy.alive').attr('prs','2');
                else if($('.enemy.alive').attr('prs') == '2')
                    $('.enemy.alive').attr('prs','1');
            }

            cnt_ctrlenemy = 0;
        }
        cnt_ctrlenemy ++;

    }, 10);

    /* function do disparo */

    var cnt = 0;

    function disparo(){
        timerDisparo = 0;  

        $('body').append(`<audio style="display:none;" src="../files/spaceinvaders/assets/audios/shot.mp3" controls id="myAudio_${cnt}" onplay="autoRemove($(this),'200');"></audio>`);
        $('#myAudio_'+cnt).trigger("play");
        
        cnt++;

        var positionBalaX = (parseInt($('.spaceship').css('left').replace('px',''))-(1.5)+$('.spaceship').width()/(2)).toFixed('1');
        var positionBalaY = ($('.arena').width() - 30).toFixed('1');
        $('.arena').append(`<div class="bala" style="width:3px;height:14px;background:#fff;position:absolute; left:${positionBalaX}px; top:${positionBalaY}px"></div>`);
    }

    function autoRemove(e,d){
        setTimeout(() => {
            $(e).remove();
        }, d);
    }

</script>
<?php include_once '../../Polardows/desktop/bottom.php' ; ?>