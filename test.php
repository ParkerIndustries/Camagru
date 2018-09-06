<video id="video" width="640" height="480" autoplay></video>
<button id="snap">Snap Photo</button>
<canvas id="canvas" width="640" height="480"></canvas>
<script type="text/javascript">
var video = document.getElementById('video');

// Get access to the camera!
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Not adding `{ audio: true }` since we only want video now
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        video.src = window.URL.createObjectURL(stream);
        video.play();
    });
}

var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');

// Trigger photo take
document.getElementById("snap").addEventListener("click", function() {
	context.drawImage(video, 0, 0, 640, 480);
	if (!file_exists('./masterpiece')) {
        mkdir('./masterpiece', 0777);
    }
    if (!mkdir('./masterpiece', 0777, true)) {
    die('Echec lors de la création des répertoires...');
	}
});
</script>