<?php
session_start();
require_once('model/model_pictures.php');

if (!empty($_SESSION['username'])) {
    if (isset($_GET['id'], $_GET['userID'])) {
        if (!empty($_GET['id']) && !empty($_GET['userID'])) {
            if (is_numeric($_GET['id']) && is_numeric($_GET['userID'])) {
                $picture = new model_pictures();
                $currentUserId = $picture->getUserIdByName(htmlspecialchars($_SESSION['username']));

                $cuser = $currentUserId['ID'];
                $userID = $_GET['userID'];
                $comID = $_GET['id'];

                $picture->delCom($cuser, $userID, $comID);
            }
        }
    }
} else {
    header("Location: index.php");
    exit();
//    echo "Error ...";
}