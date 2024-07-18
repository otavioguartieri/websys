function systemAppCreate(appName=null){
    var hasName = "0";
    if(appName)
        hasName = "1";
    var timeStamp = getdateClean();
    console.log(timeStamp)
    $.post('C/Polardows/script/systemAppCreate.php',{appId:timeStamp, hasName:hasName, appName:appName},function(data){
        console.log(data)
    });
}