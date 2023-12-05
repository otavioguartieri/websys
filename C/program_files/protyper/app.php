<?php include_once '../../polardows/desktop/head.php' ; ?>
<style>
    :root{
        --hudsizew:calc(100% / 3);
        --hudsizeh:100%;
        --typersizew:calc(calc(100% / 3)*2);
        --typersizeh:100%;
    }

    @font-face {
        font-family: CommodorePixelized;
        src: url(<?php echo $path ?>/appdata/font/CommodorePixelized.ttf)
    }
    * { font-family: "CommodorePixelized", sans-serif; margin: 0;user-select: none; }
    .screen {
        aspect-ratio: 3/2 !important;
        display: flex;
        justify-content: center;
        width: 100%;
        max-width: 100%;
        max-height: 100%;
    }
    .case {
        max-width: 100%;
        max-height: 100%;
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #hud{
        aspect-ratio: 1/2 !important;
        height: var(--hudsizeh);
        max-width:100%;
        max-height:100%;
        font-size:6vmin;
        background: #ddd;
        display:flex;
        flex-direction:column;
    }
    #typer{ 
        aspect-ratio: 1/1 !important;
        background: green; 
        font-size: 11vmin;     
        /* width:var(--typersizew); */
        height:var(--typersizeh);
        max-width:100%;
        max-height:100%;
    }
    .typer_fill { width: 100%; height: calc(100% / 6); display: flex; }
    .typer_fill div { background: white; width: calc(100% / 6); display: flex; align-items: center; justify-content: center; height: 100%; font-stretch: normal; }
    .removed { filter:opacity(0); }
</style>
<?php include_once '../../polardows/desktop/init.php' ; ?>
<div class="case">
    <div class="screen">
        <div id="typer">
            <div class="typer_fill" id="fileira_1"></div>
            <div class="typer_fill" id="fileira_2"></div>
            <div class="typer_fill" id="fileira_3"></div>
            <div class="typer_fill" id="fileira_4"></div>
            <div class="typer_fill" id="fileira_5"></div>
            <div class="typer_fill" id="fileira_6"></div>
        </div>
        <div id="hud">
            <div class="highscore">MAIOR PONTUAÇÃO<br><span></span></div><br><br>
            <div class="score">PONTUAÇÂO ATUAL<br><span></span></div>
        </div>
    </div>
</div>
<?php include_once '../../polardows/desktop/end.php' ; ?>
<script>

    let num = new Array(36);
    var cont = 1;
    var cntrl = 1;
    var arrayCont = 0;
    var cntLine = 0;

    $(window).on("load", function(){

        document.title="Monkey Typer!!";


        addEventListener("keyup", (event) => {
            if (event.key == 0 || event.key == 1)
                if (num[arrayCont] == event.key) {
                    $(`#TyperLine_${arrayCont}`).addClass("removed");
                    $('.score span').html(parseInt($('.score span').html())+1);

                    if(parseInt($('.score span').html()) > parseInt($('.highscore span').html()))
                        $('.highscore span').html(parseInt($('.score span').html()));

                    arrayCont++;
                    $(`#TyperLine_${arrayCont}`).css("color", "red");
                } else {
                    /* ao errar */
                    alert('perdeu');
                    nextPhase('perdeu');
                }
            if (arrayCont == 36) {
                /* ao terminar */
                    nextPhase('next');
            }
        });

        getRandom();

    });

    function getRandom(act) {
        $(".typer_fill").html("");

        if(parseInt($('.score span').html()) > getItem('protyper_highscore'))
            setItem('protyper_highscore',parseInt($('.score span').html()));

        $('.highscore span').html(getItem('protyper_highscore'));
        if(act != 'next')
            $('.score span').html('0');

        cont = 1;
        cntrl = 1;
        cntLine = 0;
        arrayCont = 0;

        $(".typer_fill").css("filter", "opacity(100)");

        $.each(num, function (k, v) {
            num[k] = Math.floor(Math.random() * 2).toString();

            if (cont <= 6) {
            $(`#fileira_${cntrl}`).append(
                `<div id="TyperLine_${cntLine}">${num[k]}</div>`
            );
            }
            if (cont == 6) {
                cont = 0;
                cntrl++;
            }
            cont++;
            cntLine++;
        });
        $(`#TyperLine_0`).css("color", "red");
    }
    function nextPhase(act){
        setTimeout(() => {
            /* alert('terminou'); */
            getRandom(act);
        }, 100);
    }
</script>
<?php include_once '../../polardows/desktop/bottom.php' ; ?>