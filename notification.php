<?php
session_start();
require_once('./model/model_user.php');

if (isset($_SESSION['username'])) {
    if (!empty($_SESSION['username'])) {
        $user = new model_user();

        $c_user = $user->getUser(htmlspecialchars($_SESSION['username']));
        $user->getNotification($c_user['ID']);
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    header("Location: ./index.php");
    exit();
}