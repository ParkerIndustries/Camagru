<?php
session_start();
require_once('./model/model_pictures.php');
//Cette requête sera utilisée plus tard
//$sql = "SELECT id, title, content, DATE_FORMAT(pub_date,'%d/%m/%Y à %Hh%imin%ss') as date FROM articles ORDER BY id DESC $limit";
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once('./view/structure/meta-header.html'); ?>
    <body>
        <div id="globalgallery">
            <?php
            if (isset($_SESSION['username'])) {
            require_once('./view/structure/header.html');
            } else
            require_once('./view/structure/header-forms-account.html');
            ?>
            <h1>.</h1>
            <?php
            require_once('./model/model_pictures.php');
            $pictures = new model_pictures();
            if (isset($_GET['page'])) {
            $pictures->getPages($_GET['page'], false);
            } else {
            $pictures->getPages(1, false);
            }
            $src = $pictures->getPictures(false);
            if (!empty($src)) {
            echo "<h1>All pictures</h1>";
            foreach ($src as $rows => $data) {
            echo "<div class=\"responsive\">";
                echo "<div class=\"gallery\">";
                    echo '<a href="./p.php?id='. $data['ArticleID'] .'"><img id="test" src="'. $data['SrcPath'] .'" alt="Masterpiece" width="480" height="320"></a> ';
                    echo "<div class=\"desc\">";
                        echo "From user ".$data['UserID'];
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            }
            } else {
            echo '<p>No photo</p>';
            }
            ?>
            <?php echo '<div class="pagination">'.$pictures->pagination.'</div>'; ?>
        </div>
        <footer><p>Camagru 2018 - Made by smickael</p></footer>
    </body>
</html>