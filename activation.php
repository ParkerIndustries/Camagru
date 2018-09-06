<?php
require_once("model/model_user.php");

	$user = new model_user();
	if (!empty($_GET['log']) && !empty($_GET['tok'])) {
		$login = $_GET['log'];
		$tok   = $_GET['tok'];
		$user->setActivate($login, $tok);
    } else {
    	//header('Location : index.php');
    	//exit();
    	echo "Error ...";
    }