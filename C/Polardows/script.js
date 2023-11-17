setTimeout(function(){
    RunDesktop();
},1000);

function RunDesktop(){

    $.post('C/Polardows/appboot.php',null,function(data){
        if(data.result > -1)
        $(data.data).each(function(index, item) {
            if(item[1]['app_launch']){
                console.log(item);
                $('#desktop').append(`
                    <app id="${item[1]['app_id']}">
                        <img src="C/Program Files/${item[0]}/${item[1]['app_image']}">
                        <font>${item[1]['app_name']}</font>
                    </app>
                `);
                console.log(obterTamanhoTexto(item[1]['app_name']))
            }
        });
            /* if(item.indexOf('stylesheet.txt') >= 0 && item[2] != 'none') app_style = item[2]; 

            if(item.indexOf('icon.png') >= 0){
                app_icon = `../files/${item[0]}/icon.png`;
            }else if(item.indexOf('icon.gif') >= 0){
                app_icon = `../files/${item[0]}/icon.gif`;
            }

            app_name = item[1];

            if(item.indexOf('app.php') >= 0){
                tag_id = item[0].toLowerCase().replace(' ','')+'_'+generateStringWords(8).replace(' ', '')+'_'+generateStringNums(4).replace(' ', '');

                $('.areashow').append(`
                    <div onclick="destaqueApp(this)" id="${tag_id}" class="app">
                        <div ondblclick="$('.screen').addClass('loading');setTimeout(() => {IframeCall('/?v=${item[0]}','${tag_id}','${app_name}','${app_icon}');$('.screen').removeClass('loading');}, 1234);" id="${tag_id}" class="descricao max-desc20">${app_name}</div>
                        <div ondblclick="$('.screen').addClass('loading');setTimeout(() => {IframeCall('/?v=${item[0]}','${tag_id}','${app_name}','${app_icon}');$('.screen').removeClass('loading');}, 1234);" id="${tag_id}" style="background-image: url(${app_icon}); background-repeat: no-repeat; background-size: contain;z-index:0;background-position: center;${app_style}" class="icon"></div>
                    </div>
                `);
            } */
        /* $('.areashow').append(`
            <div onclick="destaqueApp(this)" id="YouTube" class="app">
                <div ondblclick="$('.screen').addClass('loading');setTimeout(() => {IframeCall('https://www.youtube.com/','YouTube','Youtube','https://www.goiania.go.leg.br/imagens/icon_youtube.png/image');$('.screen').removeClass('loading');}, 1234);" id="YouTube" class="descricao max-desc20">Youtube</div>
                <div ondblclick="$('.screen').addClass('loading');setTimeout(() => {IframeCall('https://www.youtube.com/','YouTube','Youtube','https://www.goiania.go.leg.br/imagens/icon_youtube.png/image');$('.screen').removeClass('loading');}, 1234);" id="YouTube" style="background-image: url(https://www.goiania.go.leg.br/imagens/icon_youtube.png/image); background-repeat: no-repeat; background-size: contain;z-index:0;background-position: center;" class="icon"></div>
            </div>
        `); */
        
    }); 

    function obterTamanhoTexto(texto) {
        // Crie um elemento de texto temporário
        var elementoTemporario = $('<span>').html(texto);
      
        // Adicione o elemento temporário ao corpo do documento
        $('body').append(elementoTemporario);
      
        // Obtenha as dimensões do elemento
        var largura = elementoTemporario.width();
        var altura = elementoTemporario.height();
      
        // Remova o elemento temporário do corpo do documento
        elementoTemporario.remove();
      
        // Retorne as dimensões do texto
        return { largura: largura, altura: altura };
      }
}