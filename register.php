<?php
session_start();
if (isset($_SESSION['username'])) {
	header("Location: index.php");
	exit();
}
?>

<!DOCTYPE html>
<html>
<?php require_once("./view/structure/meta-header-forms.html"); ?>
<body>
	<?php require_once("./view/structure/header-forms-account.html"); ?>
	<?php require_once("./controller/filter_fields.php"); ?>
	<div id="main">
		<form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="login" >
			<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
			<span class="error">* <?php echo $usernameErr; ?></span>

			<input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email">
			<span class="error">* <?php echo $emailErr; ?></span>

			<input type="password" name="password" value="<?php echo $password; ?>" placeholder="Password">
			<span class="error">* <?php echo $passwordErr; ?></span>

			<input type="submit" name="submit" value="Create Account" id="submit">
		</form>
		<div id="login">
			<h3>Have an account? <a href="./login.php" style="text-decoration: none">Log in</a></h3>
		</div>
	</div>
	<footer><p>Camagru 2018 - Made by smickael</p></footer>
</body>
</html>
