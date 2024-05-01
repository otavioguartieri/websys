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
        height:525px;
        width:300px;
        overflow:hidden;
    }
    .backgroundarea{
        position:relative;
    }
    .hud{
        width:100px;
    }
    .block{
        width:25px;
        height:25px;
        position:absolute;
        z-index: 1;
    }
    .block.wall{
        background-color:#222;
    }
    .block.piece{
        border-top:var(--BlockPieceBorderWidth) solid #ffffff88;
        border-right:var(--BlockPieceBorderWidth) solid #00000022;
        border-bottom:var(--BlockPieceBorderWidth) solid #00000055;
        border-left:var(--BlockPieceBorderWidth) solid #00000022;
        box-sizing: border-box;
        z-index: 2;
    }
    .block.piece:not(.active){
        filter:brightness(0.9);
    }
    .block.lined{
        border:1px solid #222;
        box-sizing: border-box;
    }
</style>
<?php include_once '../../Polardows/desktop/init.php' ; ?>
<div class="screen">
    <div class="hud left">a</div>
    <div class="arena">
    </div>
    <div class="hud right">a</div>
</div>
<?php include_once '../../Polardows/desktop/end.php' ; ?>
<script>

    document.title = 'Tetris';

    var arena = '.arena .gamearea';
    var height = 21; /* 20 + 1 for wall */
    var width = 12; /* 10 + 2 for walls */
    var blocks = height*width;
    var delay = 800;

    var completedLines = [];

    /* block types array, for randomizer */
    var piecesOrder = ['I','J','L','O','S','T','Z'];

    var color = '#000';

    var blockId = 0;

    var alive = 0;

    function start(){

        for(var cl = 0;cl<20;cl++){
            completedLines[cl] = 0;
        }

        var count = 0;
        var line = 1;
        var left = 0;
        var top = 0;
 
        blockId = 0;

        $('.arena').html('<div class="gamearea"></div> <div class="backgroundarea"></div>');
        for(var s=1;s<=blocks;s++){
            if(count == width){line++;count=0;left=0;top+=25;}
                $('.arena .backgroundarea').append(`<div class="block lined c${count} l${line}" col="${count}" line="${line}" style="left:${left}px;top:${top}px;"></div>`);
            count++;
            left+=25;
        }
        $('.block.lined.c0,.block.lined.c11,.block.lined.l21').addClass('wall');
        $('.block.lined.c0,.block.lined.c11,.block.lined.l21').addClass('barrier');
        setTimeout(() => {
            alive = 1;
            generateBlock();
        }, 3000);
    }

    /* block randomizer */

    function generateBlock(){
        if($('.block.lined.c4.l2').hasClass('wall') || $('.block.lined.c5.l2').hasClass('wall') || $('.block.lined.c6.l2').hasClass('wall') || $('.block.lined.c7.l2').hasClass('wall')){
            alive = 0;
        }
        if(alive == 1){
            switch(piecesOrder[randomNum(7)]){
                case 'I': IBlock(); break;
                case 'J': JBlock(); break;
                case 'L': LBlock(); break;
                case 'O': OBlock(); break;
                case 'S': SBlock(); break;
                case 'T': TBlock(); break;
                case 'Z': ZBlock(); break;
                default : generateBlock();
            }
            blockId++;
        }
    }

    /* block compiler */

    /* piece name, grid size, p1 col, p1 line... */

    function generatePiece(type,grid,p1col,p1line,p2col,p2line,p3col,p3line,p4col,p4line,color){
        $(arena).append(`<div class="block piece active" col="${p1col}" line="${p1line}" Piecerotation="0" gridSize="${grid}" PieceName="${type}" id="Block${blockId}-1" style="left:${p1col*25}px;top:${(p1line-1)*25}px;background-color:${color};"></div>`);
        $(arena).append(`<div class="block piece active" col="${p2col}" line="${p2line}" Piecerotation="0" gridSize="${grid}" PieceName="${type}" id="Block${blockId}-2" style="left:${p2col*25}px;top:${(p2line-1)*25}px;background-color:${color};"></div>`);
        $(arena).append(`<div class="block piece active" col="${p3col}" line="${p3line}" Piecerotation="0" gridSize="${grid}" PieceName="${type}" id="Block${blockId}-3" style="left:${p3col*25}px;top:${(p3line-1)*25}px;background-color:${color};"></div>`);
        $(arena).append(`<div class="block piece active" col="${p4col}" line="${p4line}" Piecerotation="0" gridSize="${grid}" PieceName="${type}" id="Block${blockId}-4" style="left:${p4col*25}px;top:${(p4line-1)*25}px;background-color:${color};"></div>`);
    }

    /* definition of block structure functions */
    function IBlock(){
        color = 'cyan';

        /* generatePiece(3,2,color);
        generatePiece(4,2,color);
        generatePiece(5,2,color);
        generatePiece(6,2,color); */

        generatePiece('I',4,4,2,5,2,6,2,7,2,color);
    }
    function JBlock(){
        color = 'blue';

        /* generatePiece(3,1,color);
        generatePiece(3,2,color);
        generatePiece(4,2,color);
        generatePiece(5,2,color); */

        generatePiece('J',3,4,1,4,2,5,2,6,2,color)
    }
    function LBlock(){
        color = 'orange';

        /* generatePiece(3,2,color);
        generatePiece(4,2,color);
        generatePiece(5,2,color);
        generatePiece(5,1,color); */

        generatePiece('L',3,4,2,5,2,6,2,6,1,color);
    }
    function OBlock(){
        color = 'yellow';

        /* generatePiece(4,1,color);
        generatePiece(4,2,color);
        generatePiece(5,2,color);
        generatePiece(5,1,color); */

        generatePiece('O',2,5,1,5,2,6,2,6,1,color);
    }
    function SBlock(){
        color = 'green';

        /* generatePiece(3,2,color);
        generatePiece(4,2,color);
        generatePiece(4,1,color);
        generatePiece(5,1,color); */

        generatePiece('S',3,4,2,5,2,5,1,6,1,color);
    }
    function TBlock(){
        color = 'purple';

        /* generatePiece(4,1,color);
        generatePiece(3,2,color);
        generatePiece(4,2,color);
        generatePiece(5,2,color); */

        generatePiece('T',3,5,1,4,2,5,2,6,2,color);
    }
    function ZBlock(){
        color = 'red';

        /* generatePiece(3,1,color);
        generatePiece(4,1,color);
        generatePiece(4,2,color);
        generatePiece(5,2,color); */

        generatePiece('Z',3,4,1,5,1,5,2,6,2,color);
    }

    /* auto update cordinates on declareted pieces */
    function cordinates(e){
        $(e).attr('col',(parseInt($(e).css('left').replace('px',''))/25));
        $(e).attr('line',((parseInt($(e).css('top').replace('px',''))/25)+1));
    }

    /* key capture */
    document.addEventListener("keydown", function(event){
        var piece = $('.piece.active');
        var rotation = $('.piece.active').attr('Piecerotation');
        var type = $('.piece.active').attr('PieceName');
        var piece1 = $('.piece.active[id$="1"]');
        var piece2 = $('.piece.active[id$="2"]');
        var piece3 = $('.piece.active[id$="3"]');
        var piece4 = $('.piece.active[id$="4"]');
        
        var YCordP1 = parseInt($(piece1).attr('line'));
        var YCordP2 = parseInt($(piece2).attr('line'));
        var YCordP3 = parseInt($(piece3).attr('line'));
        var YCordP4 = parseInt($(piece4).attr('line'));
        var XCordP1 = parseInt($(piece1).attr('col'));
        var XCordP2 = parseInt($(piece2).attr('col'));
        var XCordP3 = parseInt($(piece3).attr('col'));
        var XCordP4 = parseInt($(piece4).attr('col'));


        if(event.keyCode == 32){

            if(type == 'I'){
                if(rotation == '0'){
                    if($(`.block.lined.l${YCordP2-1}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2+1}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2+2}.c${XCordP2}`).hasClass('wall') == false ){
                        $(piece1).css('top',`+=50px`).css('left',`+=25px`);
                        $(piece2).css('top',`+=25px`);
                        $(piece3).css('left',`-=25px`);
                        $(piece4).css('top',`-=25px`).css('left',`-=50px`);
                        $(piece).attr('piecerotation','1');
                    }else if($(`.block.lined.l${YCordP2-2}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2-1}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2+1}.c${XCordP2}`).hasClass('wall') == false ){
                        $('.piece.active').css('top','-=25px');

                        $(piece1).css('top',`+=50px`).css('left',`+=25px`);
                        $(piece2).css('top',`+=25px`);
                        $(piece3).css('left',`-=25px`);
                        $(piece4).css('top',`-=25px`).css('left',`-=50px`);
                        $(piece).attr('piecerotation','1');
                    }else if($(`.block.lined.l${YCordP2-3}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2-2}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2-1}.c${XCordP2}`).hasClass('wall') == false ){
                        $('.piece.active').css('top','-=50px');

                        $(piece1).css('top',`+=50px`).css('left',`+=25px`);
                        $(piece2).css('top',`+=25px`);
                        $(piece3).css('left',`-=25px`);
                        $(piece4).css('top',`-=25px`).css('left',`-=50px`);
                        $(piece).attr('piecerotation','1');
                    }
                }
                if(rotation == '1'){
                    if($(`.block.lined.l${YCordP2}.c${XCordP2-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+2}`).hasClass('wall') == false){
                        $(piece1).css('left',`+=50px`).css('top',`-=25px`);
                        $(piece2).css('left',`+=25px`);
                        $(piece3).css('top',`+=25px`);
                        $(piece4).css('top',`+=50px`).css('left',`-=25px`);
                        $(piece).attr('piecerotation','2');
                    }else if($(`.block.lined.l${YCordP2}.c${XCordP2+3}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+2}`).hasClass('wall') == false){
                        $('.piece.active').css('left','+=25px');

                        $(piece1).css('left',`+=50px`).css('top',`-=25px`);
                        $(piece2).css('left',`+=25px`);
                        $(piece3).css('top',`+=25px`);
                        $(piece4).css('top',`+=50px`).css('left',`-=25px`);
                        $(piece).attr('piecerotation','2');
                    }else if($(`.block.lined.l${YCordP2}.c${XCordP2-2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2-1}`).hasClass('wall') == false){
                        $('.piece.active').css('left','-=25px');

                        $(piece1).css('left',`+=50px`).css('top',`-=25px`);
                        $(piece2).css('left',`+=25px`);
                        $(piece3).css('top',`+=25px`);
                        $(piece4).css('top',`+=50px`).css('left',`-=25px`);
                        $(piece).attr('piecerotation','2');
                    }else if($(`.block.lined.l${YCordP2}.c${XCordP2-3}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2-2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2-1}`).hasClass('wall') == false){
                        $('.piece.active').css('left','-=50px');

                        $(piece1).css('left',`+=50px`).css('top',`-=25px`);
                        $(piece2).css('left',`+=25px`);
                        $(piece3).css('top',`+=25px`);
                        $(piece4).css('top',`+=50px`).css('left',`-=25px`);
                        $(piece).attr('piecerotation','2');
                    }
                }
                if(rotation == '2'){
                    if($(`.block.lined.l${YCordP2-2}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2-1}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2+1}.c${XCordP2}`).hasClass('wall') == false){
                        $(piece1).css('left',`-=25px`).css('top',`-=50px`);
                        $(piece2).css('top',`-=25px`);
                        $(piece3).css('left',`+=25px`);
                        $(piece4).css('left',`+=50px`).css('top',`+=25px`);
                        $(piece).attr('piecerotation','3');
                    }else if($(`.block.lined.l${YCordP2-3}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2-2}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2-1}.c${XCordP2}`).hasClass('wall') == false){
                        $('.piece.active').css('top','-=25px');

                        $(piece1).css('left',`-=25px`).css('top',`-=50px`);
                        $(piece2).css('top',`-=25px`);
                        $(piece3).css('left',`+=25px`);
                        $(piece4).css('left',`+=50px`).css('top',`+=25px`);
                        $(piece).attr('piecerotation','3');
                    }
                }
                if(rotation == '3'){
                    if($(`.block.lined.l${YCordP2}.c${XCordP2-2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+1}`).hasClass('wall') == false){
                        $(piece1).css('left',`-=50px`).css('top',`+=25px`);
                        $(piece2).css('left',`-=25px`);
                        $(piece3).css('top',`-=25px`);
                        $(piece4).css('top',`-=50px`).css('left',`+=25px`);
                        $(piece).attr('piecerotation','0');
                    }else if($(`.block.lined.l${YCordP2}.c${XCordP2-3}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2-2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2-1}`).hasClass('wall') == false){
                        $('.piece.active').css('left','-=25px');
                        
                        $(piece1).css('left',`-=50px`).css('top',`+=25px`);
                        $(piece2).css('left',`-=25px`);
                        $(piece3).css('top',`-=25px`);
                        $(piece4).css('top',`-=50px`).css('left',`+=25px`);
                        $(piece).attr('piecerotation','0');
                    }else if($(`.block.lined.l${YCordP2}.c${XCordP2-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+2}`).hasClass('wall') == false){
                        $('.piece.active').css('left','+=25px');

                        $(piece1).css('left',`-=50px`).css('top',`+=25px`);
                        $(piece2).css('left',`-=25px`);
                        $(piece3).css('top',`-=25px`);
                        $(piece4).css('top',`-=50px`).css('left',`+=25px`);
                        $(piece).attr('piecerotation','0');
                    }else if($(`.block.lined.l${YCordP2}.c${XCordP2+3}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+2}`).hasClass('wall') == false){
                        $('.piece.active').css('left','+=50px');

                        $(piece1).css('left',`-=50px`).css('top',`+=25px`);
                        $(piece2).css('left',`-=25px`);
                        $(piece3).css('top',`-=25px`);
                        $(piece4).css('top',`-=50px`).css('left',`+=25px`);
                        $(piece).attr('piecerotation','0');
                    }
                }
            }
            if(type == 'J'){
                if(rotation == '0'){
                    if($(`.block.lined.l${YCordP3-1}.c${XCordP3}`).hasClass('wall') == false && $(`.block.lined.l${YCordP3+1}.c${XCordP3}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2+1}.c${XCordP2}`).hasClass('wall') == false){
                        $(piece1).css('top',`+=50px`);
                        $(piece2).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece4).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece).attr('piecerotation','1');
                    }else if($(`.block.lined.l${YCordP3-2}.c${XCordP3}`).hasClass('wall') == false && $(`.block.lined.l${YCordP3-1}.c${XCordP3}`).hasClass('wall') == false){
                        $('.piece.active').css('top','-=25px');

                        $(piece1).css('top',`+=50px`);
                        $(piece2).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece4).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece).attr('piecerotation','1');
                    }
                }
                if(rotation == '1'){
                    if($(`.block.lined.l${YCordP3}.c${XCordP3-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP3}.c${XCordP3+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+1}`).hasClass('wall') == false){
                        $(piece1).css('left',`+=50px`);
                        $(piece2).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece4).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece).attr('piecerotation','2');
                    }else if($(`.block.lined.l${YCordP3}.c${XCordP3-2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP3}.c${XCordP3-1}`).hasClass('wall') == false){
                        $('.piece.active').css('left','-=25px');
                        
                        $(piece1).css('left',`+=50px`);
                        $(piece2).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece4).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece).attr('piecerotation','2');
                    }
                }
                if(rotation == '2'){
                    if($(`.block.lined.l${YCordP2-1}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP3-1}.c${XCordP3}`).hasClass('wall') == false && $(`.block.lined.l${YCordP3+1}.c${XCordP3}`).hasClass('wall') == false){
                        $(piece1).css('top',`-=50px`);
                        $(piece2).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece4).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece).attr('piecerotation','3');
                    }
                }
                if(rotation == '3'){
                    if($(`.block.lined.l${YCordP2}.c${XCordP2-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP3}.c${XCordP3-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP3}.c${XCordP3+1}`).hasClass('wall') == false){
                        $(piece1).css('left',`-=50px`);
                        $(piece2).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece4).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece).attr('piecerotation','0');
                    }else if($(`.block.lined.l${YCordP3}.c${XCordP3+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP3}.c${XCordP3+2}`).hasClass('wall') == false){
                        $('.piece.active').css('left','+=25px');
                        
                        $(piece1).css('left',`-=50px`);
                        $(piece2).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece4).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece).attr('piecerotation','0');
                    }
                }
            }
            if(type == 'L'){
                if(rotation == '0'){
                    if($(`.block.lined.l${YCordP2-1}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2+1}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1-1}.c${XCordP1}`).hasClass('wall') == false){
                        $(piece1).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece3).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece4).css('left',`-=50px`);
                        $(piece).attr('piecerotation','1');
                    }else if($(`.block.lined.l${YCordP2-1}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2-2}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1-1}.c${XCordP1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1-2}.c${XCordP1}`).hasClass('wall') == false){
                        $('.piece.active').css('top','-=25px');
                        
                        $(piece1).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece3).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece4).css('left',`-=50px`);
                        $(piece).attr('piecerotation','1');
                    }
                }
                if(rotation == '1'){
                    if($(`.block.lined.l${YCordP2}.c${XCordP2-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1}.c${XCordP1-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+1}`).hasClass('wall') == false){
                        $(piece1).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece3).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece4).css('top',`+=50px`);
                        $(piece).attr('piecerotation','2');
                    }else if($(`.block.lined.l${YCordP2}.c${XCordP2-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1}.c${XCordP1-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2-2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1}.c${XCordP1-2}`).hasClass('wall') == false){
                        $('.piece.active').css('left','-=25px');
                        
                        $(piece1).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece3).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece4).css('top',`+=50px`);
                        $(piece).attr('piecerotation','2');
                    }
                }
                if(rotation == '2'){
                    if($(`.block.lined.l${YCordP2-1}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1+1}.c${XCordP1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2+1}.c${XCordP2}`).hasClass('wall') == false){
                        $(piece1).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece3).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece4).css('left',`+=50px`);
                        $(piece).attr('piecerotation','3');
                    }
                }
                if(rotation == '3'){
                    if($(`.block.lined.l${YCordP2}.c${XCordP2-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1}.c${XCordP1+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+1}`).hasClass('wall') == false){
                        $(piece1).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece3).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece4).css('top',`-=50px`);
                        $(piece).attr('piecerotation','0');
                    }else if($(`.block.lined.l${YCordP2}.c${XCordP2+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1}.c${XCordP1+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1}.c${XCordP1+2}`).hasClass('wall') == false){
                        $('.piece.active').css('left','+=25px');
                        
                        $(piece1).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece3).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece4).css('top',`-=50px`);
                        $(piece).attr('piecerotation','0');
                    }
                }
            }
            if(type == 'S'){
                if(rotation == '0'){
                    if($(`.block.lined.l${YCordP1-1}.c${XCordP1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2+1}.c${XCordP2}`).hasClass('wall') == false){
                        $(piece1).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece3).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece4).css('left',`-=50px`);
                        $(piece).attr('piecerotation','1');
                    }else if($(`.block.lined.l${YCordP1-2}.c${XCordP1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1-1}.c${XCordP1}`).hasClass('wall') == false){
                        $('.piece.active').css('top','-=25px');

                        $(piece1).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece3).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece4).css('left',`-=50px`);
                        $(piece).attr('piecerotation','1');
                    }
                }
                if(rotation == '1'){
                    if($(`.block.lined.l${YCordP1}.c${XCordP1-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+1}`).hasClass('wall') == false){
                        $(piece1).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece3).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece4).css('top',`+=50px`);
                        $(piece).attr('piecerotation','2');
                    }else if($(`.block.lined.l${YCordP1}.c${XCordP1-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1}.c${XCordP1-2}`).hasClass('wall') == false){
                        $('.piece.active').css('left','-=25px');
                    
                        $(piece1).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece3).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece4).css('top',`+=50px`);
                        $(piece).attr('piecerotation','2');
                    }
                }
                if(rotation == '2'){
                    if($(`.block.lined.l${YCordP2-1}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1+1}.c${XCordP1}`).hasClass('wall') == false){
                        $(piece1).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece3).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece4).css('left',`+=50px`);
                        $(piece).attr('piecerotation','3');
                    }
                }
                if(rotation == '3'){
                    if($(`.block.lined.l${YCordP2}.c${XCordP2-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1}.c${XCordP1+1}`).hasClass('wall') == false){
                        $(piece1).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece3).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece4).css('top',`-=50px`);
                        $(piece).attr('piecerotation','0');
                    }else if($(`.block.lined.l${YCordP1}.c${XCordP1+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1}.c${XCordP1+2}`).hasClass('wall') == false){
                        $('.piece.active').css('left','+=25px');
                        
                        $(piece1).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece3).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece4).css('top',`-=50px`);
                        $(piece).attr('piecerotation','0');
                    }
                }
            }
            if(type == 'T'){
                if(rotation == '0'){
                    if($(`.block.lined.l${YCordP3+1}.c${XCordP3}`).hasClass('wall') == false){
                        $(piece1).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece2).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece4).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece).attr('piecerotation','1');
                    }else if($(`.block.lined.l${YCordP2-1}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1-1}.c${XCordP1}`).hasClass('wall') == false){
                        $('.piece.active').css('top','-=25px');
                        
                        $(piece1).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece2).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece4).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece).attr('piecerotation','1');
                    }
                }
                if(rotation == '1'){
                    if($(`.block.lined.l${YCordP3}.c${XCordP3+1}`).hasClass('wall') == false){
                        $(piece1).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece2).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece4).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece).attr('piecerotation','2');
                    }else if($(`.block.lined.l${YCordP2}.c${XCordP2-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1}.c${XCordP1-1}`).hasClass('wall') == false){
                        $('.piece.active').css('left','-=25px');
                        
                        $(piece1).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece2).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece4).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece).attr('piecerotation','2');
                    }
                }
                if(rotation == '2'){
                    if($(`.block.lined.l${YCordP3-1}.c${XCordP3}`).hasClass('wall') == false){
                        $(piece1).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece2).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece4).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece).attr('piecerotation','3');
                    }
                }
                if(rotation == '3'){
                    if($(`.block.lined.l${YCordP3}.c${XCordP3-1}`).hasClass('wall') == false){
                        $(piece1).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece2).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece4).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece).attr('piecerotation','0');
                    }else if($(`.block.lined.l${YCordP2}.c${XCordP2+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1}.c${XCordP1+1}`).hasClass('wall') == false){
                        $('.piece.active').css('left','+=25px');
                        
                        $(piece1).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece2).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece4).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece).attr('piecerotation','0');
                    }
                }
            }
            if(type == 'Z'){
                if(rotation == '0'){
                    if($(`.block.lined.l${YCordP1+1}.c${XCordP1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1+2}.c${XCordP1}`).hasClass('wall') == false){
                        $(piece1).css('top',`+=50px`);
                        $(piece2).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece4).css('left',`-=25px`).css('top',`-=25px`);
                        $(piece).attr('piecerotation','1');
                    }else if($(`.block.lined.l${YCordP1+1}.c${XCordP1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2-1}.c${XCordP2}`).hasClass('wall') == false){
                        $('.piece.active').css('top','-=25px');

                        $(piece1).css('top',`+=50px`);
                        $(piece2).css('top',`+=25px`).css('left',`-=25px`);
                        $(piece4).css('left',`-=25px`).css('top',`-=25px`);
                        $(piece).attr('piecerotation','1');
                    }
                }
                if(rotation == '1'){
                    if($(`.block.lined.l${YCordP1}.c${XCordP1+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1}.c${XCordP1+2}`).hasClass('wall') == false){
                        $(piece1).css('left',`+=50px`);
                        $(piece2).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece4).css('left',`-=25px`).css('top',`+=25px`);
                        $(piece).attr('piecerotation','2');
                    }else if($(`.block.lined.l${YCordP1}.c${XCordP1+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2-1}`).hasClass('wall') == false){
                        $('.piece.active').css('left','-=25px');
                        
                        $(piece1).css('left',`+=50px`);
                        $(piece2).css('top',`+=25px`).css('left',`+=25px`);
                        $(piece4).css('left',`-=25px`).css('top',`+=25px`);
                        $(piece).attr('piecerotation','2');
                    }
                }
                if(rotation == '2'){
                    if($(`.block.lined.l${YCordP1-1}.c${XCordP1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1-2}.c${XCordP1}`).hasClass('wall') == false){
                        $(piece1).css('top',`-=50px`);
                        $(piece2).css('top',`-=25px`).css('left',`+=25px`);
                        $(piece4).css('left',`+=25px`).css('top',`+=25px`);
                        $(piece).attr('piecerotation','3');
                    }
                }
                if(rotation == '3'){
                    if($(`.block.lined.l${YCordP1}.c${XCordP1-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP1}.c${XCordP1-2}`).hasClass('wall') == false){
                        $(piece1).css('left',`-=50px`);
                        $(piece2).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece4).css('left',`+=25px`).css('top',`-=25px`);
                        $(piece).attr('piecerotation','0');
                    }else if($(`.block.lined.l${YCordP1}.c${XCordP1-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+1}`).hasClass('wall') == false){
                        $('.piece.active').css('left','+=25px');
                        
                        $(piece1).css('left',`-=50px`);
                        $(piece2).css('top',`-=25px`).css('left',`-=25px`);
                        $(piece4).css('left',`+=25px`).css('top',`-=25px`);
                        $(piece).attr('piecerotation','0');
                    }
                }
            }
            
            if($('.arena').find('.piece.active').length > 0){
                cordinates(piece1);
                cordinates(piece2);
                cordinates(piece3);
                cordinates(piece4);
            }
        }
        if(event.keyCode == 65 || event.keyCode == 37){
            if($(`.block.lined.l${YCordP1}.c${XCordP1-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP3}.c${XCordP3-1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP4}.c${XCordP4-1}`).hasClass('wall') == false){
                $('.piece.active:not(.placed)').css('left','-=25px');

                if($('.arena').find('.piece.active').length > 0){
                    /* atualizar cordinates */
                    cordinates(piece1);
                    cordinates(piece2);
                    cordinates(piece3);
                    cordinates(piece4);
                }
            }
        }
        if(event.keyCode == 68 || event.keyCode == 39){
            if($(`.block.lined.l${YCordP1}.c${XCordP1+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2}.c${XCordP2+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP3}.c${XCordP3+1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP4}.c${XCordP4+1}`).hasClass('wall') == false){
                $('.piece.active:not(.placed)').css('left','+=25px');

                if($('.arena').find('.piece.active').length > 0){
                    /* atualizar cordinates */
                    cordinates(piece1);
                    cordinates(piece2);
                    cordinates(piece3);
                    cordinates(piece4);
                }
            }
        }
        if(event.keyCode == 83 || event.keyCode == 40){
            if($(`.block.lined.l${YCordP1+1}.c${XCordP1}`).hasClass('wall') == false && $(`.block.lined.l${YCordP2+1}.c${XCordP2}`).hasClass('wall') == false && $(`.block.lined.l${YCordP3+1}.c${XCordP3}`).hasClass('wall') == false && $(`.block.lined.l${YCordP4+1}.c${XCordP4}`).hasClass('wall') == false){
                $('.piece.active:not(.placed)').css('top','+=25px');

                if($('.arena').find('.piece.active').length > 0){
                    /* atualizar cordinates */
                    cordinates(piece1);
                    cordinates(piece2);
                    cordinates(piece3);
                    cordinates(piece4);
                }
            }
        }
    });

    /* fall process */
    setInterval(() => {
        if(alive==1){
            var pieceCord1 = $('.piece.active[id$="1"]');
            var pieceCord2 = $('.piece.active[id$="2"]');
            var pieceCord3 = $('.piece.active[id$="3"]');
            var pieceCord4 = $('.piece.active[id$="4"]');

            var YCordP1 = parseInt($(pieceCord1).attr('line'));
            var YCordP2 = parseInt($(pieceCord2).attr('line'));
            var YCordP3 = parseInt($(pieceCord3).attr('line'));
            var YCordP4 = parseInt($(pieceCord4).attr('line'));
            var XCordP1 = parseInt($(pieceCord1).attr('col'));
            var XCordP2 = parseInt($(pieceCord2).attr('col'));
            var XCordP3 = parseInt($(pieceCord3).attr('col'));
            var XCordP4 = parseInt($(pieceCord4).attr('col'));

            if($(`.block.lined.l${YCordP1+1}.c${XCordP1}`).hasClass('wall') == true || $(`.block.lined.l${YCordP2+1}.c${XCordP2}`).hasClass('wall') == true || $(`.block.lined.l${YCordP3+1}.c${XCordP3}`).hasClass('wall') == true || $(`.block.lined.l${YCordP4+1}.c${XCordP4}`).hasClass('wall') == true){

                $(`.block.lined.c${$(pieceCord1).attr('col')}.l${$(pieceCord1).attr('line')}`).addClass('wall');
                $(`.block.lined.c${$(pieceCord2).attr('col')}.l${$(pieceCord2).attr('line')}`).addClass('wall');
                $(`.block.lined.c${$(pieceCord3).attr('col')}.l${$(pieceCord3).attr('line')}`).addClass('wall');
                $(`.block.lined.c${$(pieceCord4).attr('col')}.l${$(pieceCord4).attr('line')}`).addClass('wall');

                completedLines[$(pieceCord1).attr('line')-1] += 1;
                completedLines[$(pieceCord2).attr('line')-1] += 1;
                completedLines[$(pieceCord3).attr('line')-1] += 1;
                completedLines[$(pieceCord4).attr('line')-1] += 1;

                $(`.piece.active`).removeClass('active').addClass('placed');

                $(completedLines).each(function(index,item){
                    if(item == 10){
                        $(`.piece[line="${index+1}"]`).remove();
                        $(`.block.lined[line="${index+1}"]:not(.barrier)`).removeClass('wall');
                        completedLines[index] = 0;
                        for(var cl=index;cl>1;cl--){
                            completedLines[cl] = completedLines[cl-1];
                        }
                        $('.block.lined:not(.barrier)').removeClass('wall');
                        $('.piece.placed').each(function(){
                            if($(this).attr('line') <= index){
                                $(this).css('top','+=25px');
                                cordinates($(this));
                            }
                            $(`.block.lined.c${$(this).attr('col')}.l${$(this).attr('line')}`).addClass('wall');
                        });
                    }
                });

                setTimeout(() => {
                    generateBlock();
                },                          );

            }else{
                if($('.arena').find('.piece.active').length > 0){
                    $('.piece.active:not(.placed)').css('top','+=25px');

                    /* atualizar cordinates */
                    cordinates(pieceCord1);
                    cordinates(pieceCord2);
                    cordinates(pieceCord3);
                    cordinates(pieceCord4);
                }
            }
        }
    }, delay);

    start();

</script>
<?php include_once '../../Polardows/desktop/bottom.php' ; ?>