<?php
if (strstr($_SERVER['REQUEST_URI'], 'login.php')) {
    session_start();
}

require_once("./model/model_user.php");
require_once("./controller/filter_inputs.php");

if (!empty($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
    $username = $password = null;
    $authErr = null;
    $user = new model_user();

    if (isset($_POST['username'], $_POST['password'])) {
        $username = check_input($_POST['username']);
        $password = check_input($_POST['password']);
        if ($user->auth($username, $password) && $rows = $user->getUser($username)) {
            $status = $rows['Status'];
            if ($status) {
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                $authErr = "Please check your email to activate your account";
            }
        } else {
            $authErr = "Invalid username or password";
        }
    }
?>

<!DOCTYPE html>
<html>
<?php require_once("./view/structure/meta-header-forms.html"); ?>
<body>
    <?php require_once("./view/structure/header-forms-account.html"); ?>
	<div id="main">
		<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="login" method="POST">
			<input type="text" id="user" name="username" value="<?php echo $username ?>" placeholder="Enter Username" required>
			<input type="password" id="password" name="password" value="<?php echo $password ?>" placeholder="Enter Password" required>
			<input type="submit" id="submit" name="submit" value="Login">
			<span class="error"><?php echo $authErr; ?></span></br></br></br>
			<a href="register.php">Not yet registered?</a></br>
			<a href="resetpass.php">Forgot your password?</a>
		</form>
	</div>
	<footer><p>Camagru 2018 - Made by smickael</p></footer>
</body>
</html>