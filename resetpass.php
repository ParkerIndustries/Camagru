<?php
session_start();
if (!empty($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
require_once("./model/model_filter.php");

$email = "";
$emailErr = "";
$arrayEmail = null;
$filters = new model_filter();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $arrayEmail = $filters->emailFilter($_POST['email'], 1);
    $email = $arrayEmail[0];
    $emailErr = $arrayEmail[2];
}
?>

<!DOCTYPE html>

<html lang="en">
<?php require_once("./view/structure/meta-header-forms.html"); ?>
<body>
    <?php require_once("./view/structure/header-forms-account.html"); ?>
    <div id="global">
        <article>
            <p>
                We can help you reset your password using your Camagru email linked to your account
            </p>
            <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email">
                <span class="error">* <?php echo $emailErr; ?></span><br><br>

                <input type="submit" name="submit" value="Reset Password">
            </form>
        </article>
    </div>
    <footer><p>Camagru 2018 - Made by smickael</p></footer>
</body>
</html>