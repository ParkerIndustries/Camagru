<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ./index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('./view/structure/meta-header.html'); ?>
<body>
<?php require_once('./view/structure/header.html'); ?>
    <div id="globalgallery">
        <h1>.</h1>
            <?php
            require_once('./model/model_pictures.php');
            $pictures = new model_pictures();

                if (isset($_SESSION['username'])) {
                    $userID = $pictures->getUserIdByName($_SESSION['username']);

                    if (isset($_GET['page'])) {
                        $pictures->getPages($_GET['page'], $userID[0]);
                    } else {
                        $pictures->getPages(1, $userID[0]);
                    }

                    $src = $pictures->getPictures($userID[0]);
                    echo "<h1>"; echo ucfirst($_SESSION['username']); echo "</h1>";
                    if (!empty($src)) {
                        foreach ($src as $rows => $data) {
                            echo "<div class=\"responsive\">";
                            echo "<div class=\"gallery\">";
                            echo '<a href="./p.php?id='. $data['ArticleID'] .'"><img id="test" src="'. $data['SrcPath'] .'" alt="Masterpiece" width="480" height="320"></a> ';
                            echo "<div class=\"desc\">";
                            echo "From user ".$data['UserID'];
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";

//                            echo '<a href="./p.php?id='. $data['ArticleID'] .'"><img src="'. $data['SrcPath'] .'" alt="Personal masterpiece"></a> ';
                        }
                    } else {
                        echo '<p>No photo</p>';
                    }
                }
            ?>
    <?php echo '<div class="pagination">'.$pictures->pagination.'</div>'; ?>
</div>
    <footer><p>Camagru 2018 - Made by smickael</p></footer>
</body>
</html>