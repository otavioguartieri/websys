setTimeout(function(){
    System();
},1000);

function highlight(e) {
    e.classList.add('mouseOver');
}

function removeHighlight(e) {
    e.classList.remove('mouseOver');
}

function appOpen(path) {
    window.open(`${window.location.href.replace(/\/[^\/]*$/, '')}/C/program_files/${path}/app.php`, "_blank");
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

function setItem(name,value){
    localStorage.setItem(name, value);
}
function removeItem(name){
    localStorage.removeItem(name);
}
function getItem(name){
    return localStorage.getItem(name);
}
function switchtab(tab){
    window.location.href = tab;
}

const characters_generatorWords ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
const characters_generatorNums ='0123456789';
function generateStringWords(length) {
    let result = '';
    const charactersLength = characters_generatorWords.length;
    for ( let i = 0; i < length; i++ ) {
        result += characters_generatorWords.charAt(Math.floor(Math.random() * charactersLength));
    }

    return result;
}

function generateStringNums(length) {
    let result = '';
    const charactersLength = characters_generatorNums.length;
    for ( let i = 0; i < length; i++ ) {
        result += characters_generatorNums.charAt(Math.floor(Math.random() * charactersLength));
    }

    return result;
}

function resizeIframe(obj) {
    obj.style.height = (obj.contentWindow.document.documentElement.scrollHeight) + 'px';
    obj.style.width  = (obj.contentWindow.document.documentElement.scrollWidth) +'px';
}

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

// Função para retornar as coordenadas do mouse
function getMouseCoordinates(event,pos) {
    if(pos == 'x')
        return event.clientX;
    if(pos == 'y')
        return event.clientY;
}

// Função para exibir as coordenadas do mouse no console
function logMouseCoordinates() {
    console.log('left: ' + getMouseCoordinates(lastMouseEvent,'x') + ', top: ' + getMouseCoordinates(lastMouseEvent,'y'));
}

// capture the last mouse pos
let lastMouseEvent;
document.addEventListener('mousemove', function(event) {
    lastMouseEvent = event;
});

// show the mouse cord on the cosole every tick set
/* setInterval(logMouseCoordinates, 100); */

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
                    <app onmouseover="highlight(this)" onmouseout="removeHighlight(this)" ondblclick="appOpen('${item[0]}');" id="${item[1]['app_id']}" class="close">
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

    // Manipulador de clique para o botão
    $("#abrirLink").click(function() {
        var parteDaString = "pasta/nome.php"; // Substitua com sua parte de string
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

    // Remove a classe quando qualquer outra parte do documento é clicada
    $(document).on('click', function(event){

        if ($(event.target).closest('app').length == 0) {
        // Se o clique não ocorreu dentro do elemento, remove a classe
            $('app').removeClass('mouseClicked').addClass('close');
        }

        if ($(event.target).closest('app').length == 1) {
        // Se o clique não ocorreu dentro do elemento, remove a classe
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