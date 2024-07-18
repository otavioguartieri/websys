<?php

    $appId = $_REQUEST['appId'];
    $hasName = $_REQUEST['hasName'];
    $appName = $_REQUEST['appName'];
    if($hasName == "0"){
        $appName = "app_".$appId;
    }

    $basePath = "../../program_files/".$appName."/";
    mkdir($basePath, 0777, true);

    $appDataPath = $basePath."appdata/";
    mkdir($appDataPath, 0777, true);

    $appImagesPath = $appDataPath."appimages/";
    mkdir($appImagesPath, 0777, true);

    $config = json_decode(file_get_contents($appDataPath."config.txt"),true);

    $config['app_installed'] = true;
    $config['app_launch'] = true;
    $config['app_name'] = $appName;
    $config['app_image'] = "/appdata/appimages/icon.png";
    $config['app_height'] = "320";
    $config['app_width'] = "480";
    $config['app_scale'] = "1";
    $config['app_fullscreen'] = 0;
    $config['app_resize'] = 0;

    file_put_contents($appDataPath."config.txt", json_encode($config, JSON_PRETTY_PRINT));
    
    copy('../systemicons/defaultAppImage.png', $appImagesPath."icon.png");

    $appPhp = <<<EOD
        <!-- <html> -->
        <?php include_once '../../Polardows/desktop/head.php'; ?>
        <!-- <head> -->
        <style>
            :root{
                --BlockPieceBorderWidth: 12.5px;
            }
            .screen{
                display:flex;
            }
        </style>
        <!-- </head> -->
        <?php include_once '../../Polardows/desktop/init.php'; ?>
        <!-- <body> -->
        <div class="screen">

        </div>
        <!-- </body> -->
        <?php include_once '../../Polardows/desktop/end.php'; ?>
        <script>
            document.title = 'Base Game';
        </script>
        <?php include_once '../../Polardows/desktop/bottom.php'; ?>
        <!-- </html> -->
        EOD;

    file_put_contents($basePath."app.php", $appPhp);

    echo "Pasta criada com sucesso! Nome da nova pasta: " . $appName;
?>