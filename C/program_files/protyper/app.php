<?php include_once '../../polardows/desktop/head.php' ; ?>
<style>
    @font-face {
        font-family: CommodorePixelized;
        src: url(<?php echo $path ?>/appdata/font/CommodorePixelized.ttf)
    }
    * { font-family: "CommodorePixelized", sans-serif; margin: 0;user-select: none; }
    .screen { margin:auto;margin-bottom:4px;display:flex;}
    #typer{ 
        background: green; 
        font-size: 6vw; 
        width:420px;
        height:420px;
    }
    @media(min-width: 600px) {
        #typer{font-size: 46px; }
    }
    .typer_fill { width: 100%; height: 70px; display: flex; }
    .typer_fill div { background: white; width: 70px; display: flex; align-items: center; justify-content: center; height: 100%; font-stretch: normal; }
    .removed { filter:opacity(0); }
    .hud{    width: 200px;
    background: #ddd;display:flex;flex-direction:column;}
</style>
<?php include_once '../../polardows/desktop/init.php' ; ?>
<div class="screen">
    <div id="typer">
        <div class="typer_fill" id="fileira_1"></div>
        <div class="typer_fill" id="fileira_2"></div>
        <div class="typer_fill" id="fileira_3"></div>
        <div class="typer_fill" id="fileira_4"></div>
        <div class="typer_fill" id="fileira_5"></div>
        <div class="typer_fill" id="fileira_6"></div>
    </div>
    <div class="hud">
        <div class="highscore">MAIOR PONTUAÇÃO<br><span></span></div><br><br>
        <div class="score">PONTUAÇÂO ATUAL<br><span></span></div>
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

        setInterval(() => {
            if($("#typer").height() > $("#typer").width()){
                $("#typer").css("width", 'calc(90vh - 6px)');
                $("#typer").css("height", $("#typer").width());
            }
            if($("#typer").width() > $("#typer").height()){
                $("#typer").css("height", 'calc(90vh - 6px)');
                $("#typer").css("width", $("#typer").height());
            }
        }, 10);

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