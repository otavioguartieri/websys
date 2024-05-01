<?php include_once '../../Polardows/desktop/head.php' ; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<style>
    @font-face {
        font-family:righteous;
        src: url(<?php echo $path ?>/appdata/fonts/Righteous-Regular.ttf)
    }
    *{user-select:none;font-family:righteous;margin:0;}
    html{
        padding:0 0 4px 0;
    }
    .screen{ 
        display:flex; 
        justify-content:space-between;
        margin:auto;
    }
    .spc{display:flex; flex-wrap:wrap;}
    .spc:hover{ cursor:crosshair;}
    .drawarea{border: 10px solid #ccc ;background:white; width:500px;height:400px; }
    .dot{ width:5px; height:5px; }
    .menu{
        border:10px solid #aaa;
        width:220px;
        background:#eee;
        display:flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .tools{
        width:100%;
        display:flex;
        flex-wrap:wrap;
        border-bottom:10px solid #aaa;
    }
    .tools div{
        cursor:pointer;
    }
    .apagar_tudo{
        border-bottom:0px !important;
        border-top:10px solid #aaa;
    }
    .ferramentas .tool{
        width:40px !important;
        height:40px !important;
        display:flex;
        background:#ddd;
        cursor:pointer;
    }
    .cores div{
        width:20px;
        height:20px;
        display:flex;
        cursor:pointer;
    }
    .prev_cor_personalizada{
        width:100%;
        height:60px;
    }
    .cor_personalizada input{
        outline:none;
        border:0px;
        border-left: 1px solid #aaa;
        border-top:2px solid #aaa;
        border-right: 2px solid #aaa;
        width:155px;
    }
    .cor_personalizada .btn_cor_personalizada{
        outline: none;
        border-top: 2px solid #aaa;
        background: #ccc;
        font-size: 12px;
        width: 33px;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 24px;
    }
    .hashtag{
        outline: none;
        border-top: 2px solid #aaa;
        background: #eee;
        font-size: 18px;
        width: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 24px;
    }
    .btn_apagar_tudo{
        background: #fc7777;
        font-size: 12px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 24px;
        height:30px;
    }
</style>
<?php include_once '../../Polardows/desktop/init.php' ; ?>
<div class="screen">
    <div class="drawarea">
        <div style="background:white;" class="fundo_branco">
            <div class="spc">
            </div>
        </div>
    </div>
    <canvas id="canvas_data" style="display:none;"></canvas>
    <div class="menu">
        <div class="tools_up">
            <div class="tools ferramentas">
                <div class="tool lapis"><img style="width:100%;height:100%;" src="<?php echo $path ?>/appdata/images/pencil.png" alt=""></div>
                <div class="tool eraser"><img style="width:100%;height:100%;" src="<?php echo $path ?>/appdata/images/eraser.png" alt=""></div>
                <div class="tool"><img style="width:100%;height:100%;" src="<?php echo $path ?>/appdata/images/png.png" alt="" onclick="gerarImagem('png')"></div>
                <div class="tool"><img style="width:100%;height:100%;" src="<?php echo $path ?>/appdata/images/jpg.png" alt="" onclick="gerarImagem('jpg')"></div>
            </div>
            <div class="tools cores">
                <div id="black" style="background:black;" class="cor"></div>
                <div id="white" style="background:white;" class="cor"></div>
                <div id="grey" style="background:grey;" class="cor"></div>
                <div id="red" style="background:red;" class="cor"></div>
                <div id="orange" style="background:orange;" class="cor"></div>
                <div id="yellow" style="background:yellow;" class="cor"></div>
                <div id="green" style="background:green;" class="cor"></div>
                <div id="cyan" style="background:cyan;" class="cor"></div>
                <div id="blue" style="background:blue;" class="cor"></div>
                <div id="purple" style="background:purple;" class="cor"></div>
                <div id="pink" style="background:pink;" class="cor"></div>
            </div>
            <div class="tools cor_personalizada">
                <div class="prev_cor_personalizada"></div>
                <div class="" style="display:flex;">
                    <div class="hashtag">#</div>
                    <input placeholder="Cor personalizada (HEX)" oninput="cor_personalizada($(this));" id="cor_personalizada" type="text">
                    <div class="btn_cor_personalizada">OK</div>
                </div>
            </div>
        </div>
        <div class="tools apagar_tudo">
            <div class="btn_apagar_tudo" onclick="$('.dot').css('background','none');">LIMPAR</div>
        </div>
    </div>
</div>
<?php include_once '../../Polardows/desktop/end.php' ; ?>
<script defer>
    document.title="Paintool"
    setItem('desenho_tool','1');
    setItem('desenho_cor','black');
    for(var i=0;i<=7999;i++){
        $('.spc').append(`<div onMouseOver="draw(this);" class="dot"></div>`);
    }
    function draw(e) {
        if((getItem('desenho_mouse') == '1' && getItem('desenho_tool') == '1')){
            $(e).css('background',getItem('desenho_cor'));
            /* setTimeout(() => {
                $(this).removeClass('black');
            }, 1000); */
        }
        if((getItem('desenho_mouse') == '1' && getItem('desenho_tool') == '2')){
            $(e).css('background','none');
        }
    };
    
    $('.spc').mousedown(()=>{
        setItem('desenho_mouse','1');
    });
    $('.spc').mouseup(()=>{
        setItem('desenho_mouse','0');
    });
    $('.tool').click(function() {
        $('.tool').css('filter','brightness(1)');
        $(this).css('filter','brightness(0.7)');
        if($(this).hasClass('lapis')) setItem('desenho_tool','1');
        if($(this).hasClass('eraser')) setItem('desenho_tool','2');
    });
    $('.cor').click(function() {
        setItem('desenho_cor',$(this).attr('id'));
    });
    var cor = '';
    $('.btn_cor_personalizada').click(function() {
        cor = $('#cor_personalizada').val();
        if(cor.split('')[0] == '#'){
            cor = cor.split('#')[1];
        }
        setItem('desenho_cor',`#${cor}`);
    });
    function cor_personalizada(e){
        cor = $(e).val();
        if(cor.split('')[0] == '#'){
            cor = cor.split('#')[1];
        }
        $('.prev_cor_personalizada').attr('style',`background:#${cor};`);
    };
    function gerarImagem(type){           
        switch(type){
            case 'jpg':
                var element = $('.fundo_branco');
                var typedata = "image/jpeg";
                var extensao = ".jpg";
            break;
            default:
                var element = $('.spc');
                var typedata = "image/png";
                var extensao = ".png";
            break;
        }
        html2canvas(element).then(function (canvas) {
            var name = getdateClean();
            let xhr = new XMLHttpRequest();
            xhr.responseType = 'blob';
            xhr.onload = function () {
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(xhr.response);
                link.download = name + extensao;
                link.style.display = 'none';
                document.body.appendChild(link);
                link.click();
                link.remove()
            };
            xhr.open('GET', canvas.toDataURL(typedata, 1.0));
            xhr.send();
        });
    }
</script>
<?php include_once '../../Polardows/desktop/bottom.php' ; ?>