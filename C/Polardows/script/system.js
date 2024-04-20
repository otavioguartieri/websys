$(document).ready(()=>{
    System();
    /* $('#desktop').append(`
        <div class="poltab" app_id="123123123">

            <div class="tab_resize blocked z_tl"></div>
            <div class="tab_resize blocked z_tr"></div>
            <div class="tab_resize blocked z_bl"></div>
            <div class="tab_resize blocked z_br"></div>
            <div class="tab_resize blocked h_r"></div>
            <div class="tab_resize blocked h_l"></div>
            <div class="tab_resize blocked v_t"></div>
            <div class="tab_resize blocked v_b"></div>

            <div class="poltab_menu">
                <div class="poltab_menu_blankspace draggable">
                    <div class="poltab_menu_app-name">123123123</div>
                </div>
                <div class="poltab_menu_btn minimize" onmouseup="poltabminimize('123123123');" style="--btnbg:url('../polardows/systemicons/line-mark.png');"></div>
                <div class="poltab_menu_btn fullscrn" style="--btnbg:url('../polardows/systemicons/resize-mark.png');"></div>
                <div class="poltab_menu_btn close" onmouseup="poltabremove('123123123');" style="--btnbg:url('../polardows/systemicons/x-mark.png');"></div>
            </div>
            <div class="poltab_content">
                <iframe id="EmbedderContainer" src="https://embedder.net/e/movie?imdb=tt11379322" width="100%" height="100%" allowfullscreen="allowfullscreen" frameborder="0"></iframe>
            </div>
        </div>
    `); */
});

/* apply highlight on system app */
function highlight(e) {
    e.classList.add('mouseOver');
}
/* apply highlight on system app */
function removeHighlight(e) {
    e.classList.remove('mouseOver');
}

/* opens system app */
function appOpen(path,imagepath) {
    poltab(path,imagepath);
    /* abrir em uma nova guia */
    /* window.open(`${window.location.href.replace(/\/[^\/]*$/, '')}/C/program_files/${path}/app.php`, "_blank"); */
}

/* salvar alteração de guia do usuario */
/* var hidden, visibilityChange;
if (typeof document.hidden !== "undefined") {
    hidden = "hidden";
    visibilityChange = "visibilitychange";
} else if (typeof document.mozHidden !== "undefined") {
    hidden = "mozHidden";
    visibilityChange = "mozvisibilitychange";
} else if (typeof document.msHidden !== "undefined") {
    hidden = "msHidden";
    visibilityChange = "msvisibilitychange";
} else if (typeof document.webkitHidden !== "undefined") {
    hidden = "webkitHidden";
    visibilityChange = "webkitvisibilitychange";
}
document.addEventListener(visibilityChange, acao, false);
function acao() {
        setItem('voltou', Date.now());
    if (getItem("saiubase") === null) {
        setItem('saiubase', Date.now());
    }else{
        var saiubase = getItem('saiubase');
        setItem('saiu', saiubase);
        removeItem('saiubase');
    }
} */

/* remove the element from document */
/* tab close animation */
function poltabremove(e){
    setTimeout(() => {
        $(`.poltab[app_id='${e}']`).addClass('transition').addClass('minified');
    }, 50);
    setTimeout(() => {
        $(`.poltab[app_id='${e}']`).remove();
        TaskbarRemove(`${e}`);
    }, parseFloat($(':root').css('--PoltabMinifiedTransitionTime').replace(/(^0-9)/gi,'')));
    
}
function poltabminimize(e){
    $(`.poltab[app_id='${e}']`).addClass('transition').addClass('minified');
    setTimeout(() => {
        $(`.poltab[app_id='${e}']`).addClass('invisible');
    }, parseFloat($(':root').css('--PoltabMinifiedTransitionTime').replace(/(^0-9)/gi,'')));
}

/* set the localstorage item with the name and value */
function setItem(name,value){
    localStorage.setItem(name, value);
}

/* remove the localstorage item by the name */
function removeItem(name){
    localStorage.removeItem(name);
}

/* get the localstorage item value by the name */
function getItem(name){
    return localStorage.getItem(name);
}

/* generate ramdom word by length */
const characters_generatorWords ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
function generateStringWords(length) {
    let result = '';
    const charactersLength = characters_generatorWords.length;
    for ( let i = 0; i < length; i++ ) {
        result += characters_generatorWords.charAt(Math.floor(Math.random() * charactersLength));
    }

    return result;
}

/* generate ramdom number by length */
const characters_generatorNums ='0123456789';
function generateStringNums(length) {
    let result = '';
    const charactersLength = characters_generatorNums.length;
    for ( let i = 0; i < length; i++ ) {
        result += characters_generatorNums.charAt(Math.floor(Math.random() * charactersLength));
    }

    return result;
}

/* get the actual timestamp */
function getdateClean(){
    var date = new Date;
    return date.getDate()+
            ""+(date.getMonth()+1)+
            ""+date.getFullYear()+
            ""+date.getHours()+
            ""+date.getMinutes()+
            ""+date.getSeconds();
}

/* generate random numbers. with limit  */
function randomNum(limit){
    return Math.floor(Math.random() * (limit));
}

/* show the mouse cord on the cosole every tick set */
/* setInterval(logMouseCoordinates, 100); */

/* calculate the desktop area/spaces */

