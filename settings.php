<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ./index.php');
    exit();
}
require_once ("./model/model_user.php");
$user = new model_user();

$row = $user->getUser(htmlspecialchars($_SESSION['username']));
$notif = ($row['Smail'] == 1) ? 'TRUE':'FALSE';
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('./view/structure/meta-header.html'); ?>
<body>
<?php require_once('./view/structure/header.html'); ?>
<div id="global">
            <h2>Change your:</h2>
            <ul>
                <li class="linker-none"><a href="u_mail.php" style="text-decoration: none"><i class="fa fa-envelope"></i> Mail</a></li>
                <li class="linker-none"><a href="u_user.php" style="text-decoration: none"><i class="fa fa-user-circle-o"></i> Username</a></li>
                <li class="linker-none"><a href="u_pass.php" style="text-decoration: none"><i class="fa fa-key"></i> Password</a></li>
            </ul>
            <br><br>
            <?php
                if ($notif === 'TRUE') {
                    echo '<strong>Notification </strong><a id="notif" href="./notification.php"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>';
                } else {
                    echo '<strong>Notification </strong><a id="notif" href="./notification.php"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>';
                }
            ?>
<!--            --><?php //echo $notif ?>
<!--            Receive mail when an user comments your picture : <a href="./notification.php">--><?php //echo $notif ?><!--</a>-->
</div>
    <footer><p>Camagru 2018 - Made by smickael</p></footer>
</body>
</html>