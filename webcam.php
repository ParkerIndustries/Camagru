<?php
if (empty($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once('./view/structure/meta-header.html'); ?>
    <body>
        <?php require_once('./view/structure/header.html'); ?>
        <div id="global-webcam">
            <h1></br></h1>
            <article id="main-col">
                <h1>Take a picture.</h1>
                <div class="camflow">
                <video autoplay="true" id="video"></video>
            </div>
            <div id="formup">
                <form id="uploadForm" enctype="multipart/form-data" action="uploadtool.php" target="uploadFrame" method="post">
                    <input id="uploadFile" name="uploadFile" type="file" onchange="upload_on()"/>
                    <input id="upfilter" name="upfilter" type="number" value="0" hidden>
                    <input id="uploadSubmit" name="upsubmit" type="submit" value="Upload !" disabled="disabled"/>
                </form>
            </div>
            <div id="uploadInfos">
                <p id="uploadStatus"></p>
                <iframe id="uploadFrame" name="uploadFrame" frameborder="0" hidden></iframe>
            </div>
            <script type="text/javascript" src="view/javascript/upload.js"></script>
            <script>
            function uploadEnd(error, path) {
            document.getElementById('uploadStatus').innerHTML = (error === 'OK') ? '<img id="uploaded" src="' + path + '" alt="file upload" onload="upload_merge()"/>' : error;
            }
            document.getElementById('uploadForm').addEventListener('submit', function() {
            document.getElementById('uploadStatus').innerHTML = 'Loading...';
            });
            </script>
            <p>Select a filter for your snap</p>
            <select title="Select your filter" id="filters" onchange="selectedOption()"">
                <option value="0">Select a filter</option>
                <option value="1">Bulbizard</option>
                <option value="2">Salameche</option>
                <option value="3">Carapuce</option>
                <option value="4">Pikachu</option>
                <option value="5">Mannequin #1</option>
                <option value="6">Mannequin #2</option>
                <option value="7">Baby</option>
                <option value="8">Bodybuilder</option>
                <option value="9">Brain</option>
                <option value="10">Brian</option>
                <option value="11">Cat</option>
                <option value="12">Dog</option>
                <option value="13">Marty McFly</option>
                <option value="14">Camagru Meme</option>
                <option value="15">Rainbow</option>
                <option value="16">Salt</option>
                <option value="17">Shia #1</option>
                <option value="18">Shia #2</option>
                <option value="19">Swag</option>
            </select>
            <?php
            if (!isset($_SESSION['username'])) {
            echo "<p id=\"err_session\">You have to be signed to take any photos</p>";
            } else {
            echo "<button id=\"snapshot\" disabled=\"disabled\">Click</button>";
            }
            ?>
            <p id="demo"></p>
            <script type="text/javascript">
            function selectedOption() {
                var video = document.querySelector('#video');
                var upfile = document.querySelector('#uploadFile');
                var x = document.getElementById("filters").value;
                var upfilter = document.getElementById("upfilter");
                var up_sub = document.getElementById("uploadSubmit");
                var click = document.getElementById("snapshot");
                if (upfile.value) {
                    up_sub.disabled = !(x > 0);
                    upfilter.value = x;
                }
                else if (video.currentTime && click !== null) {
                    click.disabled = !(x > 0);
                    //upfilter.value = x;
                }
            }
            </script>
        </article>
        <aside id="sidebar">
            <h3><i class="fa fa-clock-o"></i> Your recently taken photos</h3>
            <canvas id="canvas" hidden></canvas>
            <div id="photo" style="height: 420px; width: auto; overflow-y: scroll;"></div>
            <script type="text/javascript" src="./view/javascript/webcam.js"></script>
        </aside>
    </div>
    <footer><p>Camagru 2018 - Made by smickael</p></footer>
</body>
</html>