/* function apparea(){
    console.log($('#desktop').width());
} */
/* tab open function */
function poltab(app_id,path,app_height=800,app_width=800,app_name,app_image){
    $('#desktop').append(`
        <div class="poltab transition minified" app_id="${app_id}">

            <div class="tab_resize blocked z_tl"></div>
            <div class="tab_resize blocked z_tr"></div>
            <div class="tab_resize blocked z_bl"></div>
            <div class="tab_resize blocked z_br"></div>
            <div class="tab_resize blocked h_r"></div>
            <div class="tab_resize blocked h_l"></div>
            <div class="tab_resize blocked v_t"></div>
            <div class="tab_resize blocked v_b"></div>

            <div class="poltab_menu">
                <div class="poltab_menu_blankspace draggable">
                    <div class="poltab_menu_app-icon" style="--bgicon:url('../program_files/${app_image}');"></div>
                    <div class="poltab_menu_app-name">${app_name}</div>
                </div>
                <div class="poltab_menu_btn minimize" onmouseup="poltabminimize('${app_id}');" style="--btnbg:url('../polardows/systemicons/line-mark.png');"></div>
                <div class="poltab_menu_btn fullscrn" style="--btnbg:url('../polardows/systemicons/resize-mark.png');"></div>
                <div class="poltab_menu_btn close" onmouseup="poltabremove('${app_id}');" style="--btnbg:url('../polardows/systemicons/x-mark.png');"></div>
            </div>
            <div class="poltab_content">
                <iframe src="C/program_files/${path}/app.php" width="${app_width}" height="${app_height}" frameborder="0"></iframe>
            </div>
        </div>
    `);
    setTimeout(() => {
        $(`.poltab[app_id="${app_id}"]`).removeClass('minified');
        setTimeout(() => {
            $(`.poltab[app_id="${app_id}"]`).removeClass('transition');
        }, parseFloat($(':root').css('--PoltabMinifiedTransitionTime').replace(/(^0-9)/gi,'')));
    }, 300);
    TaskbarAdd(`${app_id}`,`${app_name}`,`../program_files/${app_image}`);
}

/* initiate and display desktop */
function System(){

    /* base params */
    var appSize = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--DesktopAppSize').replace('px','')); /* app size defined on css root */
    var nameSize = 0;
    var lineCount = 0;
    var appName = '';
    var appNameOpen = '';

    /* post to php to get apps information */
    $.post('C/polardows/appboot.php',null,function(data){
        if(data.result > -1) /* verify if the post has been succeded */
        $(data.data).each(function(index, item) {
            if(item[1]['app_launch']){ /* if the app is marked as launched the code proceed */

                /* clear the vars at each app */
                nameSize = 0;
                lineCount = 1;
                appName = '';
                appNameOpen = '';

                /* function to count and cut the space of the apps name */
                $(item[1]['app_name']).each(function(k,v){
                    nameSize+=obterTamanhoTexto(v)['width']; /* get each word size in width */
                    if(nameSize <= appSize){ /* verify if is fit on the inside of the label */
                        appName = `${appName}`+`${v}`+' '; /* add to the final label */
                    }else{
                        if(appName == ''){ /* verify the lenght in case the size of the word is bigger than the app size, then add the first line */
                            appName = `${v}`+' ';
                        }else{ /* else, it just keep breaking lines and proceed to the final label */
                            appName = `${appName.slice(0, -1)}`+'<br>'+`${v}`+' ';
                        }
                        lineCount++; /* add in the line breaking count */
                        nameSize = 0; /* clear the sum of all the words to start over on the new line */
                    }
                });
                if(lineCount > 2){ /* if the line amount is bigger than 2, it will add a mask and the "..." at the end of it */
                    appNameOpen = appName;
                    appName = `${appName.split('<br>')[0]}`+'...';
                    while(obterTamanhoTexto(appName)['width'] > appSize + 26){
                        appName = `${appName.slice(0, -4)}`+'...';
                    }
                }
                /* add the final app into the desktop workspace */
                $('#desktop').append(`
                    <app onmouseover="highlight(this)" onmouseout="removeHighlight(this)" ondblclick="poltab('${item[1]['app_id']}','${item[0]}','${item[1]["app_height"]}','${item[1]["app_width"]}', '${appName}', '${item[0]}${item[1]['app_image']}');" id="${item[1]['app_id']}" class="close">
                        <div class="app_display">
                            <div class="app_icon" style="--DesktopAppImage:url('../program_files/${item[0]}${item[1]['app_image']}');"></div>
                            <font class="close">${appName}</font>
                            <font class="open">${appNameOpen || appName}</font>
                        </div>
                    </app>
                `);
            }
        });
    }); 

    /* Manipulador de clique para o botão */
    $("#abrirLink").click(function() {
        var parteDaString = "pasta/nome.php"; /* Substitua com sua parte de string */
        abrirLinkEmNovaGuia(parteDaString);
    });
    
    function obterTamanhoTexto(text,par) {
        /* create a temporary text element */
        var tempElement = $('<span>').html(text);
    
        /* add the temp element into the docuemnt body */
        $('body').append(tempElement);
    
        /* gets the size of the temp element */
        var width = tempElement.width()+1;
        var height = tempElement.height();
    
        /* remove the temp element from the document body*/
        tempElement.remove();

        /* Return text dimensions */
        /* for each pixel below "16px" in the app label css size, add 3 in teh width */
        return {word:text, width: width+12, height: height };
    }

    /* Remove a classe quando qualquer outra parte do documento é clicada */
    $(document).on('click', function(event){

        if ($(event.target).closest('app').length == 0) {
        /* Se o clique não ocorreu dentro do elemento, remove a classe */
            $('app').removeClass('mouseClicked').addClass('close');
        }

        if ($(event.target).closest('app').length == 1) {
        /* Se o clique não ocorreu dentro do elemento, remove a classe */
            $('app').removeClass('mouseClicked').addClass('close');
            $($(event.target).closest('app')[0]).addClass('mouseClicked').removeClass('close');
        }

    });

    $('img').ondragstart = () => {
        return false;
    };

    setTimeout(function(){
        $('#screen').removeClass('cursor_progress');
    },300);
}