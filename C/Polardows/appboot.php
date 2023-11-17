<?php
    $appsfolder = "../Program Files/";
    $app = []; /* create new array for the apps */
    $project = scandir($appsfolder); /* search for folders somewhere */
    array_shift($project); /* remove the first "." from array (trash) */
    array_shift($project); /* remove the second ".." from array (trash) */

    foreach($project as $k => $v){ /* $k is the key from array ex: [0] $v is the value... lol */
        $app[$k] = scandir($appsfolder.$v);  /* search in every folder */

        /* search if app config file exists */
        if(array_search('config.txt',$app[$k])) $app[$k][1] =  json_decode(file_get_contents($appsfolder.$v."/config.txt"),true);
        else $app[$k][1] = false;

        /* search if app exists */
        if(array_search('app.php',$app[$k])) $app[$k][2] = 'app.php';
        else $app[$k][2] = false;

        /* search if app icon exists */
        /* if(array_search('icon.png',$app[$k])) $app[$k][3] = 'icon.png';
        else $app[$k][3] = false; */

        /* defines the amount of array keys (remove trash just in case) */
        $app[$k] = array_slice($app[$k], 0, 2 + 1);

        /* defines the value [0] w/ the folder name */
        $app[$k][0] = $v;
    }

    /* foreach($project as $k => $v){
        if(explode('.',$project[$k])[1] == 'php' || explode('.',$project[$k])[0] == 'home' || substr($project[$k], 0, 2) == '__' ){
            unset($project[$k]);
        }
    }*/
    
    exit(json_encode([
        'data' => $app,
        'result'=>'1',
        'header'=>header('Content-Type: application/json')
    ])); 
?>