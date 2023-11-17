setTimeout(function(){
    RunDesktop();
},1000);

function RunDesktop(){
    $('#desktop').append('a');

    $.post('/appboot.php',null,function(data){
        $(data.data).each(function(index, item) {
            var app_icon = '../../assets/icons/system/default_icon.png';
            var app_style = '';
            var app_name = 'file.txt';
            var icon_notdefault_sombra = '';
            
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
        });
        /* $('.areashow').append(`
            <div onclick="destaqueApp(this)" id="YouTube" class="app">
                <div ondblclick="$('.screen').addClass('loading');setTimeout(() => {IframeCall('https://www.youtube.com/','YouTube','Youtube','https://www.goiania.go.leg.br/imagens/icon_youtube.png/image');$('.screen').removeClass('loading');}, 1234);" id="YouTube" class="descricao max-desc20">Youtube</div>
                <div ondblclick="$('.screen').addClass('loading');setTimeout(() => {IframeCall('https://www.youtube.com/','YouTube','Youtube','https://www.goiania.go.leg.br/imagens/icon_youtube.png/image');$('.screen').removeClass('loading');}, 1234);" id="YouTube" style="background-image: url(https://www.goiania.go.leg.br/imagens/icon_youtube.png/image); background-repeat: no-repeat; background-size: contain;z-index:0;background-position: center;" class="icon"></div>
            </div>
        `); */
    }); 
}