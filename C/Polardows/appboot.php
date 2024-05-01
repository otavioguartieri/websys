<?php
    header('Access-Control-Allow-Origin: *');
    $appsfolder = "../program_files/";
    $app = []; /* create new array for the apps */
    $project = scandir($appsfolder); /* search for folders somewhere */
    array_shift($project); /* remove the first "." from array (trash) */
    array_shift($project); /* remove the second ".." from array (trash) */

    foreach($project as $k => $v){ /* $k is the key from array ex: [0] $v is the value... lol */
        $app[$k] = scandir($appsfolder.$v."/appdata/");  /* search in every folder */

        /* search if app config file exists */
        if(array_search('config.txt',$app[$k])) $app[$k][1] =  json_decode(file_get_contents($appsfolder.$v."/appdata/config.txt"),true);
        else $app[$k][1] = false;

        if($app[$k][1] != false && $app[$k][1]['app_launch'] == true){

            if($app[$k][1]['app_id'] == null)
                $app[$k][1]['app_id'] = str_split(md5($v.$app[$k][1]['app_name']), 12)[0];

            file_put_contents($appsfolder.$v."/appdata/config.txt", json_encode($app[$k][1], JSON_PRETTY_PRINT));

            $app[$k][1]['app_name'] = explode(" ", $app[$k][1]['app_name']);
        }

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
    
    exit(json_encode([
        'data' => $app,
        'result'=>'1',
        'header'=>header('Content-Type: application/json')
    ]));
?>