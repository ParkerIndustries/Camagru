<?php
session_start();

require_once("./model/model_pictures.php");

if (!isset($_SESSION['username']))
{
    header('Location: ./index.php');
    exit();
}


$err = 0;
$picture = new model_pictures();


if (!isset($_GET['id']) || empty($_GET['id']) || ($_GET['id'] <= 0) || !is_numeric($_GET['id']))
    $err = 1;
else
    $artID = intval($_GET['id']);


if (!($p = $picture->getPicByArtId($_GET['id'])))
    $err = 1;

if ($err)
{
    header('Location: gallery.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('./view/structure/meta-header.html'); ?>
<body>
<?php require_once('./view/structure/header.html'); ?>
<div id="global">
            <h1>Your pictures</h1>
            <?php


                $currentUserId = $picture->getUserIdByName(htmlspecialchars($_SESSION['username']));

                    echo '<img src="' . $p['SrcPath'] . '" alt="photo"><br>';
                    echo '<a class="like" href="./vote.php?id='.$_GET['id'].'"> Like ('.$picture->getSumLike($artID, 1).') </a>';

                    if ($p['UserID'] == $currentUserId['ID']) {
                        echo " ";
                        echo '<a class="delete" href="./delete_p.php?id=' . $artID . '&userID=' . $p['UserID'] . '&src='. $p['SrcPath'].'"><i class="fa fa-trash"></i> Delete photo</a>';
                    }
            ?>

            <form method="post">
                <textarea name="comment" placeholder="Write a comment .."></textarea><br />
                <input type="submit" name="submit" value="Send" />
            </form>
            <?php
//                $currentUserId = $picture->getUserIdByName(htmlspecialchars($_SESSION['username']));

                if ($_SESSION['username']) {
                    if (isset($_POST['submit'])) {
                        if (isset($_POST['comment']) && !empty($_POST['comment'])) {
                            $comment = htmlspecialchars($_POST['comment']);
                            $by = $currentUserId;

                            if (strlen($comment) > 140) {
                                echo $error = "Max 140 characters !<br>";
                            } else {
                                $picture->addCom($artID, $by['ID'], $comment);
                            }
                        }
                    }
                } else {
                    echo '<p>Please sign-in to add a comment</p>';
                }

                $coms = $picture->getCom($artID);
                foreach ($coms as $row => $com) {
                    $from = $picture->getUserById($com['UserID']);  //TROP DE REQUETE remplacer par FETCHALL
                    echo '<p class="camflow"><b>'. $from['Username'] .'</b> at '. $com['Date'] .'</p><p style="font-style: italic">&emsp;&emsp;'. utf8_decode($com['Com']) .'</p>';
                    if ($com['UserID'] == $currentUserId['ID']) {
                        echo '<a class="delete" href="./delete_c.php?id='. $com['ComID'] .'&userID='. $com['UserID'] .'"><i class="fa fa-trash-o"></i> Delete</a><br>';
                    }
                }
            ?>
</div>
    <footer><p>Camagru 2018 - Made by smickael</p></footer>
</body>
</html>