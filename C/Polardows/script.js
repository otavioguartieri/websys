setTimeout(function(){
    RunDesktop();
},1000);

function RunDesktop(){

    /* base params */
    var appSize = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--DesktopAppSize').replace('px','')); /* app size defined on css root */
    var nameSize = 0;
    var lineCount = 0;
    var appName = '';
    var appNameOpen = '';

    /* post to php to get apps information */
    $.post('C/Polardows/appboot.php',null,function(data){
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
                    while(obterTamanhoTexto(appName)['width'] > appSize+30){
                        appName = `${appName.slice(0, -4)}`+'...';
                    }
                }
                /* add the final app into the desktop workspace */
                $('#desktop').append(`
                    <app id="${item[1]['app_id']}">
                        <img src="C/Program Files/${item[0]}/${item[1]['app_image']}">
                        <font class="close">${appName}</font>
                        <font class="open">${appNameOpen}</font>
                    </app>
                `);
            }
        });
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
}