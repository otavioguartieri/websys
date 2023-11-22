<?php include_once '../../polardows/desktop/head.php' ; ?>
<style>
    *{user-select:none;
        margin:0;}
#container {
	margin: 0px;
    width: 300px;
    height: 300px;
    overflow:hidden;
}
#videoElement {
	width: 300px;
	height: 300px;
	background-color: #000;
}
</style>
<?php include_once '../../polardows/desktop/init.php' ; ?>
<div class="container">
    <video autoplay="true" id="videoElement">
        
    </video>
    <button onclick="tirar_foto()">tirar foto</button>
    
</div>
<canvas style="display:none;"></canvas>
<?php include_once '../../polardows/desktop/end.php' ; ?>
<script>
    $(window).on("load", function(){
        var video = document.querySelector("#videoElement");
        if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                video.srcObject = stream;
            })
            .catch(function (err0r) {
                console.log("Something went wrong!");
            });
        }
    });
    /* function stop() {
        var video = document.querySelector("#videoElement");
        var stream = video.srcObject;
        var tracks = stream.getTracks();

        for (var i = 0; i < tracks.length; i++) {
            var track = tracks[i];
            track.stop();
        }

        video.srcObject = null;
    } */
    function tirar_foto(){
        var video = document.querySelector("#videoElement");
        var canvas = document.querySelector("canvas");
        canvas.height = video.videoHeight;
        canvas.width = video.videoWidth;
        canvas.getContext('2d').drawImage(video,0,0);
        var link = document.createElement('a');
        link.download = '1234567890.png';
        link.href = canvas.toDataURL();
        link.click();
    }
</script>
<?php include_once '../../polardows/desktop/bottom.php' ; ?>