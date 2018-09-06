<?php
    session_start();
    if (empty($_SESSION['username'])) {
        require_once('login.php');
    } else {
        require_once('webcam.php');
    